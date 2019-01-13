<?php

namespace App\Containers\User\Notifications;

use App\Ship\Parents\Notifications\Notification;
use Illuminate\Support\Facades\Config;

class PointsAddedNotification extends Notification {

    /**
     * @var string
     */
    protected $points;

    /**
     * OneTimePasswordGeneratedNotification constructor.
     *
     * @param string $points
     */
    public function __construct(string $points) {
        $this->points = $points;
    }

    /**
     * @param $notifiable
     * @return array
     */
    public function toArray($notifiable) {
        return [
            // ...
        ];
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function via($notifiable) {
        return [
            KavenegarChannel::class
        ];
    }

    /**
     * @return KavenegarMessage
     */
    public function toKavenegar(): KavenegarMessage {
        $template = Config::get('user-container.sms.kavenegar.points-added-token');
        $tokens = [$this->points];

        return new KavenegarMessage($template, $tokens);
    }

}
