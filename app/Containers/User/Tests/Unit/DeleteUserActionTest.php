<?php

namespace App\Containers\User\Tests\Unit;

use App\Containers\User\Actions\DeleteUserAction;
use App\Containers\User\Models\User;
use App\Containers\User\Tasks\CheckIfUserIsExistingTask;
use App\Containers\User\Tasks\DeleteUserTask;
use App\Containers\User\Tests\TestCase;
use App\Ship\Transporters\DataTransporter;
use Illuminate\Support\Facades\App;
use PHPUnit\Framework\MockObject\MockObject;

class DeleteUserActionTest extends TestCase {

    /**
     * @var User
     */
    private $user;

    public function setUp() {
        parent::setUp();

        $this->user = $this->createUserByEmail();
    }

    public function test_IfWorksCorrectly() {
        App::make(DeleteUserAction::class)->run(new DataTransporter(['id' => $this->user->id]));

        //  Check if user is deleted
        $isUserExisting = App::make(CheckIfUserIsExistingTask::class)->run($this->user->id);
        $this->assertFalse($isUserExisting, 'The user has not been deleted.');
    }
}
