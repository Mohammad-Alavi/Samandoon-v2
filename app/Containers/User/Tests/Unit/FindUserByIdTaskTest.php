<?php

namespace App\Containers\User\Tests\Unit;

use App\Containers\User\Data\Repositories\UserRepository;
use App\Containers\User\Models\User;
use App\Containers\User\Tasks\FindUserByEmailTask;
use App\Containers\User\Tasks\FindUserByIdTask;
use App\Containers\User\Tasks\UpdateUserTask;
use App\Containers\User\Tests\TestCase;
use Illuminate\Support\Facades\App;

class FindUserByIdTaskTest extends TestCase {

    /**
     * @var string
     */
    protected $id;

    /**
     * @var User
     */
    protected $user;

    /**
     * @var FindUserByIdTask
     */
    protected $findUserByIdTask;

    public function setUp() {
        parent::setUp();
        //  init
        $this->findUserByIdTask = App::make(FindUserByIdTask::class);
        //  Create a user
        $this->user = $this->getNewUser();
        $this->id = $this->user->id;
    }

    public function test_CheckIfFindsUserById() {
        //  Get the user by its id
        $user = $this->findUserByIdTask->run($this->id);

        //  Assertions
        $this->assertInstanceOf(User::class, $user, 'The returned object is not an instance of User.');
        $this->assertEquals($this->id, $user->id, 'User is not found correctly');
    }

    public function tearDown() {
        parent::tearDown();

        unset($this->id);
        unset($this->user);
        unset($this->findUserByIdTask);
    }
}
