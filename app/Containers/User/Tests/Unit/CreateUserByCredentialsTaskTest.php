<?php

namespace App\Containers\User\Tests\Unit;

use App\Containers\User\Models\User;
use App\Containers\User\Tasks\CreateUserByCredentialsTask;
use App\Containers\User\Tests\TestCase;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;

class CreateUserByCredentialsTaskTest extends TestCase {

    /**
     * @var bool
     */
    protected $isClient = true;

    /**
     * @var string
     */
    protected $phone = '+989362913366';

    /**
     * @var string
     */
    protected $password = 'secret';

    /**
     * @var User
     */
    protected $user;

    public function setUp() {
        parent::setUp();
        //  Create a user using the task
        $task = App::make(CreateUserByCredentialsTask::class);
        $this->user = $task->run($this->isClient, $this->phone, $this->password);
    }

    public function test_IsReturningUserType() {
        $this->assertInstanceOf(User::class, $this->user, 'The returned object is not an instance of the User.');
    }

    public function test_IsDataSetCorrectly() {
        $this->assertEquals($this->phone, $this->user->phone, 'Field PHONE is not set correctly.');
        $this->assertTrue(Hash::check($this->password, $this->user->password), 'Field PASSWORD is not set correctly.');
        $this->assertSame($this->isClient, $this->user->is_client, 'Field IS_CLIENT is not set correctly.');
    }

    public function tearDown() {
        parent::tearDown();
        unset($this->isClient);
        unset($this->phone);
        unset($this->password);
        unset($this->user);
    }
}
