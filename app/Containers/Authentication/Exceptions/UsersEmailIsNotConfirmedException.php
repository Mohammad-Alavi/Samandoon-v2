<?php

namespace App\Containers\Authentication\Exceptions;

use App\Ship\Parents\Exceptions\Exception;
use Symfony\Component\HttpFoundation\Response;


class UsersEmailIsNotConfirmedException extends Exception {

    /**
     * @var int
     */
    public $httpStatusCode = Response::HTTP_CONFLICT;

    /**
     * @var string
     */
    public $message = 'The user\'s email is not confirmed yet. Please verify your email before trying to login.';
}
