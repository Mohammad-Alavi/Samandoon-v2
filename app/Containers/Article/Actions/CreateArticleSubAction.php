<?php

namespace App\Containers\Article\Actions;

use App\Containers\Article\Data\Transporters\CreateArticleTransporter;
use App\Containers\Article\Models\Article;
use App\Containers\Article\Tasks\CreateArticleTask;
use App\Ship\Parents\Actions\SubAction;
use App\Ship\Transporters\DataTransporter;

class CreateArticleSubAction extends SubAction
{
    /** @var CreateArticleTask $createArticleTask */
    protected $createArticleTask;

    public function __construct(CreateArticleTask $createArticleTask)
    {
        $this->createArticleTask = $createArticleTask;
    }

    /**
     * @param CreateArticleTransporter $transporter
     *
     * @return Article
     */
    public function run(CreateArticleTransporter $transporter): Article
    {
        $data = $transporter->sanitizeInput([
            'title',
            'text',
            'content_id'
        ]);

        $article = $this->createArticleTask->run($data);

        return $article;
    }
}
