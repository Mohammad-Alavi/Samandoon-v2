<?php

namespace App\Containers\Comment\UI\API\Transformers;

use App\Containers\Comment\Models\Comment;
use App\Containers\User\Models\User;
use App\Containers\User\UI\API\Transformers\UserTransformer;
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
        /** @var UserTransformer $userTransformer */
        $userTransformer = new UserTransformer();

        /** @var User $currentUser */
        $currentUser = auth('api')->user();

        $response = [
            'object' => 'Comment',
            'id' => $entity->getHashedKey(),
            'body' => $entity->body,
            'content_id' => Hashids::encode($entity->content_id),
            'parent_id' => $entity->parent_id ? Hashids::encode($entity->parent_id) : null,
            'stats' => [
                // counts
                'like_count' => $entity->likers()->count(),
                // when you are in another users profile it show if you are {x}ed that user
                'liked_by_me' => is_null($currentUser) ? false : $entity->isLikedBy($currentUser->id),
            ],
            'updated_at' => $entity->updated_at,
            'created_at' => $entity->created_at,
            'user' => $userTransformer->transform($entity->user),
        ];

        $response = $this->ifAdmin([
            'real_id' => $entity->id,
            'deleted_at' => $entity->deleted_at,
        ], $response);

        return $response;
    }
}
