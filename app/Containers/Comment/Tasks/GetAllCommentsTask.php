<?php

namespace App\Containers\Comment\Tasks;

use App\Containers\Comment\Data\Repositories\CommentRepository;
use App\Containers\Content\Data\Criterias\ThisFCMTokensCriteria;
use App\Ship\Criterias\Eloquent\OrderByCreationDateDescendingCriteria;
use App\Ship\Parents\Tasks\Task;
use Prettus\Repository\Exceptions\RepositoryException;


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
     * @return mixed
     * @throws RepositoryException
     */
    public function run(string $content_id)
    {
        $this->repository->pushCriteria(new ThisFCMTokensCriteria($content_id));
        $this->repository->pushCriteria(new OrderByCreationDateDescendingCriteria());
        return $this->repository->paginate();
    }
}
