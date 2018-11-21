<?php

namespace App\Containers\Content\UI\API\Transformers;

use App\Containers\Article\Data\Transporters\CreateArticleTransporter;
use App\Containers\Article\UI\API\Transformers\ArticleTransformer;
use App\Containers\Content\Models\Content;
use App\Ship\Parents\Transformers\Transformer;
use Illuminate\Support\Facades\App;

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

        $response = [
            'object' => 'Content',
            'id' => $entity->getHashedKey(),
            'created_at' => $entity->created_at,
            'updated_at' => $entity->updated_at,
            'deleted_at' => $entity->deleted_at,
            'add-on' => [
                'article' => $article->transform($entity->article()->first())
            ]
        ];

        $response = $this->ifAdmin([
            'real_id'    => $entity->id,
            // 'deleted_at' => $entity->deleted_at,
        ], $response);

        return $response;
    }
}
