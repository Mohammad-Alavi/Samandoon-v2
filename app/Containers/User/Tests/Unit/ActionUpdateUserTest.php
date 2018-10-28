<?php

namespace App\Containers\User\Tests\Unit;

use App\Containers\User\Actions\GeneratePasswordAction;
use App\Containers\User\Actions\UpdateUserAction;
use App\Containers\User\Tests\TestCase;
use App\Ship\Transporters\DataTransporter;
use Illuminate\Support\Facades\App;

class ActionUpdateUserTest extends TestCase {

    public function test_EditAllFieldsWorks() {
        //  Register a new user
        $data = [
            'phone' => '+989160000000',
        ];
        $transporter = new DataTransporter($data);
        $action = App::make(GeneratePasswordAction::class);
        $action->run($transporter);
        $user = $action->run($transporter);

        //  Edit the user
        $data = [
            'id'         => $user->id,
            'first_name' => 'moslem',
            'last_name'  => 'deris',
            'email'      => 'moslem.deris@gmail.com',
            'gender'     => 'male',
            'birth'      => '02-07-1994'
        ];
        $transporter = new DataTransporter($data);
        $action = App::make(UpdateUserAction::class);
        $updatedUser = $action->run($transporter);

        //  Check the result
        $this->assertSame('moslem', $updatedUser->first_name);
        $this->assertSame('deris', $updatedUser->last_name);
        $this->assertSame('moslem.deris@gmail.com', $updatedUser->email);
        $this->assertSame('male', $updatedUser->gender);
        $this->assertSame('02-07-1994', $updatedUser->birth);
    }
}
