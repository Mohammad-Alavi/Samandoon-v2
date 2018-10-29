<?php

namespace App\Containers\User\Tasks;

use App\Containers\User\Data\Repositories\UserRepository;
use App\Containers\User\Models\User;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class FindUserByEmailTask extends Task {

    /**
     * @var UserRepository
     */
    protected $repository;

    /**
     * FindUserByEmailTask constructor.
     * @param UserRepository $repository
     */
    public function __construct(UserRepository $repository) {
        $this->repository = $repository;
    }

    /**
     * @param string $email
     * @return User
     * @throws NotFoundException
     */
    public function run(string $email): User {
        try {
            return $this->repository->findByEmail($email);
        } catch (Exception $e) {
            throw new NotFoundException();
        }
    }
}
