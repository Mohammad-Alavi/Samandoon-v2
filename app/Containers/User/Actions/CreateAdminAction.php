<?php

namespace App\Containers\User\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\User\Models\User;
use App\Ship\Parents\Actions\Action;
use App\Ship\Transporters\DataTransporter;

class CreateAdminAction extends Action
{
    /**
     * @param DataTransporter $data
     * @return User
     */
    public function run(DataTransporter $data): User
    {
        $admin = Apiato::call('User@CreateUserByPhoneTask', [
            $isClient = false,
            $data->email,
            $data->password,
            $data->name
        ]);

        // NOTE: if not using a single general role for all Admins, comment out that line below. And assign Roles
        // to your users manually. (To list admins in your dashboard look for users with `is_client=false`).
        Apiato::call('Authorization@AssignUserToRoleTask', [$admin, ['admin']]);

        return $admin;
    }
}
