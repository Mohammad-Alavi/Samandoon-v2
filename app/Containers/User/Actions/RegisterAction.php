<?php

namespace App\Containers\User\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\User\Exceptions\BadLoginTypeException;
use App\Containers\User\Models\User;
use App\Containers\User\UI\API\Requests\RegisterRequest;
use App\Ship\Parents\Actions\Action;

class RegisterAction extends Action {
    /**
     * @param RegisterRequest $request
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
        Apiato::call('User@CheckIfRegistrationRequestIsValidSubAction', [$request]);


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
            return Apiato::call('User@CreateUserByEmailAndPasswordSubAction', [$request]);

        //  Register by phone and password
        if ($requestHasPhone && $requestHasPassword)
            return Apiato::call('User@CreateUserByPhoneAndPasswordSubAction', [$request]);

        //  Register by phone and oneTimePassword
        if ($requestHasPhone && !$requestHasPassword)
            return Apiato::call('User@FindOrCreateUserByPhoneAndOneTimePasswordSubAction', [$request]);

        throw new BadLoginTypeException();
    }
}
