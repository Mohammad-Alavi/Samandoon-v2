<?php

namespace App\Containers\User\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\User\Models\User;
use App\Containers\User\Notifications\PasswordGeneratedNotification;
use App\Containers\User\Traits\RandomGeneratorTrait;
use App\Ship\Parents\Actions\Action;
use App\Ship\Transporters\DataTransporter;
use Illuminate\Support\Facades\Notification;

class GeneratePasswordAction extends Action {

    use RandomGeneratorTrait;
    private $user;

    public function run(DataTransporter $data) {
        //  Check if user had been registered before.
        $isPhoneExisting = Apiato::call('User@CheckIfPhoneIsExistingTask', [$data->phone]);

        //  Get or Create the user
        if ($isPhoneExisting)
            $this->user = Apiato::call('User@FindUserByPhoneTask', [$data->phone]);
        else
            $this->user = Apiato::call('User@RegisterUserSubAction', [$data->phone]);

        //  Set a new password
        $newPassword = $this->getRandomNumber(5);  //  TODO: make it in conf
        $this->user = Apiato::call('User@UpdateUserPasswordSubAction', [$this->user->id, $newPassword]);

        Notification::send($this->user, new PasswordGeneratedNotification($newPassword));

        return $this->user;
    }
}
