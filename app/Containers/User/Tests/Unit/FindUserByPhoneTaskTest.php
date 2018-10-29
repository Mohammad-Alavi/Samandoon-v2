<?php

namespace App\Containers\User\Tests\Unit;

use App\Containers\User\Data\Repositories\UserRepository;
use App\Containers\User\Models\User;
use App\Containers\User\Tasks\FindUserByEmailTask;
use App\Containers\User\Tasks\FindUserByPhoneTask;
use App\Containers\User\Tasks\UpdateUserTask;
use App\Containers\User\Tests\TestCase;
use Illuminate\Support\Facades\App;

class FindUserByPhoneTaskTest extends TestCase {

    /**
     * @var string
     */
    protected $phone = '+985555555555';

    /**
     * @var User
     */
    protected $user;

    /**
     * @var FindUserByPhoneTask
     */
    protected $findUserByPhoneTask;

    public function setUp() {
        parent::setUp();
        //  init
        $this->findUserByPhoneTask = App::make(FindUserByPhoneTask::class);
        //  Create a user
        $this->user = $this->getNewUser($this->phone);
    }

    public function test_CheckIfFindsUserByPhone() {
        //  Get the user by its phone
        $user = $this->findUserByPhoneTask->run($this->phone);

        //  Assertions
        $this->assertInstanceOf(User::class, $user, 'The returned object is not an instance of User.');
        $this->assertEquals($this->phone, $user->phone, 'User is not found correctly');
    }

    public function tearDown() {
        parent::tearDown();

        unset($this->phone);
        unset($this->user);
        unset($this->findUserByPhoneTask);
    }
}
