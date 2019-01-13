<?php

namespace App\Containers\Transaction\Exceptions;

use App\Ship\Parents\Exceptions\Exception;
use Symfony\Component\HttpFoundation\Response;

class BadTransactionGatewayException extends Exception {
    public $httpStatusCode = Response::HTTP_BAD_REQUEST;

    public $message = 'Gateway is not implemented.';

    public $code = 0;
}
