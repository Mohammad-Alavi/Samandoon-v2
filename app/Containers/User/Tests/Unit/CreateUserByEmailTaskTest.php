<?php

namespace App\Containers\User\Tests\Unit;

use App\Containers\User\Models\User;
use App\Containers\User\Tasks\CreateUserByEmailTask;
use App\Containers\User\Tests\TestCase;
use Illuminate\Support\Facades\App;

class CreateUserByPhoneTaskTest extends TestCase {

    /**
     * @var bool
     */
    protected $isClient = true;

    /**
     * @var string
     */
    protected $email = 'moslem.deris@gmail.com';

    /**
     * @var User
     */
    protected $user;

    public function setUp() {
        parent::setUp();
        //  Create a user using the task
        $task = App::make(CreateUserByEmailTask::class);
        $this->user = $task->run($this->isClient, $this->email);
    }

    public function test_IsReturningUserType() {
        $this->assertInstanceOf(User::class, $this->user, 'The returned object is not an instance of the User.');
    }

    public function test_IsDataSetCorrectly() {
        $this->assertEquals($this->email, $this->user->email, 'Field EMAIL is not set correctly.');
        $this->assertSame($this->isClient, $this->user->is_client, 'Field IS_CLIENT is not set correctly.');
    }

    public function tearDown() {
        parent::tearDown();
        unset($this->isClient);
        unset($this->email);
        unset($this->user);
    }
}
