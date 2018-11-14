<?php

namespace App\Containers\User\Tests\Unit;

use App\Containers\User\Actions\UpdateUserAction;
use App\Containers\User\Models\User;
use App\Containers\User\Tests\TestCase;
use App\Ship\Transporters\DataTransporter;
use Illuminate\Support\Facades\App;

class UpdateUserActionTest extends TestCase {

    /**
     * @var User
     */
    protected $user;

    /**
     * @var array
     */
    protected $data = [
        'first_name' => 'moslem',
        'last_name'  => 'deris',
        'email'      => 'moslem.deris@gmail.com',
        'gender'     => 'male',
        'birth'      => '02-07-1994'
    ];

    public function setUp() {
        parent::setUp();
        //  Register a new user
        $this->user = $this->createUserByPhone();
    }

    public function test_EditAllFieldsWorks() {
        //  Add $id property to $data array
        $this->data = array_add($this->data, 'id', $this->user->id);

        //  Edit the user
        $transporter = new DataTransporter($this->data);
        $action = App::make(UpdateUserAction::class);
        $this->user = $action->run($transporter);

        //  Check the result
        $this->assertInstanceOf(User::class, $this->user, 'The returned object is not an instance of the User.');
        $this->assertSame($this->data['first_name'], $this->user->first_name, 'first_name field is not changed.');
        $this->assertSame($this->data['last_name'], $this->user->last_name, 'last_name field is not changed.');
        $this->assertSame($this->data['email'], $this->user->email, 'email field is not changed.');
        $this->assertSame($this->data['gender'], $this->user->gender, 'gender field is not changed.');
        $this->assertSame($this->data['birth'], $this->user->birth, 'birth field is not changed.');
    }

    public function tearDown() {
        parent::tearDown();

        unset($this->user);
        unset($this->data);
    }
}
