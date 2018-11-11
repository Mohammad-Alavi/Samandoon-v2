<?php

namespace App\Containers\User\Tasks;

use App\Containers\User\Data\Repositories\UserRepository;
use App\Containers\User\Models\User;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class CreateUserByEmailTask extends Task {

    /**
     * @var UserRepository
     */
    protected $repository;

    /**
     * CreateUserByEmailTask constructor.
     * @param UserRepository $repository
     */
    public function __construct(UserRepository $repository) {
        $this->repository = $repository;
    }

    /**
     * @param bool $isClient
     * @param string $email
     * @return User
     */
    public function run(
        bool $isClient,
        string $email
    ): User {

        try {
            // create new user
            $user = $this->repository->create([
                'email'     => $email,
                'is_client' => $isClient,
            ]);

        } catch (Exception $e) {
            throw (new CreateResourceFailedException($e->getMessage()));
        }

        return $user;
    }

}
