<?php

namespace App\Containers\User\Tests;

use App\Containers\User\Actions\RegisterUserSubAction;
use App\Containers\User\Models\User;
use App\Ship\Parents\Tests\PhpUnit\TestCase as ShipTestCase;
use Illuminate\Support\Facades\App;

class TestCase extends ShipTestCase {

    /**
     * @param string $phone
     * @return  User
     */
    public function getNewUser(string $phone = '+989160000000'): User {
        $action = App::make(RegisterUserSubAction::class);
        $user = $action->run($phone);
        return $user;
    }

}
