<?php

namespace App\Containers\Article\Actions;

use App\Containers\Article\Tasks\GetAllArticlesTask;
use App\Ship\Parents\Actions\Action;
use App\Ship\Transporters\DataTransporter;

class GetAllArticlesAction extends Action
{
    protected $getAllArticlesTask;

    public function __construct(GetAllArticlesTask $getAllArticlesTask)
    {
        $this->getAllArticlesTask = $getAllArticlesTask;
    }

    public function run(DataTransporter $transporter)
    {
        $articles = $this->getAllArticlesTask->run();

        return $articles;
    }
}
