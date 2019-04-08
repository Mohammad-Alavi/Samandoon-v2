<?php

namespace App\Containers\User\Data\Repositories;

use App\Ship\Parents\Repositories\Repository;

/**
 * Class FCMTokenRepository
 */
class FCMTokenRepository extends Repository
{

    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id' => '=',
        // ...
    ];

}
