<?php

namespace App\Containers\User\Tasks;

use Apiato\Core\Abstracts\Exceptions\Exception;
use App\Containers\Comment\Notifications\CommentLikedNotification;
use App\Containers\Content\Models\Content;
use App\Containers\Content\Notifications\ContentLikedNotification;
use App\Containers\FCM\Notifications\FCMChannel;
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
     * @return Content
     * @throws \Exception
     */
    public function run(User $user, Content $content)
    {
        try {
            DB::beginTransaction();
            if (!$is_new_like = $user->hasLiked($content)) {
                $user->like($content);
                $is_new_like = true;
            }
            else {
                $is_new_like = false;
            }
        } catch (Exception $exception) {
            DB::rollBack();
            throw new UpdateResourceFailedException('Failed to like the specified resource');
        }
        DB::commit();
        // only send notification if someone beside the owner liked the resource
        if ($is_new_like && $user->id != $content->user->id) {
            // send/save notification to database and send to FCM
            $content->user->notifyNow(new ContentLikedNotification($user, $content), [FCMChannel::class, 'database']);
        }
        return $content->refresh();
    }
}
