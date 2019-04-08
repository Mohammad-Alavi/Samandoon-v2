<?php

namespace App\Containers\Content\Notifications;

use App\Ship\Parents\Notifications\Notification;

/**
 * Class CommentedOnContentNotification
 */
class CommentedOnContentNotification extends Notification
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
