<?php

namespace App\Containers\User\Notifications;

use App\Ship\Parents\Notifications\Notification;

/**
 * Class UserFollowedNotification
 */
class UserFollowedNotification extends Notification
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
