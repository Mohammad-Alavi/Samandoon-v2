<?php

namespace App\Containers\User\Tests\Unit;

use App\Containers\User\Tasks\CheckIfPhoneIsExistingTask;
use App\Containers\User\Tests\TestCase;
use Illuminate\Support\Facades\App;

class TaskCheckIfPhoneIsExistingTest extends TestCase {

    public function test_CheckIfWorksWithExistingPhone() {
        //  Register a new user
        $this->getNewUser('+989160000000');

        //  Use the task
        $task = App::make(CheckIfPhoneIsExistingTask::class);
        $shouldBeTrue  = $task->run('+989160000000');  //  The phone number just registered
        $shouldBeFalse = $task->run('+989161111111');  //  The non existing phone number

        //  Check the result
        $this->assertInternalType('bool', $shouldBeTrue,  'The returned value sis not a boolean');
        $this->assertInternalType('bool', $shouldBeFalse, 'The returned value sis not a boolean');
        $this->assertTrue($shouldBeTrue);
        $this->assertFalse($shouldBeFalse);
    }
}
