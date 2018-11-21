<?php

namespace App\Containers\User\Tests\Unit;

use App\Containers\User\Actions\CreateUserByPhoneAndPasswordSubAction;
use App\Containers\User\Actions\UpdateUserPasswordSubAction;
use App\Containers\User\Exceptions\PhoneIsExistingException;
use App\Containers\User\Models\User;
use App\Containers\User\Tasks\CheckIfPhoneIsExistingTask;
use App\Containers\User\Tasks\CreateUserByPhoneTask;
use App\Containers\User\Tests\TestCase;
use App\Ship\Transporters\DataTransporter;
use PHPUnit\Framework\MockObject\MockObject;

class CreateUserByPhoneAndPasswordSubActionTest extends TestCase {

    /**
     * @var MockObject | CheckIfPhoneIsExistingTask
     */
    private $checkIfPhoneIsExistingTask;

    /**
     * @var MockObject | CreateUserByPhoneTask
     */
    private $createUserByPhoneTask;

    /**
     * @var MockObject | UpdateUserPasswordSubAction
     */
    private $updateUserPasswordSubAction;

    public function setUp() {
        parent::setUp();

        $this->checkIfPhoneIsExistingTask = $this->getMockBuilder(CheckIfPhoneIsExistingTask::class)
            ->disableOriginalConstructor()->getMock();
        $this->createUserByPhoneTask = $this->getMockBuilder(CreateUserByPhoneTask::class)
            ->disableOriginalConstructor()->getMock();
        $this->updateUserPasswordSubAction = $this->getMockBuilder(UpdateUserPasswordSubAction::class)
            ->disableOriginalConstructor()->getMock();
    }

    public function test_ShouldReturnUser() {
        $phone = '+989362913366';
        $password = 'secret';
        $user = $this->createUserByPhone($phone, $password);

        $this->checkIfPhoneIsExistingTask->method('run')->will($this->returnValue(false));
        $this->createUserByPhoneTask->method('run')->will($this->returnValue($user));
        $this->updateUserPasswordSubAction->method('run')->will($this->returnValue($user));

        $subAction = new CreateUserByPhoneAndPasswordSubAction(
            $this->checkIfPhoneIsExistingTask,
            $this->createUserByPhoneTask,
            $this->updateUserPasswordSubAction);

        $transporter = new DataTransporter(['phone' => $phone, 'password' => $password]);
        $admin = $subAction->run($transporter);

        $this->assertInstanceOf(User::class, $admin);
    }

    public function test_ShouldThrowExceptionWhenEmailExists() {
        $phone = '+989362913366';
        $password = 'secret';
        $user = $this->createUserByPhone($phone, $password);

        $this->checkIfPhoneIsExistingTask->method('run')->will($this->returnValue(true));
        $this->createUserByPhoneTask->method('run')->will($this->returnValue($user));
        $this->updateUserPasswordSubAction->method('run')->will($this->returnValue($user));

        $subAction = new CreateUserByPhoneAndPasswordSubAction(
            $this->checkIfPhoneIsExistingTask,
            $this->createUserByPhoneTask,
            $this->updateUserPasswordSubAction);

        $this->expectException(PhoneIsExistingException::class);

        $transporter = new DataTransporter(['phone' => $phone, 'password' => $password]);
        $admin = $subAction->run($transporter);
    }

    public function tearDown() {
        parent::tearDown();

        unset($this->checkIfPhoneIsExistingTask);
        unset($this->createUserByPhoneTask);
        unset($this->updateUserPasswordSubAction);
    }
}
