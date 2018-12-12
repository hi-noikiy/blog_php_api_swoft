<?php

namespace App\Middlewares;

use App\Models\Services\OperatorLogService;
use Psr\Http\Server\RequestHandlerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Swoft\Bean\Annotation\Inject;
use Swoft\Bean\Annotation\Bean;
use Swoft\Http\Message\Middleware\MiddlewareInterface;


/**
 * @Bean()
 */
class LogMiddleware implements MiddlewareInterface
{

    /**
     *
     * @Inject()
     * @var OperatorLogService
     */
    private $operatorLogService;


    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $response = $handler->handle($request);


        //__devtool 不写入日志
        if (strpos($request->getUri()->getPath(), '__devtool') === false) {
            $this->operatorLogService->write([
                'access-token' => \Swoft::swoole_header('access-token'),
                'uri' => $request->getUri()->getPath(),
                'method' => $request->getMethod(),
                'param' => json_encode(empty(\Swoft::param()) ? new \stdClass() : \Swoft::param(), JSON_UNESCAPED_UNICODE),
                'response' => $response->getBody()->getContents(),
                'ip' => \Swoft::ip()
            ]);
        }

        return $response;
    }
}