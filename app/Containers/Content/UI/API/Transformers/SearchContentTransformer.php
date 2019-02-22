<?php

namespace App\Containers\Content\UI\API\Transformers;

use App\Containers\Article\Models\Article;
use App\Ship\Parents\Transformers\Transformer;

class SearchContentTransformer extends Transformer
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
     * @param Article $entity
     *
     * @return array
     */
    public function transform(Article $entity)
    {
        $contentTransformer = new ContentTransformer();

        $response = $contentTransformer->transform($entity->content);

        $response = $this->ifAdmin([
            'real_id'    => $entity->id,
            'deleted_at' => $entity->deleted_at,
        ], $response);

        return $response;
    }
}
