<?php

namespace App\Containers\User\Tasks;

use App\Containers\Content\Models\Content;
use App\Containers\User\Models\User;
use App\Ship\Exceptions\DeleteResourceFailedException;
use App\Ship\Parents\Exceptions\Exception;
use App\Ship\Parents\Tasks\Task;

class GetUserFeedTask extends Task
{
    /**
     * @param User $user
     * @param      $limit
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function run(User $user, $limit)
    {
        try {
            $followingsIds = $user->followings()->allRelatedIds()->toArray();
            $feed = Content::whereIn('user_id', $followingsIds)
                ->orderByDesc('created_at')
                ->paginate($limit ? $limit : 10);

            return $feed;
        } catch (Exception $exception) {
            throw new DeleteResourceFailedException();
        }
    }
}
