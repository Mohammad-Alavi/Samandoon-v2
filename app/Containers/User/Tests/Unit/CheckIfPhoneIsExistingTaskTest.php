<?php

namespace App\Containers\User\Tests\Unit;

use App\Containers\User\Models\User;
use App\Containers\User\Tasks\CheckIfPhoneIsExistingTask;
use App\Containers\User\Tests\TestCase;
use Illuminate\Support\Facades\App;

class CheckIfPhoneIsExistingTaskTest extends TestCase {

    /**
     * @var string
     */
    protected $registeredPhone = '+989160000000';

    /**
     * @var string
     */
    protected $unRegisteredPhone = '+989164444444';

    /**
     * @var User
     */
    protected $user;

    /**
     * @var CheckIfPhoneIsExistingTask
     */
    protected $task;

    public function setUp() {
        parent::setUp();

        //  Register a new user
        $this->user = $this->createUserByPhone($this->registeredPhone);

        //  Set the task value
        $this->task = App::make(CheckIfPhoneIsExistingTask::class);
    }

    public function test_CheckIfWorksWithExistingPhone() {
        //  Use the task
        $isPhoneExisting  = $this->task->run($this->registeredPhone);

        //  Check the result
        $this->assertInternalType('bool', $isPhoneExisting,  'The returned value is not a boolean');
        $this->assertTrue($isPhoneExisting, 'Task cant recognize that the phone is existing.');
    }

    public function test_CheckIfWorksWithNonExistingPhone() {
        //  Use the task
        $isPhoneExisting = $this->task->run($this->unRegisteredPhone);

        //  Check the result
        $this->assertInternalType('bool', $isPhoneExisting, 'The returned value is not a boolean');
        $this->assertFalse($isPhoneExisting, 'Task cant recognize that the phone is not existing.');
    }

    public function tearDown() {
        parent::tearDown();

        unset($this->registeredPhone);
        unset($this->unRegisteredPhone);
        unset($this->user);
        unset($this->task);
    }
}
