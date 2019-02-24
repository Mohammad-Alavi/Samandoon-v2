<?php

namespace App\Containers\Content\UI\API\Transformers;

use App\Containers\Content\Models\Content;
use App\Containers\User\Models\User;
use App\Containers\User\UI\API\Transformers\UserTransformer;
use App\Ship\Parents\Transformers\Transformer;

/**
 * Class ContentTransformer
 *
 * @package App\Containers\Content\UI\API\Transformers
 */
class ContentTransformer extends Transformer
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
     * @param Content $entity
     *
     * @return array
     */
    public function transform(Content $entity)
    {
        /** @var User $currentUser */
        $currentUser = auth('api')->user();

        $userTransform = new UserTransformer();
        /// Returns add-on transformers
        /// Generates add-on transformers automatically
        $addonArray = $this->addOnsTransformerGenerator($entity);

        $response = [
            'object' => 'Content',
            'id' => $entity->getHashedKey(),
            'created_at' => $entity->created_at,
            'updated_at' => $entity->updated_at,
            'add-on' => $addonArray['add-on'],
            'stats' => [
                'like_count' => $entity->likers->count(),
                'liked_by_current_user' => empty($currentUser) ? false : $entity->isLikedBy($currentUser->id),
                'comment_count' => $entity->comments->count(),
//            'seen_count' => $entity->getUniquePageViews(),
            ],
            'user' => $userTransform->transform($entity->user),
        ];

        $response = $this->ifAdmin([
            'real_id' => $entity->id,
            'deleted_at' => $entity->deleted_at,
        ], $response);

        return $response;
    }

    /**
     * @param Content $content
     *
     * @return mixed
     */
    private function addOnsTransformerGenerator(Content $content): array
    {
        $addOnTransformerArray['add-on'] = [];
        foreach (config('samandoon.available_add_ons') as $addOnName) {
            $addOnTransformerName = ucfirst($addOnName) . 'Transformer';
            // AddOn transformer full name with namespace
            $addOnTransformer = "App\Containers\\" . ucfirst($addOnName) . "\UI\API\Transformers\\" . $addOnTransformerName;
            // AddOn transformer class
            $addOnTransformer = new $addOnTransformer();
            // AddOn transformer array
            $addon = $content->$addOnName;
            $addOnTransformerArray['add-on'][$addOnName] = $addon ?
                $addOnTransformer->transform($addon) :
                null;
        }
        return $addOnTransformerArray;
    }
}