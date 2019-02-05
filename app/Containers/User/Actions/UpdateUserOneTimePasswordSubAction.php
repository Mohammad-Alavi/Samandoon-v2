<?php

namespace App\Containers\User\Actions;

use App\Containers\User\Models\User;
use App\Containers\User\Tasks\UpdateUserTask;
use App\Ship\Parents\Actions\SubAction;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class UpdateUserOneTimePasswordSubAction extends SubAction {

    /**
     * @var UpdateUserTask
     */
    private $updateUserTask;

    /**
     * UpdateUserOneTimePasswordSubAction constructor.
     *
     * @param UpdateUserTask $updateUserTask
     */
    public function __construct(UpdateUserTask $updateUserTask) {
        $this->updateUserTask = $updateUserTask;
    }

    /**
     * @param string      $userId
     * @param null|string $oneTimePassword
     *
     * @return User
     */
    public function run(string $userId, ?string $oneTimePassword): User {

        if ($oneTimePassword == null)
            $hashedPassword = null;
        else
            $hashedPassword = Hash::make($oneTimePassword);

        $userData = [
            "one_time_password"            => $hashedPassword,
            "one_time_password_updated_at" => Carbon::now()
        ];

        $user = $this->updateUserTask->run($userData, $userId);

        return $user;
    }
}
