<?php

namespace App\Containers\User\Tests\Unit;

use App\Containers\User\Actions\FindUserByIdAction;
use App\Containers\User\Models\User;
use App\Containers\User\Tasks\FindUserByIdTask;
use App\Containers\User\Tests\TestCase;
use App\Ship\Transporters\DataTransporter;
use PHPUnit\Framework\MockObject\MockObject;

class FindUserByIdActionTest extends TestCase {

    /**
     * @var MockObject | FindUserByIdTask
     */
    private $findUserByIdTask;

    public function setUp() {
        parent::setUp();

        $this->findUserByIdTask = $this->getMockBuilder(FindUserByIdTask::class)
            ->disableOriginalConstructor()->getMock();
    }

    public function test_CheckIfFindsUserCorrectly() {
        $user = $this->createUserByPhone();

        $this->findUserByIdTask->method('run')->willReturn($user);
        $action = new FindUserByIdAction($this->findUserByIdTask);
        $foundUser = $action->run(new DataTransporter(['id' => $user->id]));

        $this->assertInstanceOf(User::class, $foundUser, 'Return type is not USER');
        $this->assertEquals($user, $foundUser);
    }

}
