<?php

namespace App\Exception;

use App\Common\Code\Code;
use RuntimeException;
use Throwable;

class ValidateException extends RuntimeException
{
    public function __construct(string $message = "", int $code = Code::INVALID_PARAMETER, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}