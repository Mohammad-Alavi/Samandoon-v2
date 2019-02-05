<?php

namespace App\Containers\Transaction\Actions;

use App\Containers\Authentication\Tasks\GetAuthenticatedUserTask;
use App\Containers\User\Models\User;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

class GetAllTransactionsAction extends Action {

    /**
     * @var GetAuthenticatedUserTask
     */
    protected $getAuthenticatedUserTask;

    /**
     * GetAllTransactionsAction constructor.
     *
     * @param GetAuthenticatedUserTask $getAuthenticatedUserTask
     */
    public function __construct(GetAuthenticatedUserTask $getAuthenticatedUserTask) {
        $this->getAuthenticatedUserTask = $getAuthenticatedUserTask;
    }

    /**
     * @param Request $request
     *
     * @return mixed
     */
    public function run(Request $request) {
        /** @var User $user */
        $user = $this->getAuthenticatedUserTask->run();

        return $user->transactions()->orderBy('created_at', 'desc')->paginate();
    }
}
