<?php

namespace App\Containers\Link\UI\API\Transformers;

use App\Containers\Link\Models\Link;
use App\Ship\Parents\Transformers\Transformer;
use Vinkla\Hashids\Facades\Hashids;

/**
 * Class LinkTransformer
 *
 * @package App\Containers\Link\UI\API\Transformers
 */
class LinkTransformer extends Transformer
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
     * @param Link $entity
     *
     * @return array
     */
    public function transform(Link $entity)
    {
        $response = [
            'object' => 'Link',
            'id' => $entity->getHashedKey(),
            'link_url' => $entity->link_url,
            'content_id' => Hashids::encode($entity->content_id),
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
