<?php

namespace App\Containers\Article\Actions;

use App\Containers\Article\Models\Article;
use App\Ship\Parents\Actions\Action;
use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Transporters\DataTransporter;

class UpdateArticleAction extends Action
{
    public function run(DataTransporter $transporter) : Article
    {
        $data = $transporter->sanitizeInput([
            'title',
            'text',
        ]);

        $article = Apiato::call('Article@UpdateArticleTask', [$transporter->id, $data]);

        return $article;
    }
}
