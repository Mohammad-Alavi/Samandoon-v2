<?php

namespace App\Containers\Article\Actions;

use App\Containers\Article\Models\Article;
use App\Containers\Article\Tasks\CreateArticleTask;
use App\Ship\Parents\Actions\SubAction;

/**
 * Class CreateArticleSubAction
 *
 * @package App\Containers\Article\Actions
 */
class CreateArticleSubAction extends SubAction
{

    /**
     * @var CreateArticleTask $createArticleTask
     */
    protected $createArticleTask;

    /**
     * CreateArticleSubAction constructor.
     *
     * @param CreateArticleTask $createArticleTask
     */
    public function __construct(CreateArticleTask $createArticleTask)
    {
        $this->createArticleTask = $createArticleTask;
    }

    /**
     * @param array  $data
     *
     * @param string $content_id
     *
     * @return Article
     */
    public function run(array $data, string $content_id): Article
    {
        $articleData = [
            'title' => $data['title'],
            'text' => $data['text'],
            'content_id' => $content_id,
        ];
        $article = $this->createArticleTask->run($articleData);

        return $article;
    }
}
