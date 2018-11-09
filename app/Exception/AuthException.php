<?php

namespace App\Exception;

use RuntimeException;
use Throwable;

class AuthException extends RuntimeException
{
    public function __construct(int $code = 0, string $message = "", Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}