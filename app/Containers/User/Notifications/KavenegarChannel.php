<?php

namespace App\Containers\User\Notifications;

use App\Containers\User\Models\User;
use App\Ship\Parents\Notifications\Notification;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Config;

class KavenegarChannel {

    /**
     * @var KavenegarMessage
     */
    protected $kavenegarMessage;

    /**
     * @param User $notifiable
     * @param Notification $notification
     */
    public function send(User $notifiable, Notification $notification) {
        $this->kavenegarMessage = $notification->toKavenegar();

        $client = new Client();
        $params = [
            'query' => ['template' => $this->kavenegarMessage->template,
                        'receptor' => $notifiable->phone,
                        'token'    => $this->kavenegarMessage->tokens[0] ?? null,
                        'token2'   => $this->kavenegarMessage->tokens[1] ?? null,
                        'token3'   => $this->kavenegarMessage->tokens[2] ?? null,
                        'token4'   => $this->kavenegarMessage->tokens[3] ?? null,
                        'token5'   => $this->kavenegarMessage->tokens[4] ?? null,
            ]
        ];
        $sms_api_key = Config::get('user-container.sms.api-key');
        $client->get('http://api.kavenegar.com/v1/' . $sms_api_key . '/verify/lookup.json', $params);
    }
}