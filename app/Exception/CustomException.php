<?php
/**
 * 用户本身业务上的不正常操作,重复提交,重复发验证码
 * @author cpj
 * @date 2018/11/29
 */

namespace App\Exception;


use App\Common\Code\Code;
use Throwable;

class CustomException extends \RuntimeException
{
    public function __construct(string $message = "操作非法", int $code = Code::INVALID_REQUEST, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}