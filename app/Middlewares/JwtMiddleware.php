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
            throw new Exception('请登录', Code::UNLOGIN);
        }
        $route = explode('/',$request->getUri()->getPath());

        try {
            $decode = JWT::decode(end($accessToken), $this->jwt_key, ['HS256']);
        } catch (ExpiredException $e) {
            throw new ExpiredException('请重新登录', Code::INVALID_TOKEN);
        } catch (UnexpectedValueException $e){
            throw new ExpiredException('请重新登录', Code::INVALID_TOKEN);
        }catch (Exception $exception){
            throw new ExpiredException('请重新登录', Code::INVALID_TOKEN);
        }

        if(current($decode->role) != '-1'){
            throw new ExpiredException('该用户无权限', Code::ACCOUNT_BAD);
        }
            //权限管理代码 restful风格根据 method区分一个模块的验证
        $request = $request->withAttribute('user_id',$decode->user_id);
//        return response()->raw(Encrypt::encrypt(json_encode($request->getParsedBody() + $request->getQueryParams())))->withoutHeader('Content-Type')->withAddedHeader('Content-Type', 'application/octet-stream');
        // 委托给下一个中间件处理
        $response = $handler->handle($request);

        return $response;
    }
}