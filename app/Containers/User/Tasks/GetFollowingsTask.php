<?php

namespace App\Containers\User\Tasks;

use App\Containers\User\Models\User;
use App\Ship\Parents\Tasks\Task;

class GetFollowingsTask extends Task
{
    /**
     * @param User $user
     * @param      $limit
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function run(User $user, $limit)
    {
        $followings = $user->followings()->paginate($limit ? $limit : 10);
        return $followings;
    }
}
