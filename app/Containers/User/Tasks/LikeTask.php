<?php

namespace App\Containers\User\Tasks;

use Apiato\Core\Abstracts\Exceptions\Exception;
use App\Containers\Content\Models\Content;
use App\Containers\User\Models\User;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Illuminate\Support\Facades\DB;

class LikeTask extends Task
{
    /**
     * @param User    $user
     * @param Content $content
     *
     * @return array
     * @throws \Exception
     */
    public function run(User $user, Content $content)
    {
        try {
            DB::beginTransaction();
            if (!$is_liked = $user->hasLiked($content)) {
                $user->like($content);
                $is_liked = true;
                if ($user->id == $content->user->id) {
                    // TODO DON'T NOTIFY USER IF HE LIKE HIS OWN CONTENT
                }
            }
        } catch (Exception $exception) {
            DB::rollBack();
            throw new UpdateResourceFailedException('Failed to like the specified resource');
        }
        DB::commit();

        return ['user' => $user, 'content' => $content, 'is_liked' => $is_liked];
    }
}
