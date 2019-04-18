<?php

namespace App\Containers\Comment\Tasks;

use App\Containers\Comment\Data\Repositories\CommentRepository;
use App\Containers\Comment\Models\Comment;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

/**
 * Class CreateCommentTask
 *
 * @package App\Containers\Comment\Tasks
 */
class CreateCommentTask extends Task
{

    protected $repository;

    /**
     * CreateCommentTask constructor.
     *
     * @param CommentRepository $repository
     */
    public function __construct(CommentRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param array $data
     *
     * @return mixed
     */
    public function run(array $data)
    {
        try {
            /** @var Comment $comment */
            $comment = $this->repository->create($data);
        } catch (Exception $exception) {
            throw new CreateResourceFailedException($exception->getMessage());
        }

        return $comment;
    }
}
