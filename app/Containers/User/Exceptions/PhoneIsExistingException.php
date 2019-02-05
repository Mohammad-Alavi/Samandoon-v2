<?php

namespace App\Containers\User\Exceptions;

use App\Ship\Parents\Exceptions\Exception;
use Symfony\Component\HttpFoundation\Response;

class PhoneIsExistingException extends Exception {

    /**
     * @var int
     */
    public $httpStatusCode = Response::HTTP_CONFLICT;

    /**
     * @var string
     */
    public $message = 'Phone is already existing.';

}
