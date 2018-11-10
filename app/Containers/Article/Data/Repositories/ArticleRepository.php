<?php

namespace App\Containers\Article\Data\Repositories;

use App\Ship\Parents\Repositories\Repository;

/**
 * Class ArticleRepository
 */
class ArticleRepository extends Repository
{

    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id' => '=',
        // ...
    ];

}
