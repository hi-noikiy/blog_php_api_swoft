<?php

namespace App\Exception;


use App\Common\Code\Code;
use Throwable;

class NotDefinedException extends \RuntimeException
{
    public function __construct(string $message = "", int $code = Code::ERROR_NO_DEFINED, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}