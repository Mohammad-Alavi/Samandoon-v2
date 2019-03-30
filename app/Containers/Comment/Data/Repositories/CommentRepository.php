<?php

namespace App\Containers\Comment\Data\Repositories;

use App\Containers\Comment\Models\Comment;
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

    public function findByContentId($content_id)
    {
        return Comment::where('content_id', $content_id)->paginate()->sortByDesc('created_at');
    }
}
