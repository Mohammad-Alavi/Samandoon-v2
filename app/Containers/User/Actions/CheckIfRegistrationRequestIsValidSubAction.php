<?php

namespace App\Containers\User\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\User\Exceptions\BadLoginTypeException;
use App\Containers\User\UI\API\Requests\RegisterRequest;
use App\Ship\Parents\Actions\SubAction;

class CheckIfRegistrationRequestIsValidSubAction extends SubAction {

    /**
     * @param RegisterRequest $request
     * @throws \Throwable
     */
    public function run(RegisterRequest $request) {
        /*
        |--------------------------------------------------------------------------
        | Gather needed variables
        |--------------------------------------------------------------------------
        |
        */
        $allowedPasswordType = Apiato::call('Authentication@GetAllowedLoginPasswordTypeTask');
        $allowedUsernameTypes = Apiato::call('Authentication@GetAllowedLoginUsernameTypesTask');
        $isEmailAllowed = in_array('email', $allowedUsernameTypes);
        $isPhoneAllowed = in_array('phone', $allowedUsernameTypes);
        $isPasswordNeeded = $allowedPasswordType == 'password';
        $requestHasEmail = isset($request['email']);
        $requestHasPhone = isset($request['phone']);
        $requestHasPassword = isset($request['password']);

        /*
        |--------------------------------------------------------------------------
        | Do the validations
        |--------------------------------------------------------------------------
        |
        | * Throw an exception if password exists (if needed)
        |
        | * Throw an exception if password is not existing (if not needed)
        |
        | * Throw an exception if email and phone are both entered
        |
        | * Throw an exception if email and phone are both missing
        |
        | * Throw an exception if entered username type is not allowed
        |
        */

        //  Throw an exception if password is needed but not entered
        throw_if($isPasswordNeeded && !$requestHasPassword, new BadLoginTypeException());

        //  Throw an exception if password is not needed but entered
        throw_if(!$isPasswordNeeded && $requestHasPassword, new BadLoginTypeException());

        //  Throw an exception if email and phone are both entered
        throw_if($requestHasEmail && $requestHasPhone, new BadLoginTypeException());

        //  Throw an exception if email and phone are both missing
        throw_if(!$requestHasEmail && !$requestHasPhone, new BadLoginTypeException());

        //  Throw an exception if entered username type is not allowed
        throw_if(!$isPhoneAllowed && $requestHasPhone, new BadLoginTypeException());
        throw_if(!$isEmailAllowed && $requestHasEmail, new BadLoginTypeException());

    }
}
