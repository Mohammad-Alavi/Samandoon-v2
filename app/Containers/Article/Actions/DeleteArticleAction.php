<?php

namespace App\Containers\Article\Actions;

use App\Containers\Article\Tasks\DeleteArticleTask;
use App\Ship\Parents\Actions\Action;
use App\Ship\Transporters\DataTransporter;

class DeleteArticleAction extends Action
{
    protected $deleteArticleTask;

    public function __construct(DeleteArticleTask $deleteArticleTask)
    {
        $this->deleteArticleTask = $deleteArticleTask;
    }

    public function run(DataTransporter $transporter)
    {
        return $this->deleteArticleTask->run($transporter->id);
    }
}
