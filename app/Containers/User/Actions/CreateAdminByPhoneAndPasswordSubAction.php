<?php

namespace App\Containers\User\Actions;

use App\Containers\Authorization\Tasks\AssignRoleToUserTask;
use App\Containers\User\Exceptions\PhoneIsExistingException;
use App\Containers\User\Models\User;
use App\Containers\User\Tasks\CheckIfPhoneIsExistingTask;
use App\Containers\User\Tasks\CreateUserByPhoneTask;
use App\Ship\Parents\Actions\SubAction;
use App\Ship\Transporters\DataTransporter;

class CreateAdminByPhoneAndPasswordSubAction extends SubAction {

    /**
     * @var CheckIfPhoneIsExistingTask
     */
    private $checkIfPhoneIsExistingTask;

    /**
     * @var CreateUserByPhoneTask
     */
    private $createUserByPhoneTask;

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
     * CreateAdminByPhoneAndPasswordSubAction constructor.
     *
     * @param CheckIfPhoneIsExistingTask  $checkIfPhoneIsExistingTask
     * @param CreateUserByPhoneTask       $createUserByPhoneTask
     * @param UpdateUserPasswordSubAction $updateUserPasswordSubAction
     * @param AssignRoleToUserTask        $assignRoleToUserTask
     */
    public function __construct(CheckIfPhoneIsExistingTask $checkIfPhoneIsExistingTask,
                                CreateUserByPhoneTask $createUserByPhoneTask,
                                UpdateUserPasswordSubAction $updateUserPasswordSubAction,
                                AssignRoleToUserTask $assignRoleToUserTask) {
        $this->checkIfPhoneIsExistingTask = $checkIfPhoneIsExistingTask;
        $this->createUserByPhoneTask = $createUserByPhoneTask;
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
        $isPhoneExisting = $this->checkIfPhoneIsExistingTask->run($data->phone);

        //  Error if user exists
        throw_if($isPhoneExisting, new PhoneIsExistingException());

        //  Create user
        $this->user = $this->createUserByPhoneTask->run(false, $data->phone);

        //  Set the password
        $this->user = $this->updateUserPasswordSubAction->run($this->user->id, $data->password);

        //  Assign Roles to admin
        $this->assignRoleToUserTask->run($this->user, ['admin']);

        return $this->user;
    }
}
