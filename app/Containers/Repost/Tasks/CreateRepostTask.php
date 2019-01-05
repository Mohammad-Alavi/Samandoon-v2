<?php

namespace App\Containers\Repost\Tasks;

use App\Containers\Repost\Data\Repositories\RepostRepository;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

/**
 * Class CreateRepostTask
 *
 * @package App\Containers\Repost\Tasks
 */
class CreateRepostTask extends Task
{

    protected $repository;

    /**
     * CreateRepostTask constructor.
     *
     * @param RepostRepository $repository
     */
    public function __construct(RepostRepository $repository)
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
            return $this->repository->create($data);
        } catch (Exception $exception) {
            throw new CreateResourceFailedException();
        }
    }
}
