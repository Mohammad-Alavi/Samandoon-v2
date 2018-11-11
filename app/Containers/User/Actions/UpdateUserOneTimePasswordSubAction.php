<?php

namespace App\Containers\User\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\User\Models\User;
use App\Ship\Parents\Actions\SubAction;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class UpdateUserOneTimePasswordSubAction extends SubAction {

    /**
     * @param string $userId
     * @param null|string $oneTimePassword
     * @return User
     */
    public function run(string $userId, ?string $oneTimePassword): User {

        if ($oneTimePassword == null)
            $hashedPassword = null;
        else
            $hashedPassword = Hash::make($oneTimePassword);

        $userData = [
            "one_time_password" => $hashedPassword,
            "one_time_password_updated_at" => Carbon::now()
        ];

        $user = Apiato::call('User@UpdateUserTask', [$userData, $userId]);

        return $user;
    }
}
