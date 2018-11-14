<?php

namespace App\Containers\Article\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Transporters\DataTransporter;

class CreateArticleAction extends Action
{
    public function run(DataTransporter $transporter)
    {
        $data = $transporter->sanitizeInput([
            'title',
            'text',
        ]);

        $article = Apiato::call('Article@CreateArticleTask', [$data]);

        return $article;
    }
}
