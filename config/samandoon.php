<?php

return [
    // All addon names should be in lowercase
    'available_add_ons' => [
        'article' => 'article',
        'repost' => 'repost',
        'link' => 'link',
        'image' => 'image',
        'subject' => 'subject',
    ],

    // tag types used when storing tags in DB
    'tag_type' => [
        'content' => 'content',
        'subject' => 'subject',
    ],

    /*
   |--------------------------------------------------------------------------
   | Action to perform on addon
   |--------------------------------------------------------------------------
   |
   */
    'action_to_perform_on_addon' => [
        'create' => 'create',
        'update' => 'update',
        'delete' => 'delete',
    ],
    
    'default'   => [
        'avatar'    =>  '/default_images/avatar.png',
        'avatar_thumb'    =>  '/default_images/avatar_thumb.png',
    ],

    'api_url' => env('API_URL', 'http://localhost'),
    'storage_path' => env('API_URL', 'http://localhost') . '/v1/storage',
    'storage_path_replace' => str_replace(['http://', 'https://'], '', env('APP_URL', 'http://localhost')) . '/storage',
];