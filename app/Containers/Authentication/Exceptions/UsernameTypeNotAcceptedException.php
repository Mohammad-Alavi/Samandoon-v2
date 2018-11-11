<?php

namespace App\Containers\Authentication\Exceptions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Exceptions\Exception;
use Exception as BaseException;
use Symfony\Component\HttpFoundation\Response;

class UsernameTypeNotAcceptedException extends Exception {

    /**
     * @var int
     */
    public $httpStatusCode = Response::HTTP_BAD_REQUEST;

    /**
     * @var string
     */
    public $message;

    /**
     * Exception constructor.
     *
     * @param null            $message
     * @param null            $errors
     * @param null            $statusCode
     * @param int             $code
     * @param \Exception|null $previous
     * @param array           $headers
     */
    public function __construct($message = null, $errors = null, $statusCode = null, int $code = 0, ?BaseException $previous = null, array $headers = []) {
        parent::__construct($message, $errors, $statusCode, $code, $previous, $headers);

        $allowedLoginUsernameFields = Apiato::call('Authentication@GetAllowedLoginUsernameTypesTask');

        if ($message == null)
            $this->message = 'Allowed username types are: ' . $allowedLoginUsernameFields;
    }
}
