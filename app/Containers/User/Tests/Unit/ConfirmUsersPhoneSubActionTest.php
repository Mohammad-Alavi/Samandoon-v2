<?php

namespace App\Containers\User\Tests\Unit;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\User\Models\User;
use App\Containers\User\Tests\TestCase;

class ConfirmUsersPhoneSubActionTest extends TestCase {

    /**
     * @var User
     */
    protected $user;

    public function setUp() {
        parent::setUp();
        $this->user = $this->createUserByPhone();
    }

    public function test_TaskConfirmsUsersPhone() {
        $this->assertFalse($this->user->is_phone_confirmed, 'Phone should not be confirmed when the user is just created');
        $this->user = Apiato::call('User@ConfirmUsersPhoneSubAction', [$this->user->id]);
        $this->assertTrue($this->user->is_phone_confirmed, 'This sub action could not confirm user\'s phone');
    }

    public function tearDown() {
        parent::tearDown();

        unset($this->user);
    }
}
