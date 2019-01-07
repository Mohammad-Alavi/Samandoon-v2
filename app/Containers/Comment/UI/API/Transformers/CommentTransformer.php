<?php

namespace App\Containers\Comment\UI\API\Transformers;

use App\Containers\Comment\Models\Comment;
use App\Ship\Parents\Transformers\Transformer;
use Vinkla\Hashids\Facades\Hashids;

class CommentTransformer extends Transformer
{
    /**
     * @var  array
     */
    protected $defaultIncludes = [

    ];

    /**
     * @var  array
     */
    protected $availableIncludes = [

    ];

    /**
     * @param Comment $entity
     *
     * @return array
     */
    public function transform(Comment $entity)
    {
        $response = [
            'object' => 'Comment',
            'id' => $entity->getHashedKey(),
            'body' => $entity->body,
            'content_id' => Hashids::encode($entity->content_id),
            'user_id' => Hashids::encode($entity->user_id),
            'parent_id' => $entity->parent_id ? Hashids::encode($entity->parent_id) : null,
            'created_at' => $entity->created_at,
            'updated_at' => $entity->updated_at,

        ];

        $response = $this->ifAdmin([
            'real_id'    => $entity->id,
             'deleted_at' => $entity->deleted_at,
        ], $response);

        return $response;
    }
}
