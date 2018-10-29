<?php

namespace App\Containers\User\Tasks;

use App\Containers\User\Data\Repositories\UserRepository;
use App\Ship\Exceptions\DeleteResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class DeleteAllUsersTask extends Task
{

    /**
     * @var UserRepository
     */
    protected $repository;

    /**
     * DeleteAllUsersTask constructor.
     * @param UserRepository $repository
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return int
     */
    public function run()
    {
        try {
            return $this->repository->makeModel()->query()->delete();
        }
        catch (Exception $exception) {
            throw new DeleteResourceFailedException();
        }
    }
}
