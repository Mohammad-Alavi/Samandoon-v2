<?php

namespace App\Containers\Comment\Data\Repositories;

use App\Ship\Parents\Repositories\Repository;

/**
 * Class CommentRepository
 */
class CommentRepository extends Repository
{

    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id' => '=',
        // ...
    ];

}
