<?php

namespace App\Common\Controller;

use App\Common\Code\Code;
use Swoft\Core\RequestContext;
use Swoft\Http\Message\Server\Response;


class ApiController
{
    protected $statusCode = 200;

    public function respondWithArray($array = null, $msg = '请求成功'): Response
    {
        $data = [
            "code" => Code::SUCCESS,
            "res" => is_array($array) ? (count($array) ? $array : null) : $array,
            "msg" => $msg
        ];
        return response()->json($data);
    }

    public function respondWithError($msg): Response
    {
        if ($this->statusCode === 200) {
            throw new \Exception("You better have a really good reason for erroring on a 200...", 500);
//            trigger_error(
//                "You better have a really good reason for erroring on a 200...",
//                E_USER_WARNING
//            );
        }

        $data = [
            "code" => $this->statusCode,
            "res" => null,
            "msg" => $msg
        ];
        return response()->json($data);
    }

    public function getStatusCode()
    {
        return $this->statusCode;
    }

    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;

        return $this;
    }
}