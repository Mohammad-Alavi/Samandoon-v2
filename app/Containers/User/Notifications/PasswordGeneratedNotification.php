<?php

namespace App\Containers\User\Notifications;

use App\Ship\Parents\Notifications\Notification;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Config;

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

    /*
     *
     *                      IMPORTANT TO KNOW:
     *
     *                      SMS channel is not working and it might be a temporary bug!
     *                      This is why we are using mail channel to send SMS
     *                      and it makes no sense!
     *
     */

    public function via($notifiable) {
        return [
            'mail'
        ];
    }

    public function toMail($notifiable) {
        $client = new Client();
        $params = [
            'query' => ['template' => Config::get('user-container.sms-template'),
                        'receptor' => $notifiable->phone,
                        'token'    => $this->password
            ]
        ];
        $sms_api_key = Config::get('user-container.sms-api-key');
        $res = $client->get('http://api.kavenegar.com/v1/' . $sms_api_key . '/verify/lookup.json', $params);
    }

}
