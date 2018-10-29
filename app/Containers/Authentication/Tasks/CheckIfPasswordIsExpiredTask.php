<?php

namespace App\Containers\Authentication\Tasks;

use App\Containers\User\Models\User;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Config;

class CheckIfPasswordIsExpiredTask extends Task
{

    /**
     * @param User $user
     * @throws NotFoundException
     * @return bool
     */
    public function run(User $user): bool
    {
        try {
            $password_expiration_age = Config::get('authentication-container.login.password_expiration_age');
            return Carbon::now()->gt($user->password_updated_at->addSeconds($password_expiration_age));
        }
        catch (Exception $exception) {
            throw new NotFoundException();
        }
    }
}
