<?php

namespace App\Containers\User\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\User\Models\User;
use App\Ship\Parents\Actions\Action;
use App\Ship\Transporters\DataTransporter;

class UpdateUserAction extends Action {

    /**
     * @param DataTransporter $data
     *
     * @return  User
     */
    public function run(DataTransporter $data): User {
        //  TODO: don't let user change its email or phone if any of them is confirmed
        //  TODO: OR
        //  TODO: make it not confirmed after gets edited
        $userData = [
            'first_name' => $data->first_name,
            'last_name'  => $data->last_name,
            'nick_name ' => $data->nick_name,
            'email'      => $data->email,
            'phone'      => $data->phone,
            'gender'     => $data->gender,
            'birth'      => $data->birth
        ];

        // remove null values and their keys
        $userData = array_filter($userData);

        $user = Apiato::call('User@UpdateUserTask', [$userData, $data->id]);

        return $user;
    }
}
