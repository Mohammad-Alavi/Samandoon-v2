<?php

namespace App\Containers\Article\Actions;

use App\Containers\Article\Models\Article;
use App\Containers\Article\Tasks\CreateArticleTask;
use App\Ship\Parents\Actions\SubAction;

class CreateArticleSubAction extends SubAction
{
    /** @var CreateArticleTask $createArticleTask */
    protected $createArticleTask;

    public function __construct(CreateArticleTask $createArticleTask)
    {
        $this->createArticleTask = $createArticleTask;
    }

    /**
     * @param array $data
     * @return Article
     */
    public function run(array $data): Article
    {
        $readyDataForTask = [
            'title' => $data['article']['title'],
            'text' => $data['article']['text'],
            'content_id' => $data['content_id']
        ];

        $article = $this->createArticleTask->run($readyDataForTask);

        return $article;
    }
}
