<?php

namespace App\Containers\Comment\Tasks;

use App\Containers\Comment\Data\Criterias\ThisContentCriteria;
use App\Containers\Comment\Data\Repositories\CommentRepository;
use App\Ship\Criterias\Eloquent\OrderByCreationDateDescendingCriteria;
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
        $this->repository->pushCriteria(new ThisContentCriteria($content_id));
        $this->repository->pushCriteria(new OrderByCreationDateDescendingCriteria());
        return $this->repository->paginate();
    }
}
