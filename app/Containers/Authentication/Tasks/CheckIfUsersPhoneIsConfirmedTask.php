<?php

namespace App\Containers\Authentication\Tasks;

use App\Containers\Authentication\Exceptions\UsersPhoneIsNotConfirmedException;
use App\Containers\User\Models\User;
use App\Ship\Parents\Tasks\Task;
use Illuminate\Support\Facades\Config;

class CheckIfUsersPhoneIsConfirmedTask extends Task {

    /**
     * @param User $user
     * @return void
     * @throws \Throwable
     */
    public function run(User $user) {
        $isPhoneConfirmationRequired = Config::get('authentication-container.is_phone_confirmation_required', false);
        $isPhoneConfirmed = $user->is_phone_confirmed;

        throw_if($isPhoneConfirmationRequired && !$isPhoneConfirmed,
            new UsersPhoneIsNotConfirmedException());
    }
}
