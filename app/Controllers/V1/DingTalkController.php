<?php

namespace App\Controllers\V1;


use App\Exception\ValidateException;
use App\Models\Services\Auth\WechatMiniProgramService;
use Swoft\App;
use Swoft\Http\Message\Bean\Annotation\Middlewares;
use Swoft\Http\Server\Bean\Annotation\Controller;
use Swoft\Http\Server\Bean\Annotation\RequestMapping;
use Swoft\Http\Server\Bean\Annotation\RequestMethod;
use Swoft\Http\Message\Bean\Annotation\Middleware;
use App\Middlewares\SignMiddleware;
use App\Common\Controller\ApiController;
use Exception;
use App\Middlewares\ValidateMiddleware;
use Swoft\Redis\Redis;

/**
 * @Controller(prefix="/v1/dingtalk")
 * @Middleware(ValidateMiddleware::class)
 */
class DingTalkController extends ApiController
{

    /**
     * @RequestMapping(route="callback", method={RequestMethod::POST,RequestMethod::GET})
     *
     * @return string
     * @throws Exception
     */
    public function callback()
    {
        var_dump(\Swoft::param());
    }

}