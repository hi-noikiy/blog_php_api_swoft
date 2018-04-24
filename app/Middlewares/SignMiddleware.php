<?php

namespace App\Middlewares;


use App\Common\Utility\Encrypt;
use App\Common\Utility\Token;
use Psr\Http\Server\RequestHandlerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Swoft\Bean\Annotation\Bean;
use Swoft\Bean\Annotation\Value;
use Swoft\Http\Message\Middleware\MiddlewareInterface;

/**
 * @Bean()
 * @uses      SignMiddleware
 */
class SignMiddleware implements MiddlewareInterface
{
    /**
     * @Value(env="${IS_DEBUG}")
     * @var bool
     */
    private $is_debug;

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $input = $request->getParsedBody() + $request->getQueryParams();
        if ($this->is_debug) {
            $encrypt = new Encrypt();
            $encrypt->checkSign($input);
        }

//        return response()->raw(Encrypt::encrypt(json_encode($request->getParsedBody() + $request->getQueryParams())))->withoutHeader('Content-Type')->withAddedHeader('Content-Type', 'application/octet-stream');
        // 委托给下一个中间件处理
        $response = $handler->handle($request);

        return $response;
    }
}