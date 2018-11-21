<?php

namespace App\Containers\User\Tests\Unit;

use App\Containers\User\Actions\CheckIfRegistrationRequestIsValidSubAction;
use App\Containers\User\Actions\CreateUserByEmailAndPasswordSubAction;
use App\Containers\User\Actions\CreateUserByPhoneAndPasswordSubAction;
use App\Containers\User\Actions\FindOrCreateUserByPhoneAndOneTimePasswordSubAction;
use App\Containers\User\Actions\RegisterAction;
use App\Containers\User\Exceptions\BadLoginTypeException;
use App\Containers\User\Tests\TestCase;
use App\Containers\User\UI\API\Requests\RegisterRequest;
use PHPUnit\Framework\MockObject\MockObject;

class RegisterActionTest extends TestCase {

    /**
     * @var MockObject | CheckIfRegistrationRequestIsValidSubAction
     */
    private $checkIfRegistrationRequestIsValidSubAction;

    /**
     * @var MockObject | CreateUserByEmailAndPasswordSubAction
     */
    private $createUserByEmailAndPasswordSubAction;

    /**
     * @var MockObject | CreateUserByPhoneAndPasswordSubAction
     */
    private $createUserByPhoneAndPasswordSubAction;

    /**
     * @var MockObject | FindOrCreateUserByPhoneAndOneTimePasswordSubAction
     */
    private $findOrCreateUserByPhoneAndOneTimePasswordSubAction;

    public function setUp() {
        parent::setUp();

        $this->checkIfRegistrationRequestIsValidSubAction = $this->getMockBuilder(CheckIfRegistrationRequestIsValidSubAction::class)
            ->disableOriginalConstructor()->getMock();

        $this->createUserByEmailAndPasswordSubAction = $this->getMockBuilder(CreateUserByEmailAndPasswordSubAction::class)
            ->disableOriginalConstructor()->getMock();

        $this->createUserByPhoneAndPasswordSubAction = $this->getMockBuilder(CreateUserByPhoneAndPasswordSubAction::class)
            ->disableOriginalConstructor()->getMock();

        $this->findOrCreateUserByPhoneAndOneTimePasswordSubAction = $this->getMockBuilder(FindOrCreateUserByPhoneAndOneTimePasswordSubAction::class)
            ->disableOriginalConstructor()->getMock();
    }

    public function test_ShouldCreateUserByEmailAndPasswordIfEmailAndPasswordAreEntered() {
        $this->checkIfRegistrationRequestIsValidSubAction->method('run')->willReturn(true);
        $this->createUserByEmailAndPasswordSubAction->expects($this->once())->method('run');
        $this->createUserByPhoneAndPasswordSubAction->expects($this->never())->method('run');
        $this->findOrCreateUserByPhoneAndOneTimePasswordSubAction->expects($this->never())->method('run');

        $request = new RegisterRequest();
        $request['email'] = 'moslem.deris@gmail.com';
        $request['password'] = 'myPass';

        $action = new RegisterAction(
            $this->checkIfRegistrationRequestIsValidSubAction,
            $this->createUserByEmailAndPasswordSubAction,
            $this->createUserByPhoneAndPasswordSubAction,
            $this->findOrCreateUserByPhoneAndOneTimePasswordSubAction);

        $action->run($request);
    }

    public function test_ShouldCreateUserByPhoneAndPasswordIfPhoneAndPasswordAreEntered() {
        $this->checkIfRegistrationRequestIsValidSubAction->method('run')->willReturn(true);
        $this->createUserByEmailAndPasswordSubAction->expects($this->never())->method('run');
        $this->createUserByPhoneAndPasswordSubAction->expects($this->once())->method('run');
        $this->findOrCreateUserByPhoneAndOneTimePasswordSubAction->expects($this->never())->method('run');

        $request = new RegisterRequest();
        $request['phone'] = '+989362913366';
        $request['password'] = 'myPass';

        $action = new RegisterAction(
            $this->checkIfRegistrationRequestIsValidSubAction,
            $this->createUserByEmailAndPasswordSubAction,
            $this->createUserByPhoneAndPasswordSubAction,
            $this->findOrCreateUserByPhoneAndOneTimePasswordSubAction);

        $action->run($request);
    }

    public function test_ShouldCreateUserByPhoneAndOneTimePasswordIfOnlyPhoneIsEntered() {
        $this->checkIfRegistrationRequestIsValidSubAction->method('run')->willReturn(true);
        $this->createUserByEmailAndPasswordSubAction->expects($this->never())->method('run');
        $this->createUserByPhoneAndPasswordSubAction->expects($this->never())->method('run');
        $this->findOrCreateUserByPhoneAndOneTimePasswordSubAction->expects($this->once())->method('run');

        $request = new RegisterRequest();
        $request['phone'] = '+989362913366';

        $action = new RegisterAction(
            $this->checkIfRegistrationRequestIsValidSubAction,
            $this->createUserByEmailAndPasswordSubAction,
            $this->createUserByPhoneAndPasswordSubAction,
            $this->findOrCreateUserByPhoneAndOneTimePasswordSubAction);

        $action->run($request);
    }

    public function test_ShouldThrowExceptionIfBadParametersAreEntered() {
        $this->checkIfRegistrationRequestIsValidSubAction->method('run')->willReturn(true);
        $this->createUserByEmailAndPasswordSubAction->expects($this->never())->method('run');
        $this->createUserByPhoneAndPasswordSubAction->expects($this->never())->method('run');
        $this->findOrCreateUserByPhoneAndOneTimePasswordSubAction->expects($this->never())->method('run');

        $request = new RegisterRequest();
        //  No parameters are entered! (Bad parameter - Bad Login Type)

        $action = new RegisterAction(
            $this->checkIfRegistrationRequestIsValidSubAction,
            $this->createUserByEmailAndPasswordSubAction,
            $this->createUserByPhoneAndPasswordSubAction,
            $this->findOrCreateUserByPhoneAndOneTimePasswordSubAction);

        $this->expectException(BadLoginTypeException::class);

        $action->run($request);
    }

    public function tearDown() {
        parent::tearDown();

        unset($this->checkIfRegistrationRequestIsValidSubAction);
        unset($this->createUserByEmailAndPasswordSubAction);
        unset($this->createUserByPhoneAndPasswordSubAction);
        unset($this->findOrCreateUserByPhoneAndOneTimePasswordSubAction);
    }
}
