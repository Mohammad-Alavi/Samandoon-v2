<?php

namespace App\Containers\User\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\User\Models\User;
use App\Ship\Parents\Actions\SubAction;
use Illuminate\Support\Facades\Hash;

class UpdateUserPasswordSubAction extends SubAction {

    public function run(string $userId, $newPassword): User {
        $userData = ["password" => Hash::make($newPassword)];
        $user = Apiato::call('User@UpdateUserTask', [$userData, $userId]);

        return $user;
    }
}
