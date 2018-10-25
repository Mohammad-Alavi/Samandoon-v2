<?php

namespace App\Containers\User\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\User\Events\UserRegisteredEvent;
use App\Containers\User\Mails\UserRegisteredMail;
use App\Containers\User\Notifications\UserRegisteredNotification;
use App\Ship\Parents\Actions\SubAction;
use Illuminate\Contracts\Bus\Dispatcher;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class RegisterUserSubAction extends SubAction {

    public function run(string $phone) {
        // Create a user record in database and return it.
        $user = Apiato::call('User@CreateUserByCredentialsTask', [
            true,
            $phone,
            'default-password'
        ]);

        //Mail::send(new UserRegisteredMail($user));

        Notification::send($user, new UserRegisteredNotification($user));

        App::make(Dispatcher::class)->dispatch(New UserRegisteredEvent($user));

        return $user;
    }
}
