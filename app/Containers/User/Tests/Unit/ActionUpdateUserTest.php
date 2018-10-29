<?php

namespace App\Containers\User\Tests\Unit;

use App\Containers\User\Actions\UpdateUserAction;
use App\Containers\User\Models\User;
use App\Containers\User\Tests\TestCase;
use App\Ship\Transporters\DataTransporter;
use Illuminate\Support\Facades\App;

class ActionUpdateUserTest extends TestCase {

    public function test_EditAllFieldsWorks() {
        //  Register a new user
        $user = $this->getNewUser();

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

        $this->assertInstanceOf(User::class, $updatedUser, 'The returned object is not an instance of the User.');
        $this->assertSame('moslem', $updatedUser->first_name, 'first_name field is not changed.');
        $this->assertSame('deris', $updatedUser->last_name, 'last_name field is not changed.');
        $this->assertSame('moslem.deris@gmail.com', $updatedUser->email, 'email field is not changed.');
        $this->assertSame('male', $updatedUser->gender, 'gender field is not changed.');
        $this->assertSame('02-07-1994', $updatedUser->birth, 'birth field is not changed.');
    }
}
