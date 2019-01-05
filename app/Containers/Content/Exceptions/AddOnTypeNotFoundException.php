<?php

namespace App\Containers\Content\Exceptions;

use App\Ship\Parents\Exceptions\Exception;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class AddOnTypeNotFoundException
 *
 * @package App\Containers\Content\Exceptions
 */
class AddOnTypeNotFoundException extends Exception
{
    /**
     * @var int
     */
    public $httpStatusCode = Response::HTTP_NOT_ACCEPTABLE;

    /**
     * @var string
     */
    public $message = 'AddOn type not found.';
}
