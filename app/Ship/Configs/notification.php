<?php

use App\Containers\FCM\Notifications\FCMChannel;

return [

    /*
     |--------------------------------------------------------------------------
     | Default Namespace
     |--------------------------------------------------------------------------
     |
     | Define what channels does all your notifications support.
     |
     */
    'channels' => [
        'database',
        FCMChannel::class,
//        'mail',
    ]

];
