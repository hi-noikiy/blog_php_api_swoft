<?php

namespace App\Middlewares;

use App\Common\Code\Code;
use App\Exception\AuthException;
use App\Models\Token\AuthManager;
use App\Models\Token\AuthToken;
use App\Models\Services\TokenService;
use Psr\Http\Server\RequestHandlerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Swoft\Bean\Annotation\Bean;
use Swoft\Bean\Annotation\Value;
use Swoft\Core\RequestContext;
use Swoft\Http\Message\Middleware\MiddlewareInterface;
use Swoft\Bean\Annotation\Inject;
use Swoft\Http\Server\AttributeEnum;

/**
 * @Bean()
 * @uses      AuthMiddleware
 */
class AuthMiddleware implements MiddlewareInterface
{
    /**
     * @Inject()
     * @var \Swoft\Redis\Redis $redis
     */
    private $redis;

    /**
     * @Inject()
     * @var AuthToken
     */
    private $authToken;

    /**
     *
     * @Inject()
     * @var AuthManager
     */
    private $authManager;
    /**
     *
     * @Inject()
     * @var TokenService
     */
    private $tokenService;

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $accessToken = \Swoft::accessToken();

        $httpHandler = $request->getAttribute(AttributeEnum::ROUTER_ATTRIBUTE);
        $info = $httpHandler[2];
        //是否严格验证登录态
        if (isset($info['option']['params']['strict']) && $info['option']['params']['strict'] === false) {
            $user_info = $this->tokenService->getUserInfoByToken($accessToken, false);
        } else {
            if (!$accessToken) {
                throw new AuthException(Code::INVALID_TOKEN, '请输入Access-Token');
            }
            $user_info = $this->tokenService->getUserInfoByToken($accessToken);
        }
        $authToken = $this->authToken->setUserId($user_info['user_id'])->setUserInfo($user_info);
        $this->authManager->setSession($authToken);

        // 委托给下一个中间件处理
        $response = $handler->handle($request);

        return $response;
    }
}