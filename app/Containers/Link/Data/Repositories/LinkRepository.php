<?php

namespace App\Containers\Link\Data\Repositories;

use App\Ship\Parents\Repositories\Repository;

/**
 * Class LinkRepository
 */
class LinkRepository extends Repository
{

    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id' => '=',
        // ...
    ];

}
