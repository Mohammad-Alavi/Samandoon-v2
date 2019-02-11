<?php

namespace App\Containers\User\Tasks;

use App\Containers\User\Models\User;
use App\Ship\Parents\Tasks\Task;

class GetFollowersTask extends Task
{
    /**
     * @param User $user
     * @param      $limit
     *
     */
    public function run(User $user, $limit)
    {
        $followers = $user->followers()->paginate($limit ? $limit : 10);
        return $followers;
    }
}
