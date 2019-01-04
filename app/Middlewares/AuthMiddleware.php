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
use Swoft\Http\Message\Middleware\MiddlewareInterface;
use Swoft\Bean\Annotation\Inject;

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
        $accessToken = current($request->getHeader('access-token'));

        if (!$accessToken) {
            throw new AuthException(Code::INVALID_TOKEN, '请输入Access-Token');
        }

        $user_info = $this->tokenService->getUserInfoByToken($accessToken);
        $authToken = $this->authToken->setUserId($user_info['user_id'])->setUserInfo($user_info);
        $this->authManager->setSession($authToken);
        // 委托给下一个中间件处理
        $response = $handler->handle($request);

        return $response;
    }
}