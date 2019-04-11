<?php

namespace App\Containers\FCM\Exceptions;

use App\Ship\Parents\Exceptions\Exception;
use Symfony\Component\HttpFoundation\Response;

class CouldNotHandleDownstreamResponseException extends Exception {

    /**
     * @var int
     */
    public $httpStatusCode = Response::HTTP_EXPECTATION_FAILED;

    /**
     * @var string
     */
    public $message = 'Could not handle downstream response';

}
