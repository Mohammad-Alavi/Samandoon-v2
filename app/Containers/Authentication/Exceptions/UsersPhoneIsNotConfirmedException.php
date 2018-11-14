<?php

namespace App\Containers\Authentication\Exceptions;

use App\Ship\Parents\Exceptions\Exception;
use Symfony\Component\HttpFoundation\Response;


class UsersPhoneIsNotConfirmedException extends Exception {

    /**
     * @var int
     */
    public $httpStatusCode = Response::HTTP_CONFLICT;

    /**
     * @var string
     */
    public $message = 'The user\'s phone is not confirmed yet. Please verify your phone before trying to login.';
}
