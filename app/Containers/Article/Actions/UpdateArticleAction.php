<?php

namespace App\Containers\Article\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Article\Models\Article;
use App\Ship\Parents\Actions\Action;
use App\Ship\Transporters\DataTransporter;

class UpdateArticleAction extends Action {

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

        $article = Apiato::call('Article@UpdateArticleTask', [$transporter->id, $data]);

        return $article;
    }
}
