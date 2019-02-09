<?php

namespace App\Containers\Image\Data\Repositories;

use App\Ship\Parents\Repositories\Repository;

/**
 * Class ImageRepository
 */
class ImageRepository extends Repository
{

    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id' => '=',
        // ...
    ];

}
