<?php

namespace App\Containers\Authentication\Tasks;

use App\Containers\Authentication\Exceptions\UsersEmailIsNotConfirmedException;
use App\Containers\User\Models\User;
use App\Ship\Parents\Tasks\Task;
use Illuminate\Support\Facades\Config;

class CheckIfUsersEmailIsConfirmedTask extends Task {

    /**
     * @param User $user
     * @return void
     * @throws \Throwable
     */
    public function run(User $user) {
        $isEmailConfirmationRequired = Config::get('authentication-container.is_email_confirmation_required', false);
        $isEmailConfirmed = $user->is_email_confirmed;

        throw_if($isEmailConfirmationRequired && !$isEmailConfirmed,
            new UsersEmailIsNotConfirmedException());
    }
}
