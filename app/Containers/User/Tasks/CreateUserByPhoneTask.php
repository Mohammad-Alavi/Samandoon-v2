<?php

namespace App\Containers\User\Tasks;

use App\Containers\User\Data\Repositories\UserRepository;
use App\Containers\User\Models\User;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;
use Illuminate\Support\Facades\Hash;

class CreateUserByPhoneTask extends Task {

    /**
     * @var UserRepository
     */
    protected $repository;

    /**
     * CreateUserByPhoneTask constructor.
     * @param UserRepository $repository
     */
    public function __construct(UserRepository $repository) {
        $this->repository = $repository;
    }

    /**
     * @param bool $isClient
     * @param string $phone
     * @return User
     */
    public function run(
        bool $isClient,
        string $phone
    ): User {

        try {
            // create new user
            $user = $this->repository->create([
                'phone'     => $phone,
                'is_client' => $isClient,
            ]);

        } catch (Exception $e) {
            throw (new CreateResourceFailedException($e->getMessage()));
        }

        return $user;
    }

}
