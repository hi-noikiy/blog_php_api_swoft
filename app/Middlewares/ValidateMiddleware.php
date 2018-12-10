<?php
/**
 * This file is part of Swoft.
 *
 * @link https://swoft.org
 * @document https://doc.swoft.org
 * @contact group@swoft.org
 * @license https://github.com/swoft-cloud/swoft/blob/master/LICENSE
 */

namespace App\Middlewares;

use App\Common\Validate\BaseValidate;
use Psr\Http\Server\RequestHandlerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Swoft\Bean\Annotation\Bean;
use Swoft\Http\Message\Middleware\MiddlewareInterface;
use Swoft\Http\Server\AttributeEnum;
use think\Validate;

/**
 * @Bean()
 */
class ValidateMiddleware implements MiddlewareInterface
{


    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $httpHandler = $request->getAttribute(AttributeEnum::ROUTER_ATTRIBUTE);
        $info = $httpHandler[2];

        if (isset($info['handler']) && \is_string($info['handler'])) {
            $exploded = explode('@', $info['handler']);
            $className = $exploded[0] ?? '';
            $validatorKey = $exploded[1] ?? '';
            $matches = $info['matches'] ?? [];


            $validateClass = "App\\Common\\Validate\\AuthValidate";
            $param = $matches + \Swoft::param();
            if (class_exists($validateClass)) {
                /* @var BaseValidate $validateClass */
                (new $validateClass)->scene($validatorKey)->check($param);
            }

//            (new BaseValidate())->scene($validatorKey)->check($param);
//            if (isset($collector[$className][$validatorKey]['validator'])) {
//                $validators = $collector[$className][$validatorKey]['validator'];
//                $request = $validator->validate($validators, $request, $matches);
//            }
        }
        $response = $handler->handle($request);

        return $response;
    }
}