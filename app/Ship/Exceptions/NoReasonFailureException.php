<?php

namespace App\Containers\User\Exceptions;

use App\Ship\Parents\Exceptions\Exception;
use Symfony\Component\HttpFoundation\Response;

class NoReasonFailureException extends Exception {

    /**
     * @var int
     */
    public $httpStatusCode = Response::HTTP_NOT_IMPLEMENTED;

    /**
     * @var string
     */
    public $message = 'Action failed with no reason.';

}
