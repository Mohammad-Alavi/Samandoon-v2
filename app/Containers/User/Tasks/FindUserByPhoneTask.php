<?php

namespace App\Containers\User\Tasks;

use App\Containers\User\Data\Repositories\UserRepository;
use App\Containers\User\Models\User;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class FindUserByPhoneTask extends Task {

    protected $repository;

    public function __construct(UserRepository $repository) {
        $this->repository = $repository;
    }

    public function run(string $phone): User {
        try {
            return $this->repository->findByPhone($phone);
        } catch (Exception $e) {
            throw new NotFoundException();
        }
    }
}
