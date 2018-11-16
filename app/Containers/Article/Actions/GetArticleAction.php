<?php

namespace App\Containers\Article\Actions;

use App\Containers\Article\Models\Article;
use App\Containers\Article\Tasks\FindArticleByIdTask;
use App\Ship\Parents\Actions\Action;
use App\Ship\Transporters\DataTransporter;

class GetArticleAction extends Action
{

    protected $findArticleByIdTask;

    public function __construct(FindArticleByIdTask $findArticleByIdTask)
    {
        $this->findArticleByIdTask = $findArticleByIdTask;
    }

    /**
     * @param DataTransporter $transporter
     *
     * @return Article
     */
    public function run(DataTransporter $transporter): Article
    {
        $article = $this->findArticleByIdTask->run($transporter->id);
        return $article;
    }
}
