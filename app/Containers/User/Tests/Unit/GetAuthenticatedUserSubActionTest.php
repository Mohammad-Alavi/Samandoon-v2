<?php

namespace App\Containers\User\Tests\Unit;

use App\Containers\Authentication\Tasks\GetAuthenticatedUserTask;
use App\Containers\User\Actions\GetAuthenticatedUserSubAction;
use App\Containers\User\Models\User;
use App\Containers\User\Tests\TestCase;
use App\Ship\Exceptions\NotFoundException;
use Illuminate\Contracts\Auth\Authenticatable;
use PHPUnit\Framework\MockObject\MockObject;

class GetAuthenticatedUserSubActionTest extends TestCase {

    /**
     * @var MockObject | GetAuthenticatedUserTask
     */
    private $getAuthenticatedUserTask;

    public function setUp() {
        parent::setUp();

        $this->getAuthenticatedUserTask = $this->getMockBuilder(GetAuthenticatedUserTask::class)->getMock();
    }

    public function test_ShouldThrowExceptionOnNullReturnOfTask() {
        $this->getAuthenticatedUserTask->method('run')->willReturn(null);

        $this->expectException(NotFoundException::class);

        $action = new GetAuthenticatedUserSubAction($this->getAuthenticatedUserTask);
        $action->run();
    }

    public function test_ShouldReturnUser() {
        $user = $this->createUserByEmail();
        $this->getAuthenticatedUserTask->method('run')->willReturn($user);

        $action = new GetAuthenticatedUserSubAction($this->getAuthenticatedUserTask);
        $foundUser = $action->run();

        $this->assertInstanceOf(User::class, $foundUser, 'response is not a USER type');
        $this->assertInstanceOf(Authenticatable::class, $foundUser, 'response is not an AUTHENTICATABLE type');
        $this->assertEquals($user, $foundUser);
    }

    public function tearDown() {
        parent::tearDown();

        unset($this->getAuthenticatedUserTask);
    }
}
