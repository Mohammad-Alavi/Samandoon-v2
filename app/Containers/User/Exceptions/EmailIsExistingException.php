<?php

namespace App\Containers\User\Exceptions;

use App\Ship\Parents\Exceptions\Exception;
use Symfony\Component\HttpFoundation\Response;

class EmailIsExistingException extends Exception {

    /**
     * @var int
     */
    public $httpStatusCode = Response::HTTP_CONFLICT;

    /**
     * @var string
     */
    public $message = 'Email address is already existing.';

}
