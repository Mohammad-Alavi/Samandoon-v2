<?php

namespace App\Containers\User\Tasks;

use App\Containers\User\Data\Repositories\UserRepository;
use App\Containers\User\Models\User;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class FindUserByIdTask extends Task {

    /**
     * @var UserRepository
     */
    protected $repository;

    /**
     * FindUserByIdTask constructor.
     * @param UserRepository $repository
     */
    public function __construct(UserRepository $repository) {
        $this->repository = $repository;
    }

    /**
     * @param string $userId
     * @return User
     * @throws NotFoundException
     */
    public function run(string $userId): User {
        // find the user by its id
        try {
            $user = $this->repository->find($userId);
        } catch (Exception $e) {
            throw new NotFoundException();
        }

        return $user;
    }

}
