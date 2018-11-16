<?php

namespace App\Containers\Article\Actions;

use App\Containers\Article\Models\Article;
use App\Containers\Article\Tasks\CreateArticleTask;
use App\Ship\Parents\Actions\Action;
use App\Ship\Transporters\DataTransporter;

class CreateArticleAction extends Action
{
    /** @var CreateArticleTask $createArticleTask */
    protected $createArticleTask;

    public function __construct(CreateArticleTask $createArticleTask)
    {
        $this->createArticleTask = $createArticleTask;
    }

    /**
     * @param DataTransporter $transporter
     *
     * @return Article
     */
    public function run(DataTransporter $transporter): Article
    {
        $data = $transporter->sanitizeInput([
            'title',
            'text',
        ]);

        $article = $this->createArticleTask->run($data);

        return $article;
    }
}
