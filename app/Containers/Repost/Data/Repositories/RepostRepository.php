<?php

namespace App\Containers\Repost\Data\Repositories;

use App\Ship\Parents\Repositories\Repository;

/**
 * Class RepostRepository
 */
class RepostRepository extends Repository
{

    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id' => '=',
        // ...
    ];

}
