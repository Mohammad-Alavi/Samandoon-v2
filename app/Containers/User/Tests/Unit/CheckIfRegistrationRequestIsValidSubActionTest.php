<?php

namespace App\Containers\User\Tests\Unit;

use App\Containers\Authentication\Tasks\GetAllowedLoginPasswordTypeTask;
use App\Containers\Authentication\Tasks\GetAllowedLoginUsernameTypesTask;
use App\Containers\User\Actions\CheckIfRegistrationRequestIsValidSubAction;
use App\Containers\User\Exceptions\BadLoginTypeException;
use App\Containers\User\Tests\TestCase;
use App\Containers\User\UI\API\Requests\RegisterRequest;
use PHPUnit\Framework\MockObject\MockObject;

class CheckIfRegistrationRequestIsValidSubActionTest extends TestCase {

    /**
     * @var MockObject | GetAllowedLoginUsernameTypesTask
     */
    protected $getAllowedLoginUsernameTypesTask;

    /**
     * @var MockObject | GetAllowedLoginPasswordTypeTask
     */
    protected $getAllowedLoginPasswordTypesTask;

    /**
     * @var CheckIfRegistrationRequestIsValidSubAction
     */
    protected $checkIfRegistrationRequestIsValidSubAction;

    public function setUp() {
        parent::setUp();

        $this->getAllowedLoginUsernameTypesTask =
            $this->getMockBuilder(GetAllowedLoginUsernameTypesTask::class)->getMock();

        $this->getAllowedLoginPasswordTypesTask =
            $this->getMockBuilder(GetAllowedLoginPasswordTypeTask::class)->getMock();
    }

    /*
    |--------------------------------------------------------------------------
    | Check validation for bad situations (1)
    |--------------------------------------------------------------------------
    |
    | It should throw an exception because password is not needed but is entered
    |
    */
    public function test_CheckValidationForBadSituations_1() {
        $request = new RegisterRequest();
        $request['phone'] = '+989362913366';
        $request['password'] = 'password';

        $this->getAllowedLoginUsernameTypesTask->method('run')->will($this->returnValue(['phone', 'email']));
        $this->getAllowedLoginPasswordTypesTask->method('run')->will($this->returnValue('one_time_password'));

        $this->checkIfRegistrationRequestIsValidSubAction =
            new CheckIfRegistrationRequestIsValidSubAction(
                $this->getAllowedLoginUsernameTypesTask,
                $this->getAllowedLoginPasswordTypesTask);

        $this->expectException(BadLoginTypeException::class);
        $this->checkIfRegistrationRequestIsValidSubAction->run($request);
    }

    /*
    |--------------------------------------------------------------------------
    | Check validation for bad situations (2)
    |--------------------------------------------------------------------------
    |
    | It should throw an exception because password is needed but not entered
    |
    */
    public function test_CheckValidationForBadSituations_2() {
        $request = new RegisterRequest();
        $request['phone'] = '+989362913366';

        $this->getAllowedLoginUsernameTypesTask->method('run')->will($this->returnValue(['phone', 'email']));
        $this->getAllowedLoginPasswordTypesTask->method('run')->will($this->returnValue('password'));

        $this->checkIfRegistrationRequestIsValidSubAction =
            new CheckIfRegistrationRequestIsValidSubAction(
                $this->getAllowedLoginUsernameTypesTask,
                $this->getAllowedLoginPasswordTypesTask);

        $this->expectException(BadLoginTypeException::class);
        $this->checkIfRegistrationRequestIsValidSubAction->run($request);
    }

    /*
    |--------------------------------------------------------------------------
    | Check validation for bad situations (3)
    |--------------------------------------------------------------------------
    |
    | It should throw an exception because email and phone are both entered
    |
    */
    public function test_CheckValidationForBadSituations_3() {
        $request = new RegisterRequest();
        $request['phone'] = '+989362913366';
        $request['email'] = 'test@test.test';
        $request['password'] = 'password';

        $this->getAllowedLoginUsernameTypesTask->method('run')->will($this->returnValue(['phone', 'email']));
        $this->getAllowedLoginPasswordTypesTask->method('run')->will($this->returnValue('password'));

        $this->checkIfRegistrationRequestIsValidSubAction =
            new CheckIfRegistrationRequestIsValidSubAction(
                $this->getAllowedLoginUsernameTypesTask,
                $this->getAllowedLoginPasswordTypesTask);

        $this->expectException(BadLoginTypeException::class);
        $this->checkIfRegistrationRequestIsValidSubAction->run($request);
    }

    /*
    |--------------------------------------------------------------------------
    | Check validation for bad situations (4)
    |--------------------------------------------------------------------------
    |
    | It should throw an exception because email and phone are both missing
    |
    */
    public function test_CheckValidationForBadSituations_4() {
        $request = new RegisterRequest();
        $request['password'] = 'password';

        $this->getAllowedLoginUsernameTypesTask->method('run')->will($this->returnValue(['phone', 'email']));
        $this->getAllowedLoginPasswordTypesTask->method('run')->will($this->returnValue('password'));

        $this->checkIfRegistrationRequestIsValidSubAction =
            new CheckIfRegistrationRequestIsValidSubAction(
                $this->getAllowedLoginUsernameTypesTask,
                $this->getAllowedLoginPasswordTypesTask);

        $this->expectException(BadLoginTypeException::class);
        $this->checkIfRegistrationRequestIsValidSubAction->run($request);
    }

    /*
    |--------------------------------------------------------------------------
    | Check validation for bad situations (5)
    |--------------------------------------------------------------------------
    |
    | It should throw an exception because phone is not allowed but entered
    |
    */
    public function test_CheckValidationForBadSituations_5() {
        $request = new RegisterRequest();
        $request['phone'] = '+989362913366';
        $request['password'] = 'password';

        $this->getAllowedLoginUsernameTypesTask->method('run')->will($this->returnValue(['email']));
        $this->getAllowedLoginPasswordTypesTask->method('run')->will($this->returnValue('password'));

        $this->checkIfRegistrationRequestIsValidSubAction =
            new CheckIfRegistrationRequestIsValidSubAction(
                $this->getAllowedLoginUsernameTypesTask,
                $this->getAllowedLoginPasswordTypesTask);

        $this->expectException(BadLoginTypeException::class);
        $this->checkIfRegistrationRequestIsValidSubAction->run($request);
    }

    /*
    |--------------------------------------------------------------------------
    | Check validation for bad situations (6)
    |--------------------------------------------------------------------------
    |
    | It should throw an exception because email is not allowed but entered
    |
    */
    public function test_CheckValidationForBadSituations_6() {
        $request = new RegisterRequest();
        $request['email'] = 'test@test.test';
        $request['password'] = 'password';

        $this->getAllowedLoginUsernameTypesTask->method('run')->will($this->returnValue(['phone']));
        $this->getAllowedLoginPasswordTypesTask->method('run')->will($this->returnValue('password'));

        $this->checkIfRegistrationRequestIsValidSubAction =
            new CheckIfRegistrationRequestIsValidSubAction(
                $this->getAllowedLoginUsernameTypesTask,
                $this->getAllowedLoginPasswordTypesTask);

        $this->expectException(BadLoginTypeException::class);
        $this->checkIfRegistrationRequestIsValidSubAction->run($request);
    }

    /*
    |--------------------------------------------------------------------------
    | Check validation for good situations (1)
    |--------------------------------------------------------------------------
    |
    | It should not throw any exceptions because the situation is normal
    |
    | Registration type:    Email + Password
    |
    | Allowed values:       Email - Phone - Password
    |
    */
    public function test_CheckValidationForGoodSituations_1() {
        $request = new RegisterRequest();
        $request['email'] = 'test@test.test';
        $request['password'] = 'password';

        $this->getAllowedLoginUsernameTypesTask->method('run')->will($this->returnValue(['email', 'phone']));
        $this->getAllowedLoginPasswordTypesTask->method('run')->will($this->returnValue('password'));

        $this->checkIfRegistrationRequestIsValidSubAction =
            new CheckIfRegistrationRequestIsValidSubAction(
                $this->getAllowedLoginUsernameTypesTask,
                $this->getAllowedLoginPasswordTypesTask);

        $result = $this->checkIfRegistrationRequestIsValidSubAction->run($request);
        $this->assertTrue($result, 'User is registering with valid username and password types but not accepted!');
    }

    /*
    |--------------------------------------------------------------------------
    | Check validation for good situations (2)
    |--------------------------------------------------------------------------
    |
    | It should not throw any exceptions because the situation is normal
    |
    | Registration type:    Email + Password
    |
    | Allowed values:       Email - Password
    |
    */
    public function test_CheckValidationForGoodSituations_2() {
        $request = new RegisterRequest();
        $request['email'] = 'test@test.test';
        $request['password'] = 'password';

        $this->getAllowedLoginUsernameTypesTask->method('run')->will($this->returnValue(['email']));
        $this->getAllowedLoginPasswordTypesTask->method('run')->will($this->returnValue('password'));

        $this->checkIfRegistrationRequestIsValidSubAction =
            new CheckIfRegistrationRequestIsValidSubAction(
                $this->getAllowedLoginUsernameTypesTask,
                $this->getAllowedLoginPasswordTypesTask);

        $result = $this->checkIfRegistrationRequestIsValidSubAction->run($request);
        $this->assertTrue($result, 'User is registering with valid username and password types but not accepted!');
    }

    /*
    |--------------------------------------------------------------------------
    | Check validation for good situations (3)
    |--------------------------------------------------------------------------
    |
    | It should not throw any exceptions because the situation is normal
    |
    | Registration type:    Phone + Password
    |
    | Allowed values:       Phone - Email - Password
    |
    */
    public function test_CheckValidationForGoodSituations_3() {
        $request = new RegisterRequest();
        $request['phone'] = '+989362913366';
        $request['password'] = 'password';

        $this->getAllowedLoginUsernameTypesTask->method('run')->will($this->returnValue(['phone', 'email']));
        $this->getAllowedLoginPasswordTypesTask->method('run')->will($this->returnValue('password'));

        $this->checkIfRegistrationRequestIsValidSubAction =
            new CheckIfRegistrationRequestIsValidSubAction(
                $this->getAllowedLoginUsernameTypesTask,
                $this->getAllowedLoginPasswordTypesTask);

        $result = $this->checkIfRegistrationRequestIsValidSubAction->run($request);
        $this->assertTrue($result, 'User is registering with valid username and password types but not accepted!');
    }

    /*
    |--------------------------------------------------------------------------
    | Check validation for good situations (4)
    |--------------------------------------------------------------------------
    |
    | It should not throw any exceptions because the situation is normal
    |
    | Registration type:    Phone + Password
    |
    | Allowed values:       Phone - Password
    |
    */
    public function test_CheckValidationForGoodSituations_4() {
        $request = new RegisterRequest();
        $request['phone'] = '+989362913366';
        $request['password'] = 'password';

        $this->getAllowedLoginUsernameTypesTask->method('run')->will($this->returnValue(['phone']));
        $this->getAllowedLoginPasswordTypesTask->method('run')->will($this->returnValue('password'));

        $this->checkIfRegistrationRequestIsValidSubAction =
            new CheckIfRegistrationRequestIsValidSubAction(
                $this->getAllowedLoginUsernameTypesTask,
                $this->getAllowedLoginPasswordTypesTask);

        $result = $this->checkIfRegistrationRequestIsValidSubAction->run($request);
        $this->assertTrue($result, 'User is registering with valid username and password types but not accepted!');
    }

    /*
    |--------------------------------------------------------------------------
    | Check validation for good situations (5)
    |--------------------------------------------------------------------------
    |
    | It should not throw any exceptions because the situation is normal
    |
    | Registration type:    Phone + One Time Password
    |
    | Allowed values:       Phone - Email
    |
    */
    public function test_CheckValidationForGoodSituations_5() {
        $request = new RegisterRequest();
        $request['phone'] = '+989362913366';

        $this->getAllowedLoginUsernameTypesTask->method('run')->will($this->returnValue(['phone', 'email']));
        $this->getAllowedLoginPasswordTypesTask->method('run')->will($this->returnValue('one_time_password'));

        $this->checkIfRegistrationRequestIsValidSubAction =
            new CheckIfRegistrationRequestIsValidSubAction(
                $this->getAllowedLoginUsernameTypesTask,
                $this->getAllowedLoginPasswordTypesTask);

        $result = $this->checkIfRegistrationRequestIsValidSubAction->run($request);
        $this->assertTrue($result, 'User is registering with valid username and password types but not accepted!');
    }

    /*
    |--------------------------------------------------------------------------
    | Check validation for good situations (6)
    |--------------------------------------------------------------------------
    |
    | It should not throw any exceptions because the situation is normal
    |
    | Registration type:    Phone + One Time Password
    |
    | Allowed values:       Phone
    |
    */
    public function test_CheckValidationForGoodSituations_6() {
        $request = new RegisterRequest();
        $request['phone'] = '+989362913366';

        $this->getAllowedLoginUsernameTypesTask->method('run')->will($this->returnValue(['phone']));
        $this->getAllowedLoginPasswordTypesTask->method('run')->will($this->returnValue('one_time_password'));

        $this->checkIfRegistrationRequestIsValidSubAction =
            new CheckIfRegistrationRequestIsValidSubAction(
                $this->getAllowedLoginUsernameTypesTask,
                $this->getAllowedLoginPasswordTypesTask);

        $result = $this->checkIfRegistrationRequestIsValidSubAction->run($request);
        $this->assertTrue($result, 'User is registering with valid username and password types but not accepted!');
    }

    public function tearDown() {
        parent::tearDown();
        unset($this->getAllowedLoginUsernameTypesTask);
        unset($this->getAllowedLoginPasswordTypesTask);
        unset($this->checkIfRegistrationRequestIsValidSubAction);
    }
}
