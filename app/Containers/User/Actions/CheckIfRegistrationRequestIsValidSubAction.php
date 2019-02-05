<?php

namespace App\Containers\User\Actions;

use App\Containers\Authentication\Tasks\GetAllowedLoginPasswordTypeTask;
use App\Containers\Authentication\Tasks\GetAllowedLoginUsernameTypesTask;
use App\Containers\User\Exceptions\BadLoginTypeException;
use App\Containers\User\UI\API\Requests\RegisterRequest;
use App\Ship\Parents\Actions\SubAction;

class CheckIfRegistrationRequestIsValidSubAction extends SubAction {

    /**
     * @var GetAllowedLoginUsernameTypesTask
     */
    protected $getAllowedLoginUsernameTypesTask;

    /**
     * @var GetAllowedLoginPasswordTypeTask
     */
    protected $getAllowedLoginPasswordTypeTask;

    /**
     * CheckIfRegistrationRequestIsValidSubAction constructor.
     *
     * @param GetAllowedLoginUsernameTypesTask $getAllowedLoginUsernameTypesTask
     * @param GetAllowedLoginPasswordTypeTask  $getAllowedLoginPasswordTypeTask
     */
    public function __construct(GetAllowedLoginUsernameTypesTask $getAllowedLoginUsernameTypesTask,
                                GetAllowedLoginPasswordTypeTask $getAllowedLoginPasswordTypeTask) {
        $this->getAllowedLoginUsernameTypesTask = $getAllowedLoginUsernameTypesTask;
        $this->getAllowedLoginPasswordTypeTask = $getAllowedLoginPasswordTypeTask;
    }


    /**
     * @param RegisterRequest $request
     *
     * @return bool
     * @throws \Throwable
     */
    public function run(RegisterRequest $request): bool {
        /*
        |--------------------------------------------------------------------------
        | Gather needed variables
        |--------------------------------------------------------------------------
        |
        */
        $allowedUsernameTypes = $this->getAllowedLoginUsernameTypesTask->run();
        $allowedPasswordType = $this->getAllowedLoginPasswordTypeTask->run();
        $isEmailAllowed = in_array('email', $allowedUsernameTypes);
        $isPhoneAllowed = in_array('phone', $allowedUsernameTypes);
        $isPasswordNeeded = $allowedPasswordType == 'password';
        $requestHasEmail = !is_null($request['email']);
        $requestHasPhone = !is_null($request['phone']);
        $requestHasPassword = !is_null($request['password']);

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
        | * Throw an exception if phone is not allowed but entered
        |
        | * Throw an exception if email is not allowed but entered
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

        //  Throw an exception if phone is not allowed but entered
        throw_if(!$isPhoneAllowed && $requestHasPhone, new BadLoginTypeException());

        //  Throw an exception if email is not allowed but entered
        throw_if(!$isEmailAllowed && $requestHasEmail, new BadLoginTypeException());

        return true;
    }
}
