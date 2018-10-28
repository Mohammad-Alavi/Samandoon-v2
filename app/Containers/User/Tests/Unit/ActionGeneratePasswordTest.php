<?php

namespace App\Containers\User\Tests\Unit;

use App\Containers\User\Actions\GeneratePasswordAction;
use App\Containers\User\Models\User;
use App\Containers\User\Tests\TestCase;
use App\Ship\Transporters\DataTransporter;
use Illuminate\Support\Facades\App;

class ActionGeneratePasswordTest extends TestCase {

    public function test_RegisterNewUser() {
        $data = [
            'phone' => '+989160000000',
        ];

        $transporter = new DataTransporter($data);
        $action = App::make(GeneratePasswordAction::class);
        $user = $action->run($transporter);

        // asset the returned object is an instance of the User
        $this->assertInstanceOf(User::class, $user);

        $this->assertEquals($user->phone, $data['phone']);
        $this->assertEquals($user->password_updated_at, $user->created_at);
    }

    public function test_GeneratePasswordForExistingUser() {
        $data = [
            'phone' => '+989160000000',
        ];

        $transporter = new DataTransporter($data);
        $action = App::make(GeneratePasswordAction::class);
        $action->run($transporter);
        $user = $action->run($transporter);

        // asset the returned object is an instance of the User
        $this->assertInstanceOf(User::class, $user);

        $this->assertNotEquals($user->password_updated_at, $user->created_at);
    }
}
