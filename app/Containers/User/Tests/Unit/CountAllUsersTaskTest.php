<?php

namespace App\Containers\User\Tests\Unit;

use App\Containers\User\Tasks\CountAllUsersTask;
use App\Containers\User\Tests\TestCase;
use Illuminate\Support\Facades\App;

class CountAllUsersTaskTest extends TestCase {

    public function setUp() {
        parent::setUp();
        //  Delete all users before each test
        $this->deleteAllUsers();
    }

    public function test_CountNoUsers() {
        //  Count users by the task
        $count = App::make(CountAllUsersTask::class)->run();

        //  Assertions
        $this->assertEquals(0, $count, 'It must return 0 when no user is created yet.');
    }

    public function test_CountRegisteredUsers() {
        //  Create 10 users
        $this->getNewUsers(10);

        //  Count users by the task
        $count = App::make(CountAllUsersTask::class)->run();

        //  Assertions
        $this->assertEquals(10, $count, 'Cant count all users.');
    }
}
