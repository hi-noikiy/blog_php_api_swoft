<?php

namespace App\Controllers\V1;


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
 * @Controller(prefix="/v1/miniprogram")
 * @Middleware(ValidateMiddleware::class)
 */
class MiniProgramController extends ApiController
{

    /**
     * @RequestMapping(route="session_key", method=RequestMethod::POST)
     *
     * @return string
     * @throws Exception
     */
    public function getSessionKey()
    {
        $data = \Swoft::miniProgram()->auth->session(\Swoft::param('code'));

        return $this->respondWithArray($data);
    }


    /**
     * @RequestMapping(route="signin", method=RequestMethod::POST)
     *
     * @return string
     * @throws Exception
     */
    public function signin()
    {
        $session_key = \Swoft::param('session_key');
        $iv = \Swoft::param('iv');
        $encryptedData = \Swoft::param('encryptedData');

        $decryptData = \Swoft::miniProgram()->encryptor->decryptData($session_key, $iv, $encryptedData);

        /* @var WechatMiniProgramService $wechatMiniProgramService */
        $wechatMiniProgramService = App::getBean(WechatMiniProgramService::class);
        $data = $wechatMiniProgramService->auth($decryptData);
        return $this->respondWithArray($data);
    }

}