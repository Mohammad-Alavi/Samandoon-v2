<?php

namespace App\Containers\Comment\Tasks;

use Apiato\Core\Abstracts\Exceptions\Exception;
use App\Containers\Comment\Models\Comment;
use App\Containers\Comment\Notifications\CommentLikedNotification;
use App\Containers\FCM\Notifications\FCMChannel;
use App\Containers\User\Models\User;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Illuminate\Support\Facades\DB;

class LikeCommentTask extends Task
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
            if (!$is_new_like = $user->hasLiked($comment)) {
                $user->like($comment);
                $is_new_like = true;
            }
            else {
                $is_new_like = false;
            }
        } catch (Exception $exception) {
            DB::rollBack();
            throw new UpdateResourceFailedException('Failed to like the specified comment: ');
        }
        DB::commit();
        // only send notification if someone beside the owner liked the resource
        if ($is_new_like && $user->id != $comment->user->id) {
            // send/save notification to database and send to FCM
            $comment->user->notifyNow(new CommentLikedNotification($user, $comment), [FCMChannel::class, 'database']);
        }
        return $comment->refresh();
    }
}
