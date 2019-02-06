<?php

namespace App\Containers\Comment\Tasks;

use App\Containers\Comment\Data\Repositories\CommentRepository;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class FindCommentByIdTask extends Task
{

    protected $repository;

    /**
     * FindCommentByIdTask constructor.
     *
     * @param CommentRepository $repository
     */
    public function __construct(CommentRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function run($id)
    {
        try {
            return $this->repository->find($id);
        }
        catch (Exception $exception) {
            throw new NotFoundException();
        }
    }
}
