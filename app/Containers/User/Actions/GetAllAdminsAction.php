<?php

namespace App\Containers\User\Actions;

use App\Containers\User\Tasks\GetPaginatedAllUsersTask;
use App\Ship\Parents\Actions\Action;
use Illuminate\Pagination\LengthAwarePaginator;

class GetAllAdminsAction extends Action {

    /**
     * @var GetPaginatedAllUsersTask
     */
    private $getPaginatedAllUsersTask;

    /**
     * GetAllAdminsAction constructor.
     *
     * @param GetPaginatedAllUsersTask $getPaginatedAllUsersTask
     */
    public function __construct(GetPaginatedAllUsersTask $getPaginatedAllUsersTask) {
        $this->getPaginatedAllUsersTask = $getPaginatedAllUsersTask;
    }

    /**
     * @return LengthAwarePaginator
     */
    public function run(): LengthAwarePaginator {
        $this->getPaginatedAllUsersTask->addRequestCriteria();
        $this->getPaginatedAllUsersTask->admins();
        $this->getPaginatedAllUsersTask->ordered();
        $result = $this->getPaginatedAllUsersTask->run();

        return $result;
    }
}
