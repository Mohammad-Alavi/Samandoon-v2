<?php

return [
    'default'   => [
        'avatar'    =>  '/default_images/avatar.png',
        'avatar_thumb'    =>  '/default_images/avatar_thumb.png',
    ],

    'api_url' => env('API_URL', 'http://localhost'),
    'storage_path' => env('API_URL', 'http://localhost') . '/v1/storage',
    'storage_path_replace' => str_replace(['http://', 'https://'], '', env('APP_URL', 'http://localhost')) . '/storage',
];