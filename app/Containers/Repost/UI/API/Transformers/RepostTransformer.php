<?php

namespace App\Containers\Repost\UI\API\Transformers;

use App\Containers\Repost\Models\Repost;
use App\Ship\Parents\Transformers\Transformer;
use Vinkla\Hashids\Facades\Hashids;

/**
 * Class RepostTransformer
 *
 * @package App\Containers\Repost\UI\API\Transformers
 */
class RepostTransformer extends Transformer
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
     * @param Repost $entity
     *
     * @return array
     */
    public function transform(Repost $entity)
    {
        $response = [
            'object' => 'Repost',
            'id' => $entity->getHashedKey(),
            'content_id' => Hashids::encode($entity->content_id),
            'referenced_content_id' => Hashids::encode($entity->referenced_content_id),
            'created_at' => $entity->created_at,
            'updated_at' => $entity->updated_at,
        ];

        $response = $this->ifAdmin([
            'real_id' => $entity->id,
             'deleted_at' => $entity->deleted_at,
        ], $response);

        return $response;
    }
}
