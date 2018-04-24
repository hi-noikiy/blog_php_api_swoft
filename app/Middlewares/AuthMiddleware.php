<?php

namespace App\Middlewares;


use App\Models\Data\UserData;
use App\Models\Token;
use Psr\Http\Server\RequestHandlerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Swoft\App;
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
     * @var \Swoft\Redis\Redis
     */
    private $redis;
    /**
     * @Inject()
     * @var UserData
     */
    private $UserData;

    /**
     * @Inject()
     * @var Token
     */
    private $token;

    protected $uid;

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {

        var_dump(1);
        var_dump($this->UserData->getUserInfo());
        $accessToken = $request->getHeader('access-token');

//        $token =  new \App\Common\Utility\Token($this->redis);
//
//        $token->checkBasicAuth(end($accessToken));
//        var_dump($token->getClientInfo(0));

        $this->token->checkBasicAuth(end($accessToken));

        var_dump($this->token->getClientInfo(0));



//        return response()->raw(Encrypt::encrypt(json_encode($request->getParsedBody() + $request->getQueryParams())))->withoutHeader('Content-Type')->withAddedHeader('Content-Type', 'application/octet-stream');
        // 委托给下一个中间件处理
        $response = $handler->handle($request);

        return $response;
    }
}