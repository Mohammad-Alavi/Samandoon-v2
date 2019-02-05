<?php

namespace App\Containers\User\Tests\Unit;

use App\Containers\Authorization\Tasks\AssignRoleToUserTask;
use App\Containers\User\Actions\CreateAdminByEmailAndPasswordSubAction;
use App\Containers\User\Actions\UpdateUserPasswordSubAction;
use App\Containers\User\Exceptions\EmailIsExistingException;
use App\Containers\User\Models\User;
use App\Containers\User\Tasks\CheckIfEmailIsExistingTask;
use App\Containers\User\Tasks\CreateUserByEmailTask;
use App\Containers\User\Tests\TestCase;
use App\Ship\Transporters\DataTransporter;
use PHPUnit\Framework\MockObject\MockObject;

class CreateAdminByEmailAndPasswordSubActionTest extends TestCase {

    /**
     * @var MockObject | CheckIfEmailIsExistingTask
     */
    private $checkIfEmailIsExistingTask;

    /**
     * @var MockObject | CreateUserByEmailTask
     */
    private $createUserByEmailTask;

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

        $this->checkIfEmailIsExistingTask = $this->getMockBuilder(CheckIfEmailIsExistingTask::class)
            ->disableOriginalConstructor()->getMock();
        $this->createUserByEmailTask = $this->getMockBuilder(CreateUserByEmailTask::class)
            ->disableOriginalConstructor()->getMock();
        $this->updateUserPasswordSubAction = $this->getMockBuilder(UpdateUserPasswordSubAction::class)
            ->disableOriginalConstructor()->getMock();
        $this->assignRoleToUserTask = $this->getMockBuilder(AssignRoleToUserTask::class)
            ->getMock();

    }

    public function test_ShouldReturnUser() {
        $email = 'moslem.deris@test.ir';
        $password = 'secret';
        $admin = $this->createUserByEmail($email, $password, false);

        $this->checkIfEmailIsExistingTask->method('run')->will($this->returnValue(false));
        $this->createUserByEmailTask->method('run')->will($this->returnValue($admin));
        $this->updateUserPasswordSubAction->method('run')->will($this->returnValue($admin));
        $this->assignRoleToUserTask->method('run')->will($this->returnValue($admin));

        $subAction = new CreateAdminByEmailAndPasswordSubAction(
            $this->checkIfEmailIsExistingTask,
            $this->createUserByEmailTask,
            $this->updateUserPasswordSubAction,
            $this->assignRoleToUserTask);

        $transporter = new DataTransporter(['email' => $email, 'password' => $password]);
        $admin = $subAction->run($transporter);

        $this->assertInstanceOf(User::class, $admin);
    }

    public function test_ShouldThrowExceptionWhenEmailExists() {
        $email = 'moslem.deris@test.ir';
        $password = 'secret';
        $admin = $this->createUserByEmail($email, $password, false);

        $this->checkIfEmailIsExistingTask->method('run')->will($this->returnValue(true));
        $this->createUserByEmailTask->method('run')->will($this->returnValue($admin));
        $this->updateUserPasswordSubAction->method('run')->will($this->returnValue($admin));
        $this->assignRoleToUserTask->method('run')->will($this->returnValue($admin));

        $subAction = new CreateAdminByEmailAndPasswordSubAction(
            $this->checkIfEmailIsExistingTask,
            $this->createUserByEmailTask,
            $this->updateUserPasswordSubAction,
            $this->assignRoleToUserTask);

        $this->expectException(EmailIsExistingException::class);

        $transporter = new DataTransporter(['email' => $email, 'password' => $password]);
        $admin = $subAction->run($transporter);
    }

    public function tearDown() {
        parent::tearDown();

        unset($this->checkIfEmailIsExistingTask);
        unset($this->createUserByEmailTask);
        unset($this->updateUserPasswordSubAction);
        unset($this->assignRoleToUserTask);
    }
}
