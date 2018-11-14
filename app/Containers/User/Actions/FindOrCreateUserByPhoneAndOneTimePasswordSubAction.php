<?php

namespace App\Containers\User\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\User\Models\User;
use App\Containers\User\Notifications\OneTimePasswordGeneratedNotification;
use App\Containers\User\Traits\RandomGeneratorTrait;
use App\Ship\Parents\Actions\Action;
use App\Ship\Transporters\DataTransporter;
use Illuminate\Support\Facades\Config;

class FindOrCreateUserByPhoneAndOneTimePasswordSubAction extends Action {

    use RandomGeneratorTrait;

    /**
     * @var User
     */
    private $user;

    /**
     * @param DataTransporter $data
     * @return User
     */
    public function run(DataTransporter $data): User {
        //  Check if user had been registered before.
        $isPhoneExisting = Apiato::call('User@CheckIfPhoneIsExistingTask', [$data->phone]);

        //  Get or Create the user
        if ($isPhoneExisting)
            $this->user = Apiato::call('User@FindUserByPhoneTask', [$data->phone]);
        else
            $this->user = Apiato::call('User@CreateUserByPhoneTask', [true, $data->phone]);

        //  Generate a new password
        $passwordLength = Config::get('user-container.password.one-time-password-length');
        $oneTimePassword = $this->getRandomNumber($passwordLength);
        //  Set the new password
        $this->user = Apiato::call('User@UpdateUserOneTimePasswordSubAction', [$this->user->id, $oneTimePassword]);
        //  Send the password to user's phone
        $this->user->notify(new OneTimePasswordGeneratedNotification($oneTimePassword));

        return $this->user;
    }
}
