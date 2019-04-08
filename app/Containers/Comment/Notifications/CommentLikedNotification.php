<?php

namespace App\Containers\Comment\Notifications;

use App\Ship\Parents\Notifications\Notification;

/**
 * Class CommentLikedNotification
 */
class CommentLikedNotification extends Notification
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
