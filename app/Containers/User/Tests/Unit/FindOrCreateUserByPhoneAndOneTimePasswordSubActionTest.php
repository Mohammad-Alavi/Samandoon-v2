<?php

namespace App\Containers\User\Tests\Unit;

use App\Containers\User\Actions\FindOrCreateUserByPhoneAndOneTimePasswordSubAction;
use App\Containers\User\Actions\UpdateUserOneTimePasswordSubAction;
use App\Containers\User\Models\User;
use App\Containers\User\Tasks\CheckIfPhoneIsExistingTask;
use App\Containers\User\Tasks\CreateUserByPhoneTask;
use App\Containers\User\Tasks\FindUserByPhoneTask;
use App\Containers\User\Tests\TestCase;
use App\Ship\Transporters\DataTransporter;
use PHPUnit\Framework\MockObject\MockObject;

class FindOrCreateUserByPhoneAndOneTimePasswordSubActionTest extends TestCase {

    /**
     * @var MockObject | CheckIfPhoneIsExistingTask
     */
    private $checkIfPhoneIsExistingTask;

    /**
     * @var MockObject | FindUserByPhoneTask
     */
    private $findUserByPhoneTask;

    /**
     * @var MockObject | CreateUserByPhoneTask
     */
    private $createUserByPhoneTask;

    /**
     * @var MockObject | UpdateUserOneTimePasswordSubAction
     */
    private $updateUserOneTimePasswordSubAction;

    public function setUp() {
        parent::setUp();

        $this->checkIfPhoneIsExistingTask = $this->getMockBuilder(CheckIfPhoneIsExistingTask::class)
            ->disableOriginalConstructor()->getMock();

        $this->findUserByPhoneTask = $this->getMockBuilder(FindUserByPhoneTask::class)
            ->disableOriginalConstructor()->getMock();

        $this->createUserByPhoneTask = $this->getMockBuilder(CreateUserByPhoneTask::class)
            ->disableOriginalConstructor()->getMock();

        $this->updateUserOneTimePasswordSubAction = $this->getMockBuilder(UpdateUserOneTimePasswordSubAction::class)
            ->disableOriginalConstructor()->getMock();
    }

    public function test_TestCreatingUser() {
        $user = $this->createUserByPhone();
        $this->checkIfPhoneIsExistingTask->method('run')->willReturn(false);
        $this->findUserByPhoneTask->method('run')->willReturn($user);
        $this->createUserByPhoneTask->method('run')->willReturn($user);
        $this->updateUserOneTimePasswordSubAction->method('run')->willReturn($user);

        $action = new FindOrCreateUserByPhoneAndOneTimePasswordSubAction($this->checkIfPhoneIsExistingTask,
            $this->findUserByPhoneTask,
            $this->createUserByPhoneTask,
            $this->updateUserOneTimePasswordSubAction);
        $transporter = new DataTransporter(['phone' => $user->phone]);
        $newUser = $action->run($transporter);

        $this->assertInstanceOf(User::class, $newUser, 'The result is not an instance of USER');
        $this->assertEquals($user->phone, $newUser->phone, 'The user is not created with the given phone');
    }

    public function test_TestFindingUser() {
        $user = $this->createUserByPhone();
        $this->checkIfPhoneIsExistingTask->method('run')->willReturn(true);
        $this->findUserByPhoneTask->method('run')->willReturn($user);
        $this->createUserByPhoneTask->method('run')->willReturn($user);
        $this->updateUserOneTimePasswordSubAction->method('run')->willReturn($user);

        $action = new FindOrCreateUserByPhoneAndOneTimePasswordSubAction($this->checkIfPhoneIsExistingTask,
            $this->findUserByPhoneTask,
            $this->createUserByPhoneTask,
            $this->updateUserOneTimePasswordSubAction);
        $transporter = new DataTransporter(['phone' => $user->phone]);
        $newUser = $action->run($transporter);

        $this->assertInstanceOf(User::class, $newUser, 'The result is not an instance of USER');
        $this->assertEquals($user->phone, $newUser->phone, 'The user is not found with the given phone');
    }
}
