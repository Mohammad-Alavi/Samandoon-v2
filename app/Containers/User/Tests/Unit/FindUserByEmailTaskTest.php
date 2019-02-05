<?php

namespace App\Containers\User\Tests\Unit;

use App\Containers\User\Models\User;
use App\Containers\User\Tasks\FindUserByEmailTask;
use App\Containers\User\Tasks\UpdateUserTask;
use App\Containers\User\Tests\TestCase;
use Illuminate\Support\Facades\App;

class FindUserByEmailTaskTest extends TestCase {

    /**
     * @var string
     */
    protected $email = 'moslem.deris@gmail.com';

    /**
     * @var User
     */
    protected $user;

    /**
     * @var FindUserByEmailTask
     */
    protected $findUserByEmailTask;

    public function setUp() {
        parent::setUp();
        //  init
        $this->findUserByEmailTask = App::make(FindUserByEmailTask::class);
        //  Create a user
        $this->user = $this->createUserByPhone();
    }

    public function test_CheckIfFindsUserByEmail() {
        //  Change its email to $email field
        App::make(UpdateUserTask::class)->run(['email' => $this->email], $this->user->id);

        //  Get the user by its email
        $user = $this->findUserByEmailTask->run($this->email);

        //  Assertions
        $this->assertInstanceOf(User::class, $user, 'The returned object is not an instance of User.');
        $this->assertEquals($this->email, $user->email, 'User is not found correctly');
    }

    public function tearDown() {
        parent::tearDown();

        unset($this->email);
        unset($this->user);
        unset($this->findUserByEmailTask);
    }
}
