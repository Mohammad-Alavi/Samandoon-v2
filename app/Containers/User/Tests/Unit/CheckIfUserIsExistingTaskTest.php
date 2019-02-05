<?php

namespace App\Containers\User\Tests\Unit;

use App\Containers\User\Models\User;
use App\Containers\User\Tasks\CheckIfUserIsExistingTask;
use App\Containers\User\Tests\TestCase;
use Illuminate\Support\Facades\App;

class CheckIfUserIsExistingTaskTest extends TestCase {

    /**
     * @var User
     */
    protected $user;

    /**
     * @var CheckIfUserIsExistingTask
     */
    protected $task;

    public function setUp() {
        parent::setUp();

        //  Register a new user
        $this->user = $this->createUserByPhone();

        //  Set the task value
        $this->task = App::make(CheckIfUserIsExistingTask::class);
    }

    public function test_CheckIfWorksWithExistingId() {
        //  Use the task
        $isIdExisting  = $this->task->run($this->user->id);

        //  Check the result
        $this->assertInternalType('bool', $isIdExisting,  'The returned value is not a boolean');
        $this->assertTrue($isIdExisting, 'Task cant recognize that the Id is existing.');
    }

    public function test_CheckIfWorksWithNonExistingId() {
        //  Use the task
        $isIdExisting = $this->task->run('blah-blah');

        //  Check the result
        $this->assertInternalType('bool', $isIdExisting, 'The returned value is not a boolean');
        $this->assertFalse($isIdExisting, 'Task cant recognize that the id is not existing.');
    }

    public function tearDown() {
        parent::tearDown();

        unset($this->user);
        unset($this->task);
    }
}
