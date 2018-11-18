<?php

namespace App\Containers\User\Actions;

use App\Containers\User\Models\User;
use App\Containers\User\Tasks\FindUserByIdTask;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Actions\Action;
use App\Ship\Transporters\DataTransporter;

class FindUserByIdAction extends Action {

    /**
     * @var FindUserByIdTask
     */
    private $findUserByIdTask;

    /**
     * FindUserByIdAction constructor.
     *
     * @param FindUserByIdTask $findUserByIdTask
     */
    public function __construct(FindUserByIdTask $findUserByIdTask) {
        $this->findUserByIdTask = $findUserByIdTask;
    }

    /**
     * @param DataTransporter $data
     *
     * @return  User
     * @throws \Throwable
     */
    public function run(DataTransporter $data): User {
        $user = $this->findUserByIdTask->run($data->id);

        if ($user)
            return $user;
        else
            throw new NotFoundException();
    }

}
