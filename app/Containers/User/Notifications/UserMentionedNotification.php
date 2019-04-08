<?php

namespace App\Containers\User\Notifications;

use App\Ship\Parents\Notifications\Notification;

/**
 * Class UserMentionedNotification
 */
class UserMentionedNotification extends Notification
{

    public function __construct()
    {
        // ..
    }

    public function toArray($notifiable)
    {
        return [
            // ...
        ];
    }
}
