<?php

namespace App\Containers\User\Tests\Unit;

use App\Containers\User\Models\User;
use App\Containers\User\Tasks\CheckIfUserIsExistingTask;
use App\Containers\User\Tasks\DeleteUserTask;
use App\Containers\User\Tests\TestCase;
use Illuminate\Support\Facades\App;

class TaskDeleteUserTest extends TestCase {

    /**
     * @var User
     */
    protected $user;

    public function setUp() {
        parent::setUp();
        //  Create a user
        $this->user = $this->getNewUser();

        //  Delete the user using the task
        $task = App::make(DeleteUserTask::class);
        $task->run($this->user);
    }

    public function test_IsUserDeleted() {
        $isUserExisting = App::make(CheckIfUserIsExistingTask::class)->run($this->user->id);

        //  Assertions
        $this->assertFalse($isUserExisting, 'The user has not been deleted.');
    }

    public function tearDown() {
        parent::tearDown();

        unset($this->user);
    }
}
