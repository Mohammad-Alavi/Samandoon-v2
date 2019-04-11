<?php

namespace App\Containers\FCM\Notifications;

use App\Ship\Parents\Notifications\Notification;

class FCMChannel
{
    /**
     * @param              $notifiable
     * @param Notification $notification
     */
    public function send($notifiable, Notification $notification)
    {
        $message = $notification->toFCM($notifiable);
    }
}