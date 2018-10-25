<?php

namespace App\Containers\Authentication\Tasks;

use App\Containers\User\Models\User;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task;
use Carbon\Carbon;
use Exception;

class CheckIfPasswordIsExpiredTask extends Task
{

    public function run(User $user): bool
    {
        try {
            return $user->password_updated_at->gt(Carbon::now()->addSeconds(10));  //  TODO: add it's value to config file
        }
        catch (Exception $exception) {
            throw new NotFoundException();
        }
    }
}
