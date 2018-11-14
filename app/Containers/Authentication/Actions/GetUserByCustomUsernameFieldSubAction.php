<?php

namespace App\Containers\Authentication\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Authentication\Exceptions\UsernameTypeNotAcceptedException;
use App\Containers\User\Models\User;
use App\Ship\Parents\Actions\SubAction;

class GetUserByCustomUsernameFieldSubAction extends SubAction {
    /**
     * @param string $usernameFieldKey
     * @param string $username
     * @return User
     */
    public function run(string $usernameFieldKey, string $username): User {
        switch ($usernameFieldKey) {
            case 'phone':
                return Apiato::call('User@FindUserByPhoneTask', [$username]);

            case 'email':
                return Apiato::call('User@FindUserByEmailTask', [$username]);

            default:
                throw new UsernameTypeNotAcceptedException();
        }
    }
}
