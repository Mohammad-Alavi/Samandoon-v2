<?php

namespace App\Containers\User\Notifications;

use App\Containers\User\Models\User;
use App\Ship\Parents\Notifications\Notification;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Config;

class KavenegarChannel {

    /**
     * @param User $notifiable
     * @param Notification $notification
     */
    public function send(User $notifiable, Notification $notification) {
        $array = $notification->toKavenegar($notifiable);

        $client = new Client();
        $params = [
            'query' => ['template' => $array['template'],
                        'receptor' => $notifiable->phone,
                        'token'    => $array['tokens'][0] ?? null,
                        'token2'   => $array['tokens'][1] ?? null,
                        'token3'   => $array['tokens'][2] ?? null,
                        'token4'   => $array['tokens'][3] ?? null,
                        'token5'   => $array['tokens'][4] ?? null,
            ]
        ];
        $sms_api_key = Config::get('user-container.sms.api-key');
        $client->get('http://api.kavenegar.com/v1/' . $sms_api_key . '/verify/lookup.json', $params);
    }
}