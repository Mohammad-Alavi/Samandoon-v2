<?php

namespace App\Containers\User\Tests\Unit;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\User\Actions\GetAllClientsAction;
use App\Containers\User\Tasks\GetPaginatedAllUsersTask;
use App\Containers\User\Tests\TestCase;
use Illuminate\Pagination\LengthAwarePaginator;
use PHPUnit\Framework\MockObject\MockObject;

class GetAllClientsActionTest extends TestCase {

    /**
     * @var MockObject | GetPaginatedAllUsersTask
     */
    private $getPaginatedAllUsersTask;

    /**
     * @var int
     */
    private $clientsCount = 4;

    public function setUp() {
        parent::setUp();

        $this->getPaginatedAllUsersTask = $this->getMockBuilder(GetPaginatedAllUsersTask::class)
            ->disableOriginalConstructor()->getMock();
    }

    public function test_IfReturnsCorrectly() {
        for ($i = 0; $i < $this->clientsCount; $i++) {
            $clients[$i] = $this->createUserByEmail('test@test.test_' . $i);
        }

        $paginator = new LengthAwarePaginator($clients, count($clients), env('PAGINATION_LIMIT_DEFAULT', 10), 1);

        $this->getPaginatedAllUsersTask->method('run')->willReturn($paginator);

        $action = new GetAllClientsAction($this->getPaginatedAllUsersTask);
        $result = $action->run();

        $this->assertInstanceOf(LengthAwarePaginator::class, $result, 'Return type is not LengthAwarePaginator');
        $this->assertEquals($this->clientsCount, $result->count());
    }


    public function test_CheckWithAdmins() {
        $this->deleteAllUsers();

        //  Create some clients
        $this->createUsersByEmail($this->clientsCount, 'password', false);

        $result = Apiato::call('User@GetAllClientsAction');

        $this->assertInstanceOf(LengthAwarePaginator::class, $result, 'Return type is not LengthAwarePaginator');
        $this->assertEquals(0, $result->count());
    }

    public function test_CheckWithClientsAndAdmins() {
        $this->deleteAllUsers();

        //  Create some clients
        $this->createUsersByEmail($this->clientsCount);

        //  Create some admins
        $this->createUsersByEmail(2, 'password', false);

        $result = Apiato::call('User@GetAllClientsAction');

        $this->assertInstanceOf(LengthAwarePaginator::class, $result, 'Return type is not LengthAwarePaginator');
        $this->assertEquals($this->clientsCount, $result->count());
    }

    public function tearDown() {
        parent::tearDown();

        unset($this->getPaginatedAllUsersTask);
        unset($this->clientsCount);
    }
}
