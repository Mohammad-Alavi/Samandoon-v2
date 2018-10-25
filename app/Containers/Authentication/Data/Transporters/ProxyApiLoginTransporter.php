<?php

namespace App\Containers\Authentication\Data\Transporters;

use App\Ship\Parents\Transporters\Transporter;

class ProxyApiLoginTransporter extends Transporter {

    /**
     * @var array
     */
    protected $schema = [
        'type' => 'object',
        'properties' => [
            'email',
            // 'name',
            'phone',

            'password',
            'client_id',
            'client_password',
            'grant_type',
            'scope',
        ],
        'required'   => [
            'password',
            'client_id',
            'client_password',
        ],
        'default'    => [
            'scope' => '',
        ]
    ];
}
