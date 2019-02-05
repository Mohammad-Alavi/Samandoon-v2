<?php

namespace App\Containers\User\Tests\Unit;

use App\Containers\User\Tasks\GetPaginatedAllUsersTask;
use App\Containers\User\Tests\TestCase;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\App;

class GetPaginatedAllUsersTaskTest extends TestCase {

    /**
     * @var int
     */
    protected $count = 3;

    /**
     * @var LengthAwarePaginator
     */
    protected $pagination;

    public function test_GetPaginatedAllUsersTaskWorksFine() {
        $this->deleteAllUsers();
        $this->createUsersByPhone($this->count);

        $this->pagination = App::make(GetPaginatedAllUsersTask::class)->run();

        // Assertions
        $this->assertEquals($this->count, $this->pagination->total(), 'Number of items don\'t match.');
    }

    public function tearDown() {
        parent::tearDown();

        unset($this->count);
        unset($this->pagination);
    }
}
