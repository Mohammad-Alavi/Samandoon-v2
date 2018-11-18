<?php

namespace App\Containers\User\Tests\Unit;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\User\Actions\GetAllAdminsAction;
use App\Containers\User\Tasks\GetPaginatedAllUsersTask;
use App\Containers\User\Tests\TestCase;
use Illuminate\Pagination\LengthAwarePaginator;
use PHPUnit\Framework\MockObject\MockObject;

class GetAllAdminsActionTest extends TestCase {

    /**
     * @var MockObject | GetPaginatedAllUsersTask
     */
    private $getPaginatedAllUsersTask;

    /**
     * @var int
     */
    private $count = 5;

    public function setUp() {
        parent::setUp();

        $this->getPaginatedAllUsersTask = $this->getMockBuilder(GetPaginatedAllUsersTask::class)
            ->disableOriginalConstructor()->getMock();
    }

    public function test_IfReturnsCorrectly() {
        for ($i = 0; $i < $this->count; $i++) {
            $admins[$i] = $this->createUserByEmail('test@test.test_' . $i, 'password', false);
        }

        $paginator = new LengthAwarePaginator($admins, count($admins), env('PAGINATION_LIMIT_DEFAULT', 10), 1);

        $this->getPaginatedAllUsersTask->method('run')->willReturn($paginator);

        $action = new GetAllAdminsAction($this->getPaginatedAllUsersTask);
        $result = $action->run();

        $this->assertInstanceOf(LengthAwarePaginator::class, $result, 'Return type is not LengthAwarePaginator');
        $this->assertEquals($this->count, $result->count());
    }


    public function test_CheckWithNoAdmins() {
        $this->deleteAllUsers();

        //  Create some users
        $this->createUsersByEmail($this->count);

        $result = Apiato::call('User@GetAllAdminsAction');

        $this->assertInstanceOf(LengthAwarePaginator::class, $result, 'Return type is not LengthAwarePaginator');
        $this->assertEquals(0, $result->count());

        $this->createUsersByEmail($this->count, 'password', false);
    }

    public function test_CheckWithSomeAdmins() {
        $this->deleteAllUsers();

        //  Create some users
        $this->createUsersByEmail($this->count);

        //  Create some admins
        $this->createUsersByEmail($this->count, 'password', false);

        $result = Apiato::call('User@GetAllAdminsAction');

        $this->assertInstanceOf(LengthAwarePaginator::class, $result, 'Return type is not LengthAwarePaginator');
        $this->assertEquals($this->count, $result->count());
    }

    public function tearDown() {
        parent::tearDown();

        unset($this->getPaginatedAllUsersTask);
        unset($this->count);
    }
}
