<?php

namespace App\Containers\User\Tests\Unit;

use App\Containers\User\Tasks\CountAllUsersTask;
use App\Containers\User\Tasks\DeleteAllUsersTask;
use App\Containers\User\Tests\TestCase;
use Illuminate\Support\Facades\App;

class TaskDeleteAllUsersTest extends TestCase {

    public function test_DeleteAllUsers() {
        //  Create 10 users
        $this->getNewUsers(10);

        //  Delete all users
        App::make(DeleteAllUsersTask::class)->run();

        //  Count all users
        $count = App::make(CountAllUsersTask::class)->run();

        //  Assertions
        $this->assertEquals(0, $count, 'Didnt delete all the users.');

    }
}
