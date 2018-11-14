<?php

namespace App\Containers\User\Tests\Unit;

use App\Containers\User\Models\User;
use App\Containers\User\Tasks\CheckIfEmailIsExistingTask;
use App\Containers\User\Tasks\CheckIfPhoneIsExistingTask;
use App\Containers\User\Tests\TestCase;
use Illuminate\Support\Facades\App;

class CheckIfEmailIsExistingTaskTest extends TestCase {

    /**
     * @var string
     */
    protected $registeredEmail = 'moslem.deris@gmail.com';

    /**
     * @var string
     */
    protected $unRegisteredEmail = 'm.alavi1989@gmail.com';

    /**
     * @var User
     */
    protected $user;

    /**
     * @var CheckIfEmailIsExistingTask
     */
    protected $task;

    public function setUp() {
        parent::setUp();

        //  Register a new user
        $this->user = $this->createUserByEmail($this->registeredEmail);

        //  Set the task value
        $this->task = App::make(CheckIfEmailIsExistingTask::class);
    }

    public function test_CheckIfWorksWithExistingEmail() {
        //  Use the task
        $isEmailExisting  = $this->task->run($this->registeredEmail);

        //  Check the result
        $this->assertInternalType('bool', $isEmailExisting,  'The returned value is not a boolean.');
        $this->assertTrue($isEmailExisting, 'Task can\'t recognize that the email is existing.');
    }

    public function test_CheckIfWorksWithNonExistingEmail() {
        //  Use the task
        $isEmailExisting = $this->task->run($this->unRegisteredEmail);

        //  Check the result
        $this->assertInternalType('bool', $isEmailExisting, 'The returned value is not a boolean.');
        $this->assertFalse($isEmailExisting, 'Task can\'t recognize that the email is not existing.');
    }

    public function tearDown() {
        parent::tearDown();

        unset($this->registeredPhone);
        unset($this->unRegisteredPhone);
        unset($this->user);
        unset($this->task);
    }
}
