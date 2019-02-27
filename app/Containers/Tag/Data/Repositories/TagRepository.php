<?php

namespace App\Containers\Tag\Data\Repositories;

use App\Ship\Parents\Repositories\Repository;

/**
 * Class TagRepository
 */
class TagRepository extends Repository
{

    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id' => '=',
        // ...
    ];

}
