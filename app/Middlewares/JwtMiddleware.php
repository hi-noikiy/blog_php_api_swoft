<?php

namespace App\Middlewares;

use App\Common\Code\Code;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\JWT;
use Psr\Http\Server\RequestHandlerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Swoft\Bean\Annotation\Bean;
use Swoft\Bean\Annotation\Value;
use Swoft\Http\Message\Middleware\MiddlewareInterface;
use Swoft\Bean\Annotation\Inject;
use Exception;

/**
 * @Bean()
 * @uses      JwtMiddleware
 */
class JwtMiddleware implements MiddlewareInterface
{
    /**
     * @Value(env="${JWT_KEY}")
     */
    private $jwt_key;

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {

        $accessToken = $request->getHeader('access-token');
        if (!end($accessToken)) {
            throw new Exception('access-token不存在', Code::UNLOGIN);
        }
        var_dump(explode('/',$request->getUri()->getPath()));

        try {
            $decode = JWT::decode(end($accessToken), $this->jwt_key, ['HS256']);
        } catch (ExpiredException $e) {
            throw new ExpiredException('请重新登录', Code::INVALID_TOKEN);
        }

        $request = $request->withAttribute('uid',$decode->uid);
//        return response()->raw(Encrypt::encrypt(json_encode($request->getParsedBody() + $request->getQueryParams())))->withoutHeader('Content-Type')->withAddedHeader('Content-Type', 'application/octet-stream');
        // 委托给下一个中间件处理
        $response = $handler->handle($request);

        return $response;
    }
}