<?php

namespace App\Containers\User\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\User\Models\User;
use App\Ship\Parents\Actions\SubAction;

class ConfirmUsersPhoneSubAction extends SubAction {

    /**
     * @param string $userId
     * @return User
     */
    public function run(string $userId): User {
        $userData = [
            "is_phone_confirmed" => true,
        ];
        $user = Apiato::call('User@UpdateUserTask', [$userData, $userId]);

        return $user;
    }
}
