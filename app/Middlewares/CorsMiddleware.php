<?php

namespace App\Middlewares;

use App\Common\Code\Code;
use Doctrine\Instantiator\Exception\UnexpectedValueException;
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
class CorsMiddleware implements MiddlewareInterface
{

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {

        $response = $handler->handle($request);
        $response->withAddedHeader('Access-Control-Allow-Origin:', '*');
        $response->withAddedHeader('Access-Control-Allow-Headers:', 'Origin, Content-Type, X_Requested_With, X-Requested-With, Accept, Zj-Custom-Rand, Zj-Custom-Timestamp, Zj-Custom-Sign');
        $response->withAddedHeader('Access-Control-Allow-Methods:', 'GET, POST');
        $response->withAddedHeader('Access-Control-Max-Age:', '7200');
        return $response;
    }
}