<?php

namespace App\Containers\User\Actions;

use App\Containers\User\Exceptions\EmailIsExistingException;
use App\Containers\User\Models\User;
use App\Containers\User\Tasks\CheckIfEmailIsExistingTask;
use App\Containers\User\Tasks\CreateUserByEmailTask;
use App\Ship\Parents\Actions\Action;
use App\Ship\Transporters\DataTransporter;

class CreateUserByEmailAndPasswordSubAction extends Action {

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
     * @var User
     */
    private $user;

    /**
     * CreateUserByEmailAndPasswordSubAction constructor.
     *
     * @param CheckIfEmailIsExistingTask  $checkIfEmailIsExistingTask
     * @param CreateUserByEmailTask       $createUserByEmailTask
     * @param UpdateUserPasswordSubAction $updateUserPasswordSubAction
     */
    public function __construct(CheckIfEmailIsExistingTask $checkIfEmailIsExistingTask,
                                CreateUserByEmailTask $createUserByEmailTask,
                                UpdateUserPasswordSubAction $updateUserPasswordSubAction) {
        $this->checkIfEmailIsExistingTask = $checkIfEmailIsExistingTask;
        $this->createUserByEmailTask = $createUserByEmailTask;
        $this->updateUserPasswordSubAction = $updateUserPasswordSubAction;
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
        $this->user = $this->createUserByEmailTask->run(true, $data->email);

        //  Set the password
        $this->user = $this->updateUserPasswordSubAction->run($this->user->id, $data->password);

        return $this->user;
    }
}
