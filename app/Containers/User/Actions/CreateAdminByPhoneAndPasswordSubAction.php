<?php

namespace App\Containers\User\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\User\Exceptions\PhoneIsExistingException;
use App\Containers\User\Models\User;
use App\Ship\Parents\Actions\SubAction;
use App\Ship\Transporters\DataTransporter;

class CreateAdminByPhoneAndPasswordSubAction extends SubAction {

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
        $isPhoneExisting = Apiato::call('User@CheckIfPhoneIsExistingTask', [$data->phone]);

        //  Error if user exists
        throw_if($isPhoneExisting, new PhoneIsExistingException());

        //  Create user
        $this->user = Apiato::call('User@CreateUserByPhoneTask', [false, $data->phone]);

        //  Set the password
        $this->user = Apiato::call('User@UpdateUserPasswordSubAction', [$this->user->id, $data->password]);

        //  Assign Roles to admin
        Apiato::call('Authorization@AssignUserToRoleTask', [$this->user, ['admin']]);

        return $this->user;
    }
}
