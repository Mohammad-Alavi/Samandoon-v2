<?php

namespace App\Containers\Article\UI\API\Controllers;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Article\UI\API\Requests\CreateArticleRequest;
use App\Containers\Article\UI\API\Requests\GetAllArticlesRequest;
use App\Containers\Article\UI\API\Requests\GetArticleRequest;
use App\Containers\Article\UI\API\Requests\UpdateArticleRequest;
use App\Containers\Article\UI\API\Transformers\ArticleTransformer;
use App\Ship\Parents\Controllers\ApiController;
use App\Ship\Transporters\DataTransporter;

class Controller extends ApiController {

    /**
     * @param CreateArticleRequest $request
     *
     * @return array
     */
    public function createArticle(CreateArticleRequest $request) {
        $article = Apiato::call('Article@CreateArticleAction', [new DataTransporter($request)]);

        return $this->transform($article, ArticleTransformer::class);
    }

    /**
     * @param UpdateArticleRequest $request
     *
     * @return array
     */
    public function updateArticle(UpdateArticleRequest $request) {
        $article = Apiato::call('Article@UpdateArticleAction', [new DataTransporter($request)]);

        return $this->transform($article, ArticleTransformer::class);
    }

    /**
     * @param GetArticleRequest $request
     *
     * @return array
     */
    public function getArticle(GetArticleRequest $request) {
        $article = Apiato::call('Article@GetArticleAction', [new DataTransporter($request)]);

        return $this->transform($article, ArticleTransformer::class);
    }

    public function getAllArticles(GetAllArticlesRequest $request)
    {
        $article = Apiato::call('Article@GetAllArticlesAction', [new DataTransporter($request)]);
        return $this->transform($article, ArticleTransformer::class);
    }
}
