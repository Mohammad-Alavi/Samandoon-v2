<?php

namespace App\Containers\User\Tests\Unit;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\User\Actions\GetAllUsersAction;
use App\Containers\User\Tasks\GetPaginatedAllUsersTask;
use App\Containers\User\Tests\TestCase;
use Illuminate\Pagination\LengthAwarePaginator;
use PHPUnit\Framework\MockObject\MockObject;

class GetAllUsersActionTest extends TestCase {

    /**
     * @var MockObject | GetPaginatedAllUsersTask
     */
    private $getPaginatedAllUsersTask;

    /**
     * @var int
     */
    private $adminsCount = 3;

    /**
     * @var int
     */
    private $clientsCount = 5;

    public function setUp() {
        parent::setUp();

        $this->getPaginatedAllUsersTask = $this->getMockBuilder(GetPaginatedAllUsersTask::class)
            ->disableOriginalConstructor()->getMock();
    }

    public function test_IfReturnsCorrectly() {
        for ($i = 0; $i < $this->clientsCount; $i++) {
            $users[$i] = $this->createUserByEmail('test@test.test_' . $i);
        }

        $paginator = new LengthAwarePaginator($users, count($users), env('PAGINATION_LIMIT_DEFAULT', 10), 1);

        $this->getPaginatedAllUsersTask->method('run')->willReturn($paginator);

        $action = new GetAllUsersAction($this->getPaginatedAllUsersTask);
        $result = $action->run();

        $this->assertInstanceOf(LengthAwarePaginator::class, $result, 'Return type is not LengthAwarePaginator');
        $this->assertEquals($this->clientsCount, $result->count());
    }


    public function test_CheckWithOnlyUsers() {
        $this->deleteAllUsers();

        //  Create some users
        $this->createUsersByEmail($this->clientsCount);

        $result = Apiato::call('User@GetAllUsersAction');

        $this->assertInstanceOf(LengthAwarePaginator::class, $result, 'Return type is not LengthAwarePaginator');
        $this->assertEquals($this->clientsCount, $result->count());
    }

    public function test_CheckWithOnlyAdmins() {
        $this->deleteAllUsers();

        //  Create some admins
        $this->createUsersByEmail($this->adminsCount, 'password', false);

        $result = Apiato::call('User@GetAllUsersAction');

        $this->assertInstanceOf(LengthAwarePaginator::class, $result, 'Return type is not LengthAwarePaginator');
        $this->assertEquals($this->adminsCount, $result->count());
    }

    public function test_CheckWithUsersAndAdmins() {
        $this->deleteAllUsers();

        //  Create some users
        $this->createUsersByEmail($this->clientsCount);

        //  Create some admins
        $this->createUsersByEmail($this->adminsCount, 'password', false);

        $result = Apiato::call('User@GetAllUsersAction');

        $usersCount = $this->clientsCount + $this->adminsCount;

        $this->assertInstanceOf(LengthAwarePaginator::class, $result, 'Return type is not LengthAwarePaginator');
        $this->assertEquals($usersCount, $result->count());
    }

    public function tearDown() {
        parent::tearDown();

        unset($this->getPaginatedAllUsersTask);
        unset($this->adminsCount);
        unset($this->clientsCount);
    }
}
