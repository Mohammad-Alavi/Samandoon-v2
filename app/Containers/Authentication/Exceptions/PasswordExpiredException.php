<?php

namespace App\Containers\Authentication\Exceptions;

use App\Ship\Parents\Exceptions\Exception;
use Symfony\Component\HttpFoundation\Response;

class PasswordExpiredException extends Exception
{
    public $httpStatusCode = Response::HTTP_FORBIDDEN;

    public $message = 'Password is expired.';
}
