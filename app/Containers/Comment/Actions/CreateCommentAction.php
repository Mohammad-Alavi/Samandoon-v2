<?php

namespace App\Containers\Comment\Actions;

use App\Containers\Authentication\Tasks\GetAuthenticatedUserTask;
use App\Containers\Comment\Tasks\CreateCommentTask;
use App\Containers\Content\Notifications\CommentedOnContentNotification;
use App\Containers\FCM\Notifications\FCMChannel;
use App\Containers\User\Models\User;
use App\Ship\Helpers\ArabicToPersianStringConverter;
use App\Ship\Parents\Actions\Action;
use App\Ship\Transporters\DataTransporter;

class CreateCommentAction extends Action
{
    private $createCommentTask;
    private $getAuthenticatedUserTask;

    /**
     * CreateCommentAction constructor.
     *
     * @param CreateCommentTask $createCommentTask
     */
    public function __construct(CreateCommentTask $createCommentTask, GetAuthenticatedUserTask $getAuthenticatedUserTask)
    {
        $this->createCommentTask = $createCommentTask;
        $this->getAuthenticatedUserTask = $getAuthenticatedUserTask;
    }

    /**
     * @param DataTransporter $transporter
     *
     * @return mixed
     */
    public function run(DataTransporter $transporter)
    {
        /** @var User $authenticated_user */
        $authenticated_user = $this->getAuthenticatedUserTask->run();
        $transporter->user_id = $authenticated_user->id;
        $data = $transporter->sanitizeInput([
            'body',
            'user_id',
            'content_id',
            'parent_id',
        ]);

        $data['body'] = ArabicToPersianStringConverter::Convert($data['body']);

        $comment = $this->createCommentTask->run($data);

        // only send notification if someone beside the owner commented on the resource
        if ($authenticated_user->id != $comment->content->user->id) {
            // send/save notification to database and send to FCM
            $comment->content->user->notifyNow(new CommentedOnContentNotification($comment->user, $comment), [FCMChannel::class, 'database']);
        }

        return $comment;
    }
}
