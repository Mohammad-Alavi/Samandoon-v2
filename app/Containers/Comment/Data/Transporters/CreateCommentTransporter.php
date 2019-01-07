<?php

namespace App\Containers\Comment\Data\Transporters;

use App\Ship\Parents\Transporters\Transporter;

class CreateCommentTransporter extends Transporter
{

    /**
     * @var array
     */
    protected $schema = [
        'type' => 'object',
        'properties' => [
            'body',
            'content_id',
            'user_id',
            'parent_id',
            // allow for undefined properties
            // 'additionalProperties' => true,
        ],
        'required'   => [
            'body',
            'content_id',
            'user_id',
            // define the properties that MUST be set
        ],
        'default'    => [
            // provide default values for specific properties here
        ]
    ];
}
