<?php

namespace App\Containers\User\Actions;

use App\Containers\User\Models\User;
use App\Containers\User\Notifications\OneTimePasswordGeneratedNotification;
use App\Containers\User\Tasks\CheckIfPhoneIsExistingTask;
use App\Containers\User\Tasks\CreateUserByPhoneTask;
use App\Containers\User\Tasks\FindUserByPhoneTask;
use App\Containers\User\Traits\RandomGeneratorTrait;
use App\Ship\Parents\Actions\Action;
use App\Ship\Transporters\DataTransporter;
use Illuminate\Support\Facades\Config;

class FindOrCreateUserByPhoneAndOneTimePasswordSubAction extends Action {

    use RandomGeneratorTrait;

    /**
     * @var CheckIfPhoneIsExistingTask
     */
    private $checkIfPhoneIsExistingTask;

    /**
     * @var FindUserByPhoneTask
     */
    private $findUserByPhoneTask;

    /**
     * @var CreateUserByPhoneTask
     */
    private $createUserByPhoneTask;

    /**
     * @var UpdateUserOneTimePasswordSubAction
     */
    private $updateUserOneTimePasswordSubAction;

    /**
     * @var User
     */
    private $user;

    /**
     * FindOrCreateUserByPhoneAndOneTimePasswordSubAction constructor.
     *
     * @param CheckIfPhoneIsExistingTask         $checkIfPhoneIsExistingTask
     * @param FindUserByPhoneTask                $findUserByPhoneTask
     * @param CreateUserByPhoneTask              $createUserByPhoneTask
     * @param UpdateUserOneTimePasswordSubAction $updateUserOneTimePasswordSubAction
     */
    public function __construct(CheckIfPhoneIsExistingTask $checkIfPhoneIsExistingTask,
                                FindUserByPhoneTask $findUserByPhoneTask,
                                CreateUserByPhoneTask $createUserByPhoneTask,
                                UpdateUserOneTimePasswordSubAction $updateUserOneTimePasswordSubAction) {
        $this->checkIfPhoneIsExistingTask = $checkIfPhoneIsExistingTask;
        $this->findUserByPhoneTask = $findUserByPhoneTask;
        $this->createUserByPhoneTask = $createUserByPhoneTask;
        $this->updateUserOneTimePasswordSubAction = $updateUserOneTimePasswordSubAction;
    }

    /**
     * @param DataTransporter $data
     *
     * @return User
     */
    public function run(DataTransporter $data): User {
        //  Check if user had been registered before.
        $isPhoneExisting = $this->checkIfPhoneIsExistingTask->run($data->phone);

        //  Get or Create the user
        if ($isPhoneExisting)
            $this->user = $this->findUserByPhoneTask->run($data->phone);
        else
            $this->user = $this->createUserByPhoneTask->run(true, $data->phone);

        //  Generate a new password
        $passwordLength = Config::get('user-container.password.one-time-password-length');
        $oneTimePassword = $this->getRandomNumber($passwordLength);
        //  Set the new password
        $this->user = $this->updateUserOneTimePasswordSubAction->run($this->user->id, $oneTimePassword);
        //  Send the password to user's phone
        $this->user->notify(new OneTimePasswordGeneratedNotification($oneTimePassword));

        return $this->user;
    }
}
