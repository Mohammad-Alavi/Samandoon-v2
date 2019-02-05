<?php

return [
    'default'   => [
        'avatar'    =>  '/default_images/avatar.png',
        'avatar_thumb'    =>  '/default_images/avatar_thumb.png',
        'ngo_logo'    =>  '/default_images/ngo_logo.png',
        'ngo_logo_thumb'    =>  '/default_images/ngo_logo_thumb.png',
        'ngo_banner'    =>  '/default_images/ngo_banner.png',
        'ngo_banner_thumb'    =>  '/default_images/ngo_banner_thumb.png',
    ],
    'kyc_photo_labels'   => [
        'national_card_side_one'    =>  'national_card_side_one',
        'national_card_side_two'    =>  'national_card_side_two',
        'identity_paper'    =>  'identity_paper',
        'ngo_registration_doc'    =>  'ngo_registration_doc',
    ],
    'kyc_photo_status'   => [
        'invalid'    =>  'invalid',
        'verified'    =>  'verified',
        'sent'    =>  'sent',
    ],
    'ngo_verification_status'   => [
        'unverified'    =>  'unverified',
        'verified'    =>  'verified',
        'in_progress'    =>  'in_progress',
        'requested'    =>  'requested',
    ],


    'api_url' => env('API_URL', 'http://localhost'),
    'storage_path' => env('API_URL', 'http://localhost') . '/v1/storage',
    'storage_path_replace' => str_replace(['http://', 'https://'], '', env('APP_URL', 'http://localhost')) . '/storage',
];