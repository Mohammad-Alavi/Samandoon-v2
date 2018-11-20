<?php

namespace App\Containers\User\Actions;

use App\Containers\Authentication\Tasks\GetAuthenticatedUserTask;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Actions\SubAction;
use Illuminate\Contracts\Auth\Authenticatable;

class GetAuthenticatedUserSubAction extends SubAction {

    /**
     * @var GetAuthenticatedUserTask
     */
    private $getAuthenticatedUserTask;

    /**
     * GetAuthenticatedUserSubAction constructor.
     *
     * @param GetAuthenticatedUserTask $getAuthenticatedUserTask
     */
    public function __construct(GetAuthenticatedUserTask $getAuthenticatedUserTask) {
        $this->getAuthenticatedUserTask = $getAuthenticatedUserTask;
    }

    /**
     * @return Authenticatable
     * @throws  NotFoundException
     */
    public function run(): Authenticatable {
        $user = $this->getAuthenticatedUserTask->run();

        if (!$user) {
            throw new NotFoundException();
        }

        return $user;
    }
}
