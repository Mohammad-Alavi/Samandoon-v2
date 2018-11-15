<?php

namespace App\Containers\User\Actions;

use App\Containers\Authorization\Tasks\AssignRoleToUserTask;
use App\Containers\User\Exceptions\EmailIsExistingException;
use App\Containers\User\Models\User;
use App\Containers\User\Tasks\CheckIfEmailIsExistingTask;
use App\Containers\User\Tasks\CreateUserByEmailTask;
use App\Ship\Parents\Actions\SubAction;
use App\Ship\Transporters\DataTransporter;

class CreateAdminByEmailAndPasswordSubAction extends SubAction {

    /**
     * @var CheckIfEmailIsExistingTask
     */
    private $checkIfEmailIsExistingTask;

    /**
     * @var CreateUserByEmailTask
     */
    private $createUserByEmailTask;

    /**
     * @var UpdateUserPasswordSubAction
     */
    private $updateUserPasswordSubAction;

    /**
     * @var AssignRoleToUserTask
     */
    private $assignRoleToUserTask;

    /**
     * @var User
     */
    private $user;

    /**
     * CreateAdminByEmailAndPasswordSubAction constructor.
     *
     * @param CheckIfEmailIsExistingTask  $checkIfEmailIsExistingTask
     * @param CreateUserByEmailTask       $createUserByEmailTask
     * @param UpdateUserPasswordSubAction $updateUserPasswordSubAction
     * @param AssignRoleToUserTask        $assignRoleToUserTask
     */
    public function __construct(CheckIfEmailIsExistingTask $checkIfEmailIsExistingTask, CreateUserByEmailTask $createUserByEmailTask, UpdateUserPasswordSubAction $updateUserPasswordSubAction, AssignRoleToUserTask $assignRoleToUserTask) {
        $this->checkIfEmailIsExistingTask = $checkIfEmailIsExistingTask;
        $this->createUserByEmailTask = $createUserByEmailTask;
        $this->updateUserPasswordSubAction = $updateUserPasswordSubAction;
        $this->assignRoleToUserTask = $assignRoleToUserTask;
    }

    /**
     * @param DataTransporter $data
     *
     * @return User
     * @throws \Throwable
     */
    public function run(DataTransporter $data): User {
        //  Check if user had been registered before.
        $isEmailExisting = $this->checkIfEmailIsExistingTask->run($data->email);

        //  Error if user exists
        throw_if($isEmailExisting, new EmailIsExistingException());

        //  Create user
        $this->user = $this->createUserByEmailTask->run(false, $data->email);

        //  Set the password
        $this->user = $this->updateUserPasswordSubAction->run($this->user->id, $data->password);

        //  Assign Roles to admin
        $this->assignRoleToUserTask->run($this->user, ['admin']);

        return $this->user;
    }
}
