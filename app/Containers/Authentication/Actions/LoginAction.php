<?php

namespace App\Containers\Authentication\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Authentication\Exceptions\PasswordExpiredException;
use App\Containers\User\Models\User;
use App\Containers\User\UI\API\Requests\LoginRequest;
use App\Ship\Parents\Actions\Action;

class LoginAction extends Action {

    /**
     * @var User
     */
    protected $user;

    /**
     * @param LoginRequest $request
     * @return mixed
     * @throws \Throwable
     */
    public function run(LoginRequest $request) {

        $requestData = [
            'grant_type'    => $request->grant_type ?? 'password',
            'client_id'     => $request->client_id,
            'client_secret' => $request->client_password,
            'scope'         => $request->scope ?? '',
        ];

        //  Recognize which username type is entered and get the username from that.
        $usernameFieldKey = Apiato::call('Authentication@GetLoginUsernameFieldSubAction', [$request]);
        $username = $request[$usernameFieldKey];

        //  Recognize which password type is entered and get the password from that.
        $passwordFieldKey = Apiato::call('Authentication@GetAllowedLoginPasswordTypeTask');
        $password = $request[$passwordFieldKey];

        //  Add username and password to the data we want to pass to passport.
        $requestData = array_merge($requestData,
            [
                'username' => $username,
                'password' => $password,
            ]
        );

        //  Get user
        $this->user = Apiato::call(
            'Authentication@GetUserByCustomUsernameFieldSubAction',
            [$usernameFieldKey, $username]
        );

        $isEmailUsername = $usernameFieldKey == 'email';
        $isPhoneUsername = $usernameFieldKey == 'phone';
        $isOneTimePassword = $passwordFieldKey == 'one_time_password';

        /*
        |--------------------------------------------------------------------------
        | Actions must be done before logging user in
        |--------------------------------------------------------------------------
        |
        | * Check if one time password is expired (if it is used to login)
        |
        | * Check if email is confirmed (if is needed)
        |
        | * Check if phone is confirmed (if is needed)
        |
        */
        if ($isOneTimePassword) {
            //  Check if user's password is not expired.
            $isExpired = Apiato::call('Authentication@CheckIfOneTimePasswordIsExpiredTask', [$this->user]);
            throw_if($isExpired, new PasswordExpiredException());
        }

        if ($isEmailUsername){
            Apiato::call('Authentication@CheckIfUsersEmailIsConfirmedTask', [$this->user]);
        }

        if ($isPhoneUsername){
            Apiato::call('Authentication@CheckIfUsersPhoneIsConfirmedTask', [$this->user]);
        }

        /*
        |--------------------------------------------------------------------------
        | Login the user
        |--------------------------------------------------------------------------
        |
        | Send gathered data to passport system to do authentication logic.
        |
        | If anything goes wrong this subAction will throw exceptions, if this line passes it means
        | that login was successful!
        |
        | (in this step we are sure that everything is done including validations, confirmation checks, ...)
        |
        */
        $loginResult = Apiato::call('Authentication@LoginByCredentialsUsingPassportSubAction', [$requestData]);

        /*
        |--------------------------------------------------------------------------
        | Actions must be done after login succeed
        |--------------------------------------------------------------------------
        |
        | * Remove one time password if it is used to login
        |
        | * Confirm user's phone if PHONE and ONE_TIME PASSWORD is used to login
        |
        | *
        |
        */
        if ($isOneTimePassword) {
            //  Remove one time password.
            Apiato::call('User@UpdateUserOneTimePasswordSubAction', [$this->user->id, null]);
        }
        if ($isPhoneUsername && $isOneTimePassword){
            //  Confirm user's phone
            Apiato::call('User@ConfirmUsersPhoneSubAction', [$this->user->id]);
        }

        return $loginResult;

    }
}
