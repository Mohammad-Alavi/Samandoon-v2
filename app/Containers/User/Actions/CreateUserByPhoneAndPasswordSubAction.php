<?php

namespace App\Containers\User\Actions;

use App\Containers\User\Exceptions\PhoneIsExistingException;
use App\Containers\User\Models\User;
use App\Containers\User\Tasks\CheckIfPhoneIsExistingTask;
use App\Containers\User\Tasks\CreateUserByPhoneTask;
use App\Ship\Parents\Actions\Action;
use App\Ship\Transporters\DataTransporter;

class CreateUserByPhoneAndPasswordSubAction extends Action {

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
     * @var User
     */
    private $user;

    /**
     * CreateUserByPhoneAndPasswordSubAction constructor.
     *
     * @param CheckIfPhoneIsExistingTask  $checkIfPhoneIsExistingTask
     * @param CreateUserByPhoneTask       $createUserByPhoneTask
     * @param UpdateUserPasswordSubAction $updateUserPasswordSubAction
     */
    public function __construct(CheckIfPhoneIsExistingTask $checkIfPhoneIsExistingTask,
                                CreateUserByPhoneTask $createUserByPhoneTask,
                                UpdateUserPasswordSubAction $updateUserPasswordSubAction) {
        $this->checkIfPhoneIsExistingTask = $checkIfPhoneIsExistingTask;
        $this->createUserByPhoneTask = $createUserByPhoneTask;
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
        $isPhoneExisting = $this->checkIfPhoneIsExistingTask->run($data->phone);

        //  Error if user exists
        throw_if($isPhoneExisting, new PhoneIsExistingException());

        //  Create user
        $this->user = $this->createUserByPhoneTask->run(true, $data->phone);

        //  Set the password
        $this->user = $this->updateUserPasswordSubAction->run($this->user->id, $data->password);

        return $this->user;
    }
}
