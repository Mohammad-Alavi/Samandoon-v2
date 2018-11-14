<?php

namespace App\Containers\User\Tests;

use App\Containers\User\Actions\CreateUserByEmailAndPasswordSubAction;
use App\Containers\User\Actions\CreateUserByPhoneAndPasswordSubAction;
use App\Containers\User\Models\User;
use App\Containers\User\Tasks\DeleteAllUsersTask;
use App\Ship\Parents\Tests\PhpUnit\TestCase as ShipTestCase;
use App\Ship\Transporters\DataTransporter;
use Illuminate\Support\Facades\App;

class TestCase extends ShipTestCase {

    /**
     * @param string $phone
     * @param string $password
     *
     * @return  User
     */
    public function createUserByPhone(string $phone = '+98916-------', string $password = 'password'): User {
        $action = App::make(CreateUserByPhoneAndPasswordSubAction::class);
        $transporter = new DataTransporter(['phone' => $phone, 'password' => $password]);
        $user = $action->run($transporter);

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
     * @return  User
     */
    public function createUserByEmail(string $email = 'test@test.test', string $password = 'password'): User {
        $action = App::make(CreateUserByEmailAndPasswordSubAction::class);
        $transporter = new DataTransporter(['email' => $email, 'password' => $password]);
        $user = $action->run($transporter);

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
