<?php

namespace App\Containers\Content\Notifications;

use App\Ship\Parents\Notifications\Notification;

/**
 * Class ContentLikedNotification
 */
class ContentLikedNotification extends Notification
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
