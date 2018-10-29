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
        $userData = [
            'first_name' => $data->first_name,
            'last_name'  => $data->last_name,
            'email'      => $data->email,
            'gender'     => $data->gender,
            'birth'      => $data->birth
        ];

        // remove null values and their keys
        $userData = array_filter($userData);

        $user = Apiato::call('User@UpdateUserTask', [$userData, $data->id]);

        return $user;
    }
}
