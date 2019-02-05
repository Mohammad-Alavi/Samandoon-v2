<?php

namespace App\Containers\User\Tasks;

use App\Containers\User\Data\Repositories\UserRepository;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task;

class CheckIfEmailIsExistingTask extends Task {
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
     * @param string $email
     * @return bool
     */
    public function run(string $email): bool {
        try{
            $this->repository->findByEmail($email);
            return true;
        }catch (NotFoundException $e){
            return false;
        }
    }
}
