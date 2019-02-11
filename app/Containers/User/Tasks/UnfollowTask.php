<?php

namespace App\Containers\User\Tasks;

use App\Containers\User\Models\User;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;
use Illuminate\Support\Facades\DB;

class UnfollowTask extends Task
{
    /**
     * @param User $user
     * @param User $target
     *
     * @return array
     * @throws \Exception
     */
    public function run(User $user, User $target)
    {
        try {
            DB::beginTransaction();
            $user->unfollow($target->id);
        } catch (Exception $exception) {
            DB::rollBack();
            throw new UpdateResourceFailedException('Failed to unfollow the specified user');
        }
        DB::commit();

        return [
            'followers_count' => $target->followers()->count(),
            'is_following' => $user->isFollowing($target->id),
        ];
    }
}
