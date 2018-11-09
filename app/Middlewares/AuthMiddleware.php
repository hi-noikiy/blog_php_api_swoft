<?php

namespace App\Middlewares;

use App\Models\Token;
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


    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {

        $accessToken = $request->getHeader('access-token');
//        $clientinfo = $this->token->checkBasicAuth(end($accessToken));

        $request = $request->withAttribute('uid', $clientinfo['user_id'] ?? 0);
//        return response()->raw(Encrypt::encrypt(json_encode($request->getParsedBody() + $request->getQueryParams())))->withoutHeader('Content-Type')->withAddedHeader('Content-Type', 'application/octet-stream');
        // 委托给下一个中间件处理
        $response = $handler->handle($request);

        return $response;
    }
}