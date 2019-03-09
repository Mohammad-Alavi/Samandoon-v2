<?php

namespace App\Containers\Comment\Tasks;

use Apiato\Core\Abstracts\Exceptions\Exception;
use App\Containers\Comment\Models\Comment;
use App\Containers\User\Models\User;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Illuminate\Support\Facades\DB;

class UnlikeCommentTask extends Task
{
    /**
     * @param User    $user
     * @param Comment $comment
     *
     * @return Comment
     * @throws \Exception
     */
    public function run(User $user, Comment $comment)
    {
        try {
            DB::beginTransaction();
            if (!$is_liked = $user->hasLiked($comment)) {
                $user->like($comment);
                $is_liked = true;
                if ($user->id == $comment->user->id) {
                    // TODO DON'T NOTIFY USER IF HE LIKE HIS OWN CONTENT
                }
            }
        } catch (Exception $exception) {
            DB::rollBack();
            throw new UpdateResourceFailedException('Failed to unlike the specified comment');
        }
        DB::commit();

        return $comment;
    }
}
