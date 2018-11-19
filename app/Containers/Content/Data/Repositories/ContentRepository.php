<?php

namespace App\Containers\Content\Data\Repositories;

use App\Ship\Parents\Repositories\Repository;

/**
 * Class ContentRepository
 */
class ContentRepository extends Repository
{

    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id' => '=',
        // ...
    ];

}
