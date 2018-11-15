<?php

namespace App\Containers\User\Actions;

use App\Containers\User\Tasks\DeleteUserTask;
use App\Ship\Parents\Actions\Action;
use App\Ship\Transporters\DataTransporter;

class DeleteUserAction extends Action {

    /**
     * @var DeleteUserTask
     */
    private $deleteUserTask;

    /**
     * DeleteUserAction constructor.
     *
     * @param DeleteUserTask $deleteUserTask
     */
    public function __construct(DeleteUserTask $deleteUserTask) {
        $this->deleteUserTask = $deleteUserTask;
    }

    /**
     * @param DataTransporter $data
     */
    public function run(DataTransporter $data): void {
        $this->deleteUserTask->run($data->id);
    }
}
