<?php

namespace App\Containers\Article\Actions;

use App\Containers\Article\Models\Article;
use App\Ship\Parents\Actions\Action;
use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Transporters\DataTransporter;

class GetArticleAction extends Action
{
    public function run(DataTransporter $transporter) : Article
    {
        $article = Apiato::call('Article@FindArticleByIdTask', [$transporter->id]);

        return $article;
    }
}
