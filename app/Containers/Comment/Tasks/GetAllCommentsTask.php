<?php

namespace App\Containers\Comment\Tasks;

use App\Containers\Comment\Data\Repositories\CommentRepository;
use App\Ship\Parents\Tasks\Task;

class GetAllCommentsTask extends Task
{

    protected $repository;

    /**
     * GetAllCommentsTask constructor.
     *
     * @param CommentRepository $repository
     */
    public function __construct(CommentRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param string $content_id
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function run(string $content_id)
    {
        return $this->repository->findByContentId($content_id);
    }
}
