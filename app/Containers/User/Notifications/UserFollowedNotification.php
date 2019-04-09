<?php

namespace App\Containers\User\Notifications;

use App\Ship\Parents\Notifications\Notification;
use Benwilkins\FCM\FcmMessage;

/**
 * Class UserFollowedNotification
 */
class UserFollowedNotification extends Notification
{
    protected $doer;

    public function __construct($doer)
    {
        $this->doer = $doer;
    }

    public function via($notifiable)
    {
        return ['fcm', 'database'];
    }

    public function toFcm($notifiable)
    {
        $message = new FcmMessage();
        $message->content([
            'title' => 'سمندون',
            'body' => '[' . $notifiable->nick_name . ']' . ' شما را دنبال کرد',
            'sound' => 'default', // Optional
            'icon' => '', // Optional
            'click_action' => '' // Optional
        ])->data([
            'param1' => 'baz' // Optional
        ])->priority(FcmMessage::PRIORITY_HIGH); // Optional - Default is 'normal'.

        return $message;
    }

    public function toDatabase($notifiable)
    {
        return [
            'doer_id' => $this->doer->id,
            'doer_name' => $this->doer->nick_name,
            'object_id' => $notifiable->id,
            'object_text' => $notifiable->nick_name,
        ];
    }
}
