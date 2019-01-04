<?php

namespace App\Controllers\V1;


use App\Exception\ValidateException;
use App\Models\Token\AuthToken;
use App\Models\Services\Auth\WechatMiniProgramService;
use App\Models\Token\AuthManager;
use Swoft\App;
use Swoft\Core\RequestContext;
use Swoft\Http\Message\Bean\Annotation\Middlewares;
use Swoft\Http\Server\Bean\Annotation\Controller;
use Swoft\Http\Server\Bean\Annotation\RequestMapping;
use Swoft\Http\Server\Bean\Annotation\RequestMethod;
use Swoft\Http\Message\Bean\Annotation\Middleware;
use App\Middlewares\SignMiddleware;
use App\Common\Controller\ApiController;
use Exception;
use App\Middlewares\AuthMiddleware;
use Swoft\Bean\Annotation\Inject;


/**
 * @Controller(prefix="/v1/user")
 * @Middleware(AuthMiddleware::class)
 */
class UserController extends ApiController
{
    /**
     *
     * @Inject()
     * @var AuthManager
     */
    private $authManager;

    /**
     * @RequestMapping(route="info", method=RequestMethod::GET)
     *
     * @return string
     * @throws Exception
     */
    public function info()
    {
        $info = $this->authManager->getSession()->getUserInfo();
        return $this->respondWithArray(compact('info'));
    }

}