<?php

namespace App\Containers\User\Tasks;

use App\Containers\User\Data\Repositories\UserRepository;
use App\Ship\Parents\Tasks\Task;

class CheckIfPhoneIsExistingTask extends Task
{
    protected $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run(string $phone)
    {
        return $this->repository->findByPhone($phone) != null;
    }
}
