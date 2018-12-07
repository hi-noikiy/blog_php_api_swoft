<?php

namespace App\Common\Controller;

use App\Common\Code\Code;
use App\Exception\ValidateException;
use Swoft\Http\Message\Server\Response;
use Swoft\Bean\Annotation\Inject;
use Exception;
use think\Validate;
use Swoft\Http\Message\Server\Request;

class ApiController
{
    protected $data;

    /**
     * @Inject("demoRedis")
     * @var \Swoft\Redis\Redis
     */
    protected $redis;

    private $statusCode = 200;
    private $message = "请求成功";

    public function respondWithArray($array = null): Response
    {
        $data = [
            "code" => $this->getStatusCode(),
            "data" => is_array($array) ? (count($array) ? $array : new \stdClass()) : new \stdClass(),
            "msg" => $this->getMessage()
        ];
        return response()->json($data);
    }

    public function respondWithError(): Response
    {
        if ($this->statusCode === 200) {
            throw new Exception("You better have a really good reason for erroring on a 200...", 500);
//            trigger_error(
//                "You better have a really good reason for erroring on a 200...",
//                E_USER_WARNING
//            );
        }

        $data = [
            "code" => $this->getStatusCode(),
            "data" => new \stdClass(),
            "msg" => $this->getMessage()
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


    public function setMessage(string $message)
    {
        $this->message = $message;
        return $this;
    }

    private function getMessage()
    {
        return $this->message;
    }

    /**
     * @param $validate string
     * @param $scene string
     * @return Validate
     * @throws  object
     */
    protected function validate($validate, $scene)
    {

//        if (strpos($validate, '.')) {
//            // 支持场景
//            list($validate, $scene) = explode('.', $validate);
//        }
        /* @var Validate $v */
        $v = new $validate;
        if (!empty($scene)) {
            $v->scene($scene);
        }
        if (!$v->check(\Swoft::param())) {
            throw new ValidateException($v->getError());
        } else {
            return $v;
        }
    }
}