<?php

namespace App\Containers\User\Tests\Unit;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\User\Models\User;
use App\Containers\User\Tests\TestCase;

class UpdateUserOneTimePasswordSubActionTest extends TestCase {

    /**
     * @var User
     */
    private $user;
    /**
     * @var User
     */
    private $editedUser;

    public function setUp() {
        parent::setUp();

        $this->user = $this->createUserByEmail();
        $this->editedUser = Apiato::call('User@UpdateUserOneTimePasswordSubAction', [$this->user->id, '1234']);
    }

    public function test_ShouldReturnUserType() {
        $this->assertInstanceOf(User::class, $this->editedUser);
    }

    public function test_ShouldReturnUserWithSameId() {
        $this->assertSame($this->user->id, $this->editedUser->id);
    }

    public function test_ShouldChangeOneTimePassword() {
        $this->assertNotSame($this->user->one_time_password, $this->editedUser->one_time_password);
    }

    public function test_ShouldChangeOneTimePasswordUpdatedDate() {
        $this->assertNotSame($this->user->one_time_password_updated_at, $this->editedUser->one_time_password_updated_at);
    }

    public function tearDown() {
        parent::tearDown();

        unset($this->user);
        unset($this->editedUser);
    }
}
