<?php

namespace App\Containers\Article\Data\Transporters;

use App\Ship\Parents\Transporters\Transporter;

class CreateArticleTransporter extends Transporter
{

    /**
     * @var array
     */
    protected $schema = [
        'type' => 'object',
        'properties' => [
            // enter all properties here
            'title',
            'text',
            // allow for undefined properties
            // 'additionalProperties' => true,
        ],
        'required'   => [
            'title',
            'text',
            // define the properties that MUST be set
        ],
        'default'    => [
            // provide default values for specific properties here
        ]
    ];
}
