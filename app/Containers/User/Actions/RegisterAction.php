<?php

namespace App\Containers\User\Actions;

use App\Containers\User\Exceptions\BadLoginTypeException;
use App\Containers\User\Models\User;
use App\Containers\User\UI\API\Requests\RegisterRequest;
use App\Ship\Parents\Actions\Action;

class RegisterAction extends Action {

    /**
     * @var CheckIfRegistrationRequestIsValidSubAction
     */
    private $checkIfRegistrationRequestIsValidSubAction;

    /**
     * @var CreateUserByEmailAndPasswordSubAction
     */
    private $createUserByEmailAndPasswordSubAction;

    /**
     * @var CreateUserByPhoneAndPasswordSubAction
     */
    private $createUserByPhoneAndPasswordSubAction;

    /**
     * @var FindOrCreateUserByPhoneAndOneTimePasswordSubAction
     */
    private $findOrCreateUserByPhoneAndOneTimePasswordSubAction;

    /**
     * RegisterAction constructor.
     *
     * @param CheckIfRegistrationRequestIsValidSubAction         $checkIfRegistrationRequestIsValidSubAction
     * @param CreateUserByEmailAndPasswordSubAction              $createUserByEmailAndPasswordSubAction
     * @param CreateUserByPhoneAndPasswordSubAction              $createUserByPhoneAndPasswordSubAction
     * @param FindOrCreateUserByPhoneAndOneTimePasswordSubAction $findOrCreateUserByPhoneAndOneTimePasswordSubAction
     */
    public function __construct(CheckIfRegistrationRequestIsValidSubAction $checkIfRegistrationRequestIsValidSubAction,
                                CreateUserByEmailAndPasswordSubAction $createUserByEmailAndPasswordSubAction,
                                CreateUserByPhoneAndPasswordSubAction $createUserByPhoneAndPasswordSubAction,
                                FindOrCreateUserByPhoneAndOneTimePasswordSubAction $findOrCreateUserByPhoneAndOneTimePasswordSubAction) {
        $this->checkIfRegistrationRequestIsValidSubAction = $checkIfRegistrationRequestIsValidSubAction;
        $this->createUserByEmailAndPasswordSubAction = $createUserByEmailAndPasswordSubAction;
        $this->createUserByPhoneAndPasswordSubAction = $createUserByPhoneAndPasswordSubAction;
        $this->findOrCreateUserByPhoneAndOneTimePasswordSubAction = $findOrCreateUserByPhoneAndOneTimePasswordSubAction;
    }

    /**
     * @param RegisterRequest $request
     *
     * @return User
     * @throws BadLoginTypeException
     * @throws \Throwable
     */
    public function run(RegisterRequest $request): User {

        /*
        |--------------------------------------------------------------------------
        | Do the validations
        |--------------------------------------------------------------------------
        |
        */
        $this->checkIfRegistrationRequestIsValidSubAction->run($request);


        /*
        |--------------------------------------------------------------------------
        | Gather needed variables
        |--------------------------------------------------------------------------
        |
        */
        $requestHasEmail = isset($request['email']);
        $requestHasPhone = isset($request['phone']);
        $requestHasPassword = isset($request['password']);


        /*
        |--------------------------------------------------------------------------
        | Pass data to related action
        |--------------------------------------------------------------------------
        |
        */

        //  Register by email and password
        if ($requestHasEmail && $requestHasPassword)
            $this->createUserByEmailAndPasswordSubAction->run($request);

        //  Register by phone and password
        if ($requestHasPhone && $requestHasPassword)
            $this->createUserByPhoneAndPasswordSubAction->run($request);

        //  Register by phone and oneTimePassword
        if ($requestHasPhone && !$requestHasPassword)
            $this->findOrCreateUserByPhoneAndOneTimePasswordSubAction->run($request);

        throw new BadLoginTypeException();
    }
}
