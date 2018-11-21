<?php

namespace App\Containers\User\Tests\Unit;

use App\Containers\Authorization\Tasks\AssignRoleToUserTask;
use App\Containers\User\Actions\CreateAdminByPhoneAndPasswordSubAction;
use App\Containers\User\Actions\UpdateUserPasswordSubAction;
use App\Containers\User\Exceptions\PhoneIsExistingException;
use App\Containers\User\Models\User;
use App\Containers\User\Tasks\CheckIfPhoneIsExistingTask;
use App\Containers\User\Tasks\CreateUserByPhoneTask;
use App\Containers\User\Tests\TestCase;
use App\Ship\Transporters\DataTransporter;
use PHPUnit\Framework\MockObject\MockObject;

class CreateAdminByPhoneAndPasswordSubActionTest extends TestCase {

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

    /**
     * @var MockObject | AssignRoleToUserTask
     */
    private $assignRoleToUserTask;

    public function setUp() {
        parent::setUp();

        $this->checkIfPhoneIsExistingTask = $this->getMockBuilder(CheckIfPhoneIsExistingTask::class)
            ->disableOriginalConstructor()->getMock();
        $this->createUserByPhoneTask = $this->getMockBuilder(CreateUserByPhoneTask::class)
            ->disableOriginalConstructor()->getMock();
        $this->updateUserPasswordSubAction = $this->getMockBuilder(UpdateUserPasswordSubAction::class)
            ->disableOriginalConstructor()->getMock();
        $this->assignRoleToUserTask = $this->getMockBuilder(AssignRoleToUserTask::class)
            ->getMock();
    }

    public function test_ShouldReturnUser() {
        $phone = '+989362913366';
        $password = 'secret';
        $admin = $this->createUserByPhone($phone, $password, false);

        $this->checkIfPhoneIsExistingTask->method('run')->will($this->returnValue(false));
        $this->createUserByPhoneTask->method('run')->will($this->returnValue($admin));
        $this->updateUserPasswordSubAction->method('run')->will($this->returnValue($admin));
        $this->assignRoleToUserTask->method('run')->will($this->returnValue($admin));

        $subAction = new CreateAdminByPhoneAndPasswordSubAction(
            $this->checkIfPhoneIsExistingTask,
            $this->createUserByPhoneTask,
            $this->updateUserPasswordSubAction,
            $this->assignRoleToUserTask);

        $transporter = new DataTransporter(['phone' => $phone, 'password' => $password]);
        $admin = $subAction->run($transporter);

        $this->assertInstanceOf(User::class, $admin);
    }

    public function test_ShouldThrowExceptionWhenEmailExists() {
        $phone = '+989362913366';
        $password = 'secret';
        $admin = $this->createUserByPhone($phone, $password, false);

        $this->checkIfPhoneIsExistingTask->method('run')->will($this->returnValue(true));
        $this->createUserByPhoneTask->method('run')->will($this->returnValue($admin));
        $this->updateUserPasswordSubAction->method('run')->will($this->returnValue($admin));
        $this->assignRoleToUserTask->method('run')->will($this->returnValue($admin));

        $subAction = new CreateAdminByPhoneAndPasswordSubAction(
            $this->checkIfPhoneIsExistingTask,
            $this->createUserByPhoneTask,
            $this->updateUserPasswordSubAction,
            $this->assignRoleToUserTask);

        $this->expectException(PhoneIsExistingException::class);

        $transporter = new DataTransporter(['phone' => $phone, 'password' => $password]);
        $admin = $subAction->run($transporter);
    }

    public function tearDown() {
        parent::tearDown();

        unset($this->checkIfPhoneIsExistingTask);
        unset($this->createUserByPhoneTask);
        unset($this->updateUserPasswordSubAction);
        unset($this->assignRoleToUserTask);
    }
}
