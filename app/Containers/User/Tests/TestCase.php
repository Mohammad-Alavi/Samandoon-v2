<?php

namespace App\Containers\User\Tests;

use App\Containers\User\Actions\RegisterUserSubAction;
use App\Containers\User\Models\User;
use App\Ship\Parents\Tests\PhpUnit\TestCase as ShipTestCase;
use Illuminate\Support\Facades\App;

class TestCase extends ShipTestCase {

    public function getNewUser($phone = '+989160000000'): User {
        return App::make(RegisterUserSubAction::class)->run($phone);
    }

}
