<?php

namespace App\Controllers\Wechat;

use EasyWeChat\Factory;
use Swoft\Http\Server\Bean\Annotation\Controller;
use Swoft\Http\Server\Bean\Annotation\RequestMapping;
use Swoft\Http\Server\Bean\Annotation\RequestMethod;
use Swoft\Http\Message\Bean\Annotation\Middleware;
use App\Middlewares\SignMiddleware;
use App\Common\Code\Code;
use App\Common\Controller\ApiController;
use Swoft\Http\Message\Server\Request;
use Exception;
use think\validate\ValidateRule;

/**
 * @Controller(prefix="/wechat/server")
 */
class ServerController extends ApiController
{

    /**
     * @RequestMapping(route="officialAccount")
     * @param Request $request
     * @return string
     */
    public function officialAccount(Request $request)
    {
//        $config = [
//            'app_id' => 'wx92c4cfe821da6b7c',
//            'secret' => '45af75aa24f47cf19d28c905d6ce0223',
//            'token' => 'LosingBattle',
//            'aes_key' => 'YwiOk7ajaPBkZfvfNnvOrVLpTp3QbIb2y64Rq5c8Exq',
//            'response_type' => 'array',
//        ];
//        $app = Factory::officialAccount($config);
//        $response = $app->server->serve();
//
//        // 将响应输出
//        return $response->sendContent(); // Laravel 里请使用：return $response;
    }


}