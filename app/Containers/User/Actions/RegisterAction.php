<?php

namespace App\Containers\User\Actions;

use App\Containers\User\Exceptions\BadLoginTypeException;
use App\Containers\User\Models\User;
use App\Containers\User\UI\API\Requests\RegisterRequest;
use App\Ship\Parents\Actions\Action;
use App\Ship\Transporters\DataTransporter;

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
        $requestHasEmail = !is_null($request['email']);
        $requestHasPhone = !is_null($request['phone']);
        $requestHasPassword = !is_null($request['password']);

        $transporter = new DataTransporter($request);

        /*
        |--------------------------------------------------------------------------
        | Pass data to related action
        |--------------------------------------------------------------------------
        |
        */

        //  Register by email and password
        if ($requestHasEmail && $requestHasPassword)
            return $this->createUserByEmailAndPasswordSubAction->run($transporter);

        //  Register by phone and password
        if ($requestHasPhone && $requestHasPassword)
            return $this->createUserByPhoneAndPasswordSubAction->run($transporter);

        //  Register by phone and oneTimePassword
        if ($requestHasPhone && !$requestHasPassword)
            return $this->findOrCreateUserByPhoneAndOneTimePasswordSubAction->run($transporter);

        throw new BadLoginTypeException();
    }
}
