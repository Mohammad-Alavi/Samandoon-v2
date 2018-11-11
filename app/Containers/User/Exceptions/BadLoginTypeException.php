<?php

namespace App\Containers\User\Exceptions;

use App\Ship\Parents\Exceptions\Exception;
use Symfony\Component\HttpFoundation\Response;

class BadLoginTypeException extends Exception {

    /**
     * @var int
     */
    public $httpStatusCode = Response::HTTP_BAD_REQUEST;

    /**
     * @var string
     */
    public $message = 'This username or password type is not supported.';

}
