<?php

namespace App\Containers\Article\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Article\Models\Article;
use App\Ship\Parents\Actions\Action;
use App\Ship\Transporters\DataTransporter;

class GetArticleAction extends Action {

    /**
     * @param DataTransporter $transporter
     *
     * @return Article
     */
    public function run(DataTransporter $transporter): Article {
        $article = Apiato::call('Article@FindArticleByIdTask', [$transporter->id]);

        return $article;
    }
}
