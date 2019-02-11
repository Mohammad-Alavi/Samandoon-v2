<?php

namespace App\Containers\User\Tasks;

use App\Containers\User\Models\User;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;
use Illuminate\Support\Facades\DB;

class FollowTask extends Task
{
    /**
     * @throws \Exception
     */
    public function run(User $user, User $target)
    {
        try {
            DB::beginTransaction();
            $user->follow($target->id);
        } catch (Exception $exception) {
            DB::rollBack();
            throw new UpdateResourceFailedException('Failed to follow the specified user');
        }
        DB::commit();

        return [
            'followers_count' => $target->followers()->count(),
            'is_following' => $user->isFollowing($target->id),
        ];
    }
}
