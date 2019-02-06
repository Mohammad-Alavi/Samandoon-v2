<?php

namespace App\Containers\Comment\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Authentication\Tasks\GetAuthenticatedUserTask;
use App\Containers\Comment\Tasks\CreateCommentTask;
use App\Ship\Parents\Actions\Action;
use App\Ship\Transporters\DataTransporter;

class CreateCommentAction extends Action
{
    private $createCommentTask;
    private $getAuthenticatedUserTask;

    /**
     * CreateCommentAction constructor.
     *
     * @param CreateCommentTask $createCommentTask
     */
    public function __construct(CreateCommentTask $createCommentTask, GetAuthenticatedUserTask $getAuthenticatedUserTask)
    {
        $this->createCommentTask = $createCommentTask;
        $this->getAuthenticatedUserTask = $getAuthenticatedUserTask;
    }

    /**
     * @param DataTransporter $transporter
     *
     * @return mixed
     */
    public function run(DataTransporter $transporter)
    {
        $transporter->user_id = $this->getAuthenticatedUserTask->run()->id;
        $data = $transporter->sanitizeInput([
            'body',
            'user_id',
            'content_id',
            'parent_id',
        ]);
        $comment = $this->createCommentTask->run($data);

        return $comment;
    }
}
