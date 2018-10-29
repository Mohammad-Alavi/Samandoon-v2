<?php

namespace App\Containers\User\Tests\Unit;

use App\Containers\User\Actions\GeneratePasswordAction;
use App\Containers\User\Models\User;
use App\Containers\User\Tests\TestCase;
use App\Ship\Transporters\DataTransporter;
use Illuminate\Support\Facades\App;

class ActionGeneratePasswordTest extends TestCase {

    public function test_RegisterNewUser() {
        //  Register a new user
        $data = [
            'phone' => '+989160000000',
        ];
        $user = App::make(GeneratePasswordAction::class)->run(new DataTransporter($data));

        //  Check the result
        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals($user->phone, $data['phone']);
        $this->assertEquals($user->password_updated_at, $user->created_at);
    }

    public function test_GeneratePasswordForExistingUser() {
        //  Register a new user
        $data = [
            'phone' => '+989160000000',
        ];
        $transporter = new DataTransporter($data);
        $action = App::make(GeneratePasswordAction::class);
        $action->run($transporter);

        //  Get password for existing user
        $user = $action->run($transporter);

        //  Check the result
        $this->assertInstanceOf(User::class, $user);
        $this->assertNotEquals($user->password_updated_at, $user->created_at);
    }
}
