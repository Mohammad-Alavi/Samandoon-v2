<?php

namespace App\Containers\User\Tests\Unit;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\User\Models\User;
use App\Containers\User\Tests\TestCase;

class UpdateUserPasswordSubActionTest extends TestCase {

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
        $this->editedUser = Apiato::call('User@UpdateUserPasswordSubAction', [$this->user->id, '123456']);
    }

    public function test_ShouldReturnUserType() {
        $this->assertInstanceOf(User::class, $this->editedUser);
    }

    public function test_ShouldReturnUserWithSameId() {
        $this->assertSame($this->user->id, $this->editedUser->id);
    }

    public function test_ShouldChangePassword() {
        $this->assertNotSame($this->user->password, $this->editedUser->password);
    }

    public function test_ShouldChangePasswordUpdatedDate() {
        $this->assertNotSame($this->user->password_updated_at, $this->editedUser->password_updated_at);
    }

    public function tearDown() {
        parent::tearDown();

        unset($this->user);
        unset($this->editedUser);
    }
}
