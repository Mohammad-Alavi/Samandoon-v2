<?php

namespace App\Containers\Article\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Article\Models\Article;
use App\Containers\Article\Tasks\UpdateArticleTask;
use App\Containers\Content\Models\Content;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Actions\SubAction;
use App\Ship\Transporters\DataTransporter;

class UpdateArticleSubAction extends SubAction {

    protected $updateArticleTask;

    public function __construct(UpdateArticleTask $updateArticleTask)
    {
        $this->updateArticleTask = $updateArticleTask;
    }

    /**
     * @param array $data
     *
     * @param Content $content
     * @return Article
     */
    public function run(array $data, Content $content): Article {

        $article = $this->updateArticleTask->run($content->article()->first()->id, $data);

        return $article;
    }
}
