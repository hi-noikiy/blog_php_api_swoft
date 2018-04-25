<?php

namespace App\Middlewares;

use Firebase\JWT\JWT;
use Psr\Http\Server\RequestHandlerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Swoft\Bean\Annotation\Bean;
use Swoft\Bean\Annotation\Value;
use Swoft\Http\Message\Middleware\MiddlewareInterface;
use Swoft\Bean\Annotation\Inject;

/**
 * @Bean()
 * @uses      JwtMiddleware
 */
class JwtMiddleware implements MiddlewareInterface
{

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {

        $accessToken = $request->getHeader('access-token');
        end($accessToken);


//        return response()->raw(Encrypt::encrypt(json_encode($request->getParsedBody() + $request->getQueryParams())))->withoutHeader('Content-Type')->withAddedHeader('Content-Type', 'application/octet-stream');
        // 委托给下一个中间件处理
        $response = $handler->handle($request);

        return $response;
    }
}