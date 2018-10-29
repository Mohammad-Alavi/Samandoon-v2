<?php

namespace App\Containers\User\Tasks;

use App\Containers\User\Data\Repositories\UserRepository;
use App\Ship\Parents\Tasks\Task;

class CheckIfUserIsExistingTask extends Task {
    /**
     * @var UserRepository
     */
    protected $repository;

    /**
     * CheckIfPhoneIsExistingTask constructor.
     * @param UserRepository $repository
     */
    public function __construct(UserRepository $repository) {
        $this->repository = $repository;
    }

    /**
     * @param string $id
     * @return bool
     */
    public function run(string $id): bool {
        return $this->repository->findById($id) != null;
    }
}
