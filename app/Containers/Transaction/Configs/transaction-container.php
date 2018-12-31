<?php

return [

    /*
    |--------------------------------------------------------------------------
    |  Gateway config
    |--------------------------------------------------------------------------
    |
    |   Basic data of the gateway
    |
    */
    'gateway'        => [
        'default'  => 'zarinpal',

        'zarinpal' => [
            'name'                => 'zarinpal',
            'merchant_id'         => '34d1693c-7630-11e8-9d1b-005056a205be',
            'payment_pre_address' => 'https://www.zarinpal.com/pg/StartPay/',
        ],
//        'XXpay' => [
//            'name'                => 'xxPay',
//            'merchant_id'         => '0000-1111-2222-4444-7777',
//            'payment_pre_address' => 'https://www.xxpay.com/StartPay/',
//        ],
    ],


    /*
    |--------------------------------------------------------------------------
    |  Tax Percentage
    |--------------------------------------------------------------------------
    |
    |   Tax percentage is the amount gets added to users transaction.
    |
    |   It must be an integer between 0-100
    |
    */
    'tax-percentage' => '9'

];
