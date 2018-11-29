<?php
/**
 * 自己捕捉的mysql redis 代码的操作错误
 * @author cpj
 * @date 2018/11/29
 */

namespace App\Exception;


use App\Common\Code\Code;
use Throwable;

class SystemException extends \RuntimeException
{
    public function __construct(string $message = "", int $code = Code::SYSTEM_ERROR, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}