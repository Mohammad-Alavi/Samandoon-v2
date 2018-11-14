<?php

namespace App\Containers\Article\UI\API\Transformers;

use App\Containers\Article\Models\Article;
use App\Ship\Parents\Transformers\Transformer;

class ArticleTransformer extends Transformer
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
     * @param Article $article
     *
     * @return array
     */
    public function transform(Article $article)
    {
        $response = [
            'object' => 'Article',
            'id' => $article->getHashedKey(),
            'title' => $article->title,
            'text' => $article->text,
            'created_at' => $article->created_at,
            'updated_at' => $article->updated_at,

        ];

        $response = $this->ifAdmin([
            'real_id'    => $article->id,
            // 'deleted_at' => $entity->deleted_at,
        ], $response);

        return $response;
    }
}
