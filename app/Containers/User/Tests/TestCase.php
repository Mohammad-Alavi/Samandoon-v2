<?php

namespace App\Containers\User\Tests;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\User\Models\User;
use App\Containers\User\Tasks\DeleteAllUsersTask;
use App\Containers\User\Traits\RandomGeneratorTrait;
use App\Ship\Parents\Tests\PhpUnit\TestCase as ShipTestCase;
use Illuminate\Support\Facades\App;

class TestCase extends ShipTestCase {

    use RandomGeneratorTrait;

    /**
     * @param string $phone
     * @param string $password
     *
     * @param bool   $isClient
     *
     * @return  User
     */
    public function createUserByPhone(string $phone = '+989160000000', string $password = 'password', bool $isClient = true): User {
        $user = Apiato::call('User@CreateUserByPhoneTask', [$isClient, $phone]);
        $user = Apiato::call('User@FindUserByIdTask', [$user->id]);

        return $user;
    }

    /**
     * @param int    $count
     * @param string $password
     * @param bool   $isClient
     */
    public function createUsersByPhone(int $count, string $password = 'password', bool $isClient = true): void {
        for ($i = 0; $i < $count; $i++) {
            $this->createUserByPhone(
                '+98936' . $this->getRandomNumber(3) . $i,
                $password,
                $isClient
            );
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
     * @param int    $count
     * @param string $password
     * @param bool   $isClient
     */
    public function createUsersByEmail(int $count, string $password = 'password', bool $isClient = true): void {
        for ($i = 0; $i < $count; $i++) {
            $this->createUserByEmail(
                $this->getRandomNumber(3) . 'test@test.test_' . $i,
                $password,
                $isClient
            );
        }
    }

    public function deleteAllUsers(): void {
        App::make(DeleteAllUsersTask::class)->run();
    }

}
