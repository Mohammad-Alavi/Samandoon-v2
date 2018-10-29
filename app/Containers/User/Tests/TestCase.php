<?php

namespace App\Containers\User\Tests;

use App\Containers\User\Actions\RegisterUserSubAction;
use App\Containers\User\Models\User;
use App\Containers\User\Tasks\DeleteAllUsersTask;
use App\Ship\Parents\Tests\PhpUnit\TestCase as ShipTestCase;
use Illuminate\Support\Facades\App;

class TestCase extends ShipTestCase {

    /**
     * @param string $phone
     * @return  User
     */
    public function getNewUser(string $phone = '+98916-------'): User {
        $action = App::make(RegisterUserSubAction::class);
        $user = $action->run($phone);
        return $user;
    }

    /**
     * @param int $count
     */
    public function getNewUsers(int $count) {
        for ($i = 0; $i <$count; $i++){
            $this->getNewUser('+98936---' . $i);
        }
    }

    public function deleteAllUsers(){
        App::make(DeleteAllUsersTask::class)->run();
    }


}
