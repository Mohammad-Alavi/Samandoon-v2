<?php

namespace App\Containers\Comment\Notifications;

use App\Containers\FCM\Actions\DownstreamResponseHandlerAction;
use App\Containers\FCM\Tasks\GetAllUserFCMTokensTask;
use App\Ship\Parents\Notifications\Notification;
use Illuminate\Support\Facades\App;
use LaravelFCM\Facades\FCM;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;

/**
 * Class CommentLikedNotification
 */
class CommentLikedNotification extends Notification
{
    protected $doer;
    protected $comment;

    /**
     * UserFollowedNotification constructor.
     *
     * @param $doer
     * @param $comment
     */
    public function __construct($doer, $comment)
    {
        $this->doer = $doer;
        $this->comment = $comment;
    }

    /**
     * @param $notifiable
     */
    public function toFCM($notifiable)
    {
        // set fcm options
        $optionBuilder = new OptionsBuilder();
        $optionBuilder->setTimeToLive(60 * 20);

        // create notification payload
        $notificationBuilder = new PayloadNotificationBuilder('سمندون');
        $notificationBuilder->setBody('[' . $this->doer->nick_name . ']' . ' نظر شما را پسندید: ' . '"' . $this->comment->body . '"')
//        $notificationBuilder->setBody('[' . $this->doer->nick_name . ']' . ' نظر شما را پسندید')
            ->setSound('default');

        // create data payload
        $dataBuilder = new PayloadDataBuilder();
        $dataBuilder->addData(['a_data' => 'my_data']);

        // build those top three ^
        $option = $optionBuilder->build();
        $notification = $notificationBuilder->build();
        $data = $dataBuilder->build();

        // get all user fcm tokens
        /** @var GetAllUserFCMTokensTask $getAllUserFCMTokensTask */
        $getAllUserFCMTokensTask = App::make(GetAllUserFCMTokensTask::class);
        $tokens = $getAllUserFCMTokensTask->run($notifiable->id);

        // if user have any fcm token then send the notification to them
        if (!empty($tokens)) {
            // send notification to fcm
            /** @var FCM $downstreamResponse */
            $downstreamResponse = FCM::sendTo($tokens, $option, $notification, $data);

            // handle the downstream response: errors, modified tokens, invalid tokens, etc...
            /** @var DownstreamResponseHandlerAction $downstreamResponseHandlerAction */
            $downstreamResponseHandlerAction = App::make(DownstreamResponseHandlerAction::class);
            $downstreamResponseHandlerAction->run($downstreamResponse);
        }

    }

    public function toDatabase($notifiable)
    {
        return [
            'doer_id' => $this->doer->id,
            'doer_name' => $this->doer->nick_name,
            'object_id' => $this->comment->id,
            'object_text' => $this->comment->body,
        ];
    }
}
