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
        return ['database'];
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
