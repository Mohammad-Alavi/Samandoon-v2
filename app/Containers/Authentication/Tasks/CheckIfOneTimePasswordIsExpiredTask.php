<?php

namespace App\Containers\Authentication\Tasks;

use App\Containers\User\Models\User;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task;
use Carbon\Carbon;
use Illuminate\Support\Facades\Config;

class CheckIfOneTimePasswordIsExpiredTask extends Task {

    /**
     * @param User $user
     * @throws NotFoundException
     * @return bool
     */
    public function run(User $user): bool {
        $password_expiration_age = Config::get('authentication-container.login.one_time_password_expiration_age');

        return Carbon::now()->gt($user->one_time_password_updated_at->addSeconds($password_expiration_age));
    }
}
