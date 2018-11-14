<?php

namespace App\Containers\User\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\User\Exceptions\EmailIsExistingException;
use App\Containers\User\Models\User;
use App\Ship\Parents\Actions\Action;
use App\Ship\Transporters\DataTransporter;

class CreateUserByEmailAndPasswordSubAction extends Action {

    /**
     * @var User
     */
    private $user;

    /**
     * @param DataTransporter $data
     *
     * @return User
     * @throws \Throwable
     */
    public function run(DataTransporter $data): User {
        //  Check if user had been registered before.
        $isEmailExisting = Apiato::call('User@CheckIfEmailIsExistingTask', [$data->email]);

        //  Error if user exists
        throw_if($isEmailExisting, new EmailIsExistingException());

        //  Create user
        $this->user = Apiato::call('User@CreateUserByEmailTask', [true, $data->email]);

        //  Set the password
        $this->user = Apiato::call('User@UpdateUserPasswordSubAction', [$this->user->id, $data->password]);

        return $this->user;
    }
}
