<?php

namespace App\Containers\User\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\User\Models\User;
use App\Ship\Parents\Actions\SubAction;

class AddPointsToUserSubAction extends SubAction {

    /**
     * @param User $user
     * @param int  $points
     *
     * @return User
     */
    public function run(User $user, int $points): User {

        $userData = [
            "points" => $user->points + $points,
        ];
        $user = Apiato::call('User@UpdateUserTask', [$userData, $user->id]);

        return $user;
    }
}
