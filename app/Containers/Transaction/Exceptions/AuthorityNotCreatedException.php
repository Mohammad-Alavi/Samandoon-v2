<?php

namespace App\Containers\Transaction\Exceptions;

use App\Ship\Parents\Exceptions\Exception;
use Symfony\Component\HttpFoundation\Response;

class AuthorityNotCreatedException extends Exception {
    public $httpStatusCode = Response::HTTP_BAD_REQUEST;

    public $message = 'Authority not created by zarinpal.';

    public $code = 0;
}
