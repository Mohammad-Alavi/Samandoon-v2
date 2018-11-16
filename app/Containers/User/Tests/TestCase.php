<?php

namespace App\Containers\User\Tests;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\User\Models\User;
use App\Containers\User\Tasks\DeleteAllUsersTask;
use App\Ship\Parents\Tests\PhpUnit\TestCase as ShipTestCase;
use Illuminate\Support\Facades\App;

class TestCase extends ShipTestCase {

    /**
     * @param string $phone
     * @param string $password
     *
     * @param bool   $isClient
     *
     * @return  User
     */
    public function createUserByPhone(string $phone = '+98916-------', string $password = 'password', bool $isClient = true): User {
        $user = Apiato::call('User@CreateUserByPhoneTask', [$isClient, $phone]);
        $user = Apiato::call('User@FindUserByIdTask', [$user->id]);

        return $user;
    }

    /**
     * @param int $count
     */
    public function createUsersByPhone(int $count): void {
        for ($i = 0; $i < $count; $i++) {
            $this->createUserByPhone('+98936---' . $i);
        }
    }

    /**
     * @param string $email
     * @param string $password
     *
     * @param bool   $isClient
     *
     * @return  User
     */
    public function createUserByEmail(string $email = 'test@test.test', string $password = 'password', bool $isClient = true): User {
        $user = Apiato::call('User@CreateUserByEmailTask', [$isClient, $email]);
        $user = Apiato::call('User@FindUserByIdTask', [$user->id]);

        return $user;
    }

    /**
     * @param int $count
     */
    public function createUsersByEmail(int $count): void {
        for ($i = 0; $i < $count; $i++) {
            $this->createUserByEmail('test@test.test_' . $i);
        }
    }

    public function deleteAllUsers(): void {
        App::make(DeleteAllUsersTask::class)->run();
    }

}
