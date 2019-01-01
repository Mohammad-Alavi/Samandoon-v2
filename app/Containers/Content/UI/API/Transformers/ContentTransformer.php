<?php

namespace App\Containers\Content\UI\API\Transformers;

use App\Containers\Article\UI\API\Transformers\ArticleTransformer;
use App\Containers\Content\Models\Content;
use App\Containers\Repost\UI\API\Transformers\RepostTransformer;
use App\Ship\Parents\Transformers\Transformer;

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
        /// Add-on transformers
        $article = new ArticleTransformer();
        $repost = new RepostTransformer();

        $response = [
            'object' => 'Content',
            'id' => $entity->getHashedKey(),
            'created_at' => $entity->created_at,
            'updated_at' => $entity->updated_at,
            'deleted_at' => $entity->deleted_at,
            'add-on' => [
                'article' => $entity->article()->first() ? $article->transform($entity->article()->first()) : null,
                'repost' => $entity->repost()->first() ? $repost->transform($entity->repost()->first()) : null,
            ]
        ];

        $response = $this->ifAdmin([
            'real_id' => $entity->id,
            // 'deleted_at' => $entity->deleted_at,
        ], $response);

        return $response;
    }
}
