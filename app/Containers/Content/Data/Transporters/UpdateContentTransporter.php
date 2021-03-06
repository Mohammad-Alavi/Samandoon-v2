<?php

namespace App\Containers\Content\Data\Transporters;

use App\Ship\Parents\Transporters\Transporter;

/**
 * Class UpdateContentTransporter
 *
 * @package App\Containers\Content\Data\Transporters
 */
class UpdateContentTransporter extends Transporter
{

    /**
     * @var array
     */
    protected $schema = [
        'type' => 'object',
        'properties' => [
            // enter all properties here

            // allow for undefined properties
            // 'additionalProperties' => true,
        ],
        'required' => [
            // define the properties that MUST be set
        ],
        'default' => [
            // provide default values for specific properties here
        ],
    ];
}
