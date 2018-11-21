<?php

namespace App\Containers\User\Actions;

use App\Containers\User\Models\User;
use App\Containers\User\Tasks\UpdateUserTask;
use App\Ship\Parents\Actions\SubAction;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class UpdateUserPasswordSubAction extends SubAction {

    /**
     * @var UpdateUserTask
     */
    private $updateUserTask;

    /**
     * UpdateUserPasswordSubAction constructor.
     *
     * @param UpdateUserTask $updateUserTask
     */
    public function __construct(UpdateUserTask $updateUserTask) {
        $this->updateUserTask = $updateUserTask;
    }

    /**
     * @param string $userId
     * @param string $newPassword
     *
     * @return User
     */
    public function run(string $userId, string $newPassword): User {
        $userData = [
            "password"            => Hash::make($newPassword),
            "password_updated_at" => Carbon::now()
        ];

        $user = $this->updateUserTask->run($userData, $userId);

        return $user;
    }
}
