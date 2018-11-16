<?php

namespace App\Containers\Article\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Article\Models\Article;
use App\Containers\Article\Tasks\UpdateArticleTask;
use App\Ship\Parents\Actions\Action;
use App\Ship\Transporters\DataTransporter;

class UpdateArticleAction extends Action {

    protected $updateArticleTask;

    public function __construct(UpdateArticleTask $updateArticleTask)
    {
        $this->updateArticleTask = $updateArticleTask;
    }

    /**
     * @param DataTransporter $transporter
     *
     * @return Article
     */
    public function run(DataTransporter $transporter): Article {
        $data = $transporter->sanitizeInput([
            'title',
            'text',
        ]);

        $article = $this->updateArticleTask->run($transporter->id, $data);

        return $article;
    }
}
