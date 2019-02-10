<?php

namespace App\Containers\Storage\Data\Transporters;

use App\Ship\Parents\Transporters\Transporter;

class DownloadFileTransporter extends Transporter
{

    /**
     * @var array
     */
    protected $schema = [
        'type' => 'object',
        'properties' => [
            // enter all properties here
            'id',
            'resource_name'
            // allow for undefined properties
            // 'additionalProperties' => true,
        ],
        'required'   => [
            'id',
            'resource_name'
            // define the properties that MUST be set
        ],
        'default'    => [
            // provide default values for specific properties here
        ]
    ];
}
