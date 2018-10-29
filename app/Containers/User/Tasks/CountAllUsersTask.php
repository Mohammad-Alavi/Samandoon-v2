<?php

namespace App\Containers\User\Tasks;

use App\Containers\User\Data\Repositories\UserRepository;
use App\Ship\Parents\Tasks\Task;

class CountAllUsersTask extends Task {

    /**
     * @var UserRepository
     */
    protected $repository;

    /**
     * CountAllUsersTask constructor.
     * @param UserRepository $repository
     */
    public function __construct(UserRepository $repository) {
        $this->repository = $repository;
    }

    /**
     * @return int
     */
    public function run(): int {
        return $this->repository->all()->count();
    }

}
