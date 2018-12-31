<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Reset Password
    |--------------------------------------------------------------------------
    |
    | Insert your allowed reset password urls to inject into the email.
    |
    */
    'allowed-reset-password-urls' => [
        'password-reset',
    ],


    /*
   |--------------------------------------------------------------------------
   | Password Configurations
   |--------------------------------------------------------------------------
   |
   | Insert the length of auto generated password.
   |
   */
    'password'                    => [
        'one-time-password-length' => 5,
    ],


    /*
   |--------------------------------------------------------------------------
   | SMS Configurations
   |--------------------------------------------------------------------------
   |
   | Insert all tokens needed to send sms through `KAVE-NEGAR` sms provider
   |
   */
    'sms'                         => [
        'kavenegar' => [
            'api-key'                     => '53325932454A5273416461524C302B4E39576B5A4F6538796275507836776942',
            'password-verification-token' => 'kabootar-verify',
            'points-added-token' => 'ivisitor-payment-succeed',
        ]
    ],

];
