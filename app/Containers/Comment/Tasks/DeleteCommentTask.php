<?php

namespace App\Containers\Comment\Tasks;

use App\Containers\Comment\Data\Repositories\CommentRepository;
use App\Ship\Exceptions\DeleteResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class DeleteCommentTask extends Task
{

    protected $repository;

    public function __construct(CommentRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run($id)
    {
        try {
            return $this->repository->delete($id);
        }
        catch (Exception $exception) {
            throw new DeleteResourceFailedException();
        }
    }
}
