<?php

namespace App\Containers\User\Notifications;

use App\Containers\User\Models\User;
use App\Ship\Parents\Notifications\Notification;
use Illuminate\Support\Facades\Config;

class PasswordGeneratedNotification extends Notification {

    /**
     * @var string
     */
    protected $password;

    /**
     * PasswordGeneratedNotification constructor.
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
     * @param User $notifiable
     * @return array
     */
    public function toKavenegar(User $notifiable) {

        return [
            'tokens' => [$this->password],
            'template' => Config::get('user-container.sms.password-verification-token')
        ];
    }

}
