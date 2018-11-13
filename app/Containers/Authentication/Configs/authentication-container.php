<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Email and Phone Confirmation
    |--------------------------------------------------------------------------
    | 
    | When set to true, the user must confirm its email or phone before being able to
    | Login, after registration.
    | 
    */

    'is_email_confirmation_required' => false,
    'is_phone_confirmation_required' => false,

    /*
    |--------------------------------------------------------------------------
    | Clients
    |--------------------------------------------------------------------------
    |
    | A list of clients that have access to the application.
    |
    */

    'clients' => [
        'web'    => [
            'admin' => [
                'id'     => env('CLIENT_WEB_ADMIN_ID'),
                'secret' => env('CLIENT_WEB_ADMIN_SECRET'),
            ],
        ],
        'mobile' => [
            'admin' => [
                'id'     => env('CLIENT_MOBILE_ADMIN_ID'),
                'secret' => env('CLIENT_MOBILE_ADMIN_SECRET'),
            ],
        ],

        // add your other clients here
    ],


    'login' => [
        /*
        |--------------------------------------------------------------------------
        | Prefix
        |--------------------------------------------------------------------------
        |
        | Use this $prefix variable in order to allow for nested elements.
        | For example, if your login fields are nested in "data.attributes.name / data.attributes.email"
        | simply est the $prefix to "data.attributes." and you are good go to!
        |
        | Default: ''
        |
        */
        'prefix'                           => '',

        /*
        |--------------------------------------------------------------------------
        | Allowed Login Attributes
        |--------------------------------------------------------------------------
        |
        | A list of fields the user is allowed to login with.
        |
        | The order determines the order the fields are tested to login (in case multiple fields are submitted!
        |
        | Default: ['email']
        |
        */
        'allowed_login_username_types'     => [
            'email',
            //'phone',
        ],
        'allowed_login_password_type'      => 'password', //  must be 'password' or 'one_time_password'


        /*
         * Any 'one time password' will expire after a while when it is generated.
         *
         * This value defines the life time of a 'one time password' (in seconds).
         * e.g: 120 (which means 2 minutes)
         *
         */
        'one_time_password_expiration_age' => 12000,
    ],

];
