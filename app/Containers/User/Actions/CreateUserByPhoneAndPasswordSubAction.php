<?php

namespace App\Containers\User\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\User\Exceptions\PhoneIsExistingException;
use App\Containers\User\Models\User;
use App\Containers\User\Traits\RandomGeneratorTrait;
use App\Ship\Parents\Actions\Action;
use App\Ship\Transporters\DataTransporter;

class CreateUserByPhoneAndPasswordSubAction extends Action {

    use RandomGeneratorTrait;

    /**
     * @var User
     */
    private $user;

    /**
     * @param DataTransporter $data
     * @return User
     * @throws \Throwable
     */
    public function run(DataTransporter $data): User {
        //  Check if user had been registered before.
        $isPhoneExisting = Apiato::call('User@CheckIfPhoneIsExistingTask', [$data->phone]);

        //  Error if user exists
        throw_if($isPhoneExisting, new PhoneIsExistingException());

        //  Create user
        $this->user = Apiato::call('User@CreateUserByPhoneTask', [true, $data->phone]);

        //  Set the password
        $this->user = Apiato::call('User@UpdateUserPasswordSubAction', [$this->user->id, $data->password]);

        return $this->user;
    }
}
