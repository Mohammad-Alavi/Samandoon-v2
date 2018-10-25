<?php

namespace App\Containers\User\Notifications;

use App\Ship\Parents\Notifications\Notification;
use GuzzleHttp\Client;

/**
 * Class PasswordGeneratedNotification
 */
class PasswordGeneratedNotification extends Notification {

    protected $password;

    public function __construct($password) {
        $this->password = $password;
    }

    public function toArray($notifiable) {
        return [
            // ...
        ];
    }

    public function via($notifiable) {
        return [
            'mail'
        ];
    }

    public function toMail($notifiable) {
        $client = new Client();
        $params = [
            'query' => ['template' => 'verify-ivisitor',
                        'receptor' => $notifiable->phone,
                        'token'    => $this->password
            ]
        ];
        $res = $client->get('https://api.kavenegar.com/v1/53325932454A5273416461524C302B4E39576B5A4F6538796275507836776942/verify/lookup.json', $params);
    }

}
