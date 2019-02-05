<?php

namespace App\Containers\User\Notifications;

use App\Ship\Parents\Notifications\Notification;
use Illuminate\Support\Facades\Config;

class OneTimePasswordGeneratedNotification extends Notification {

    /**
     * @var string
     */
    protected $password;

    /**
     * OneTimePasswordGeneratedNotification constructor.
     * @param string $password
     */
    public function __construct(string $password) {
        $this->password = $password;
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
        $template = Config::get('user-container.sms.kavenegar.password-verification-token');
        $tokens = [$this->password];

        return new KavenegarMessage($template, $tokens);
    }

}
