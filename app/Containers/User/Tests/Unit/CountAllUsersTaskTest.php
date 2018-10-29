<?php

namespace App\Containers\User\Tests\Unit;

use App\Containers\User\Tasks\CountAllUsersTask;
use App\Containers\User\Tasks\DeleteAllUsersTask;
use App\Containers\User\Tests\TestCase;
use Illuminate\Support\Facades\App;

class CountAllUsersTaskTest extends TestCase {

    public function test_CountNoUsers() {
        //  Delete all users first
        App::make(DeleteAllUsersTask::class)->run();

        //  Count users by the task
        $count = App::make(CountAllUsersTask::class)->run();

        //  Assertions
        $this->assertEquals(0, $count, 'It must return 0 when no user is created yet.');
    }

    public function test_CountRegisteredUsers() {
        //  Delete all users first
        App::make(DeleteAllUsersTask::class)->run();

        //  Create 10 users
        $this->getNewUsers(10);

        //  Count users by the task
        $count = App::make(CountAllUsersTask::class)->run();

        //  Assertions
        $this->assertEquals(10, $count, 'Cant count all users.');
    }
}
