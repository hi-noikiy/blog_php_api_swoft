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
use App\Exception\SystemException;
use Psr\Http\Server\RequestHandlerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Swoft\Bean\Annotation\Bean;
use Swoft\Core\RequestContext;
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

            $validateClassName = sprintf("App\\Common\\Validate%sValidate", str_replace('/', '//', substr(strstr($className, "Controllers"), 11, -10)));

            if (class_exists($validateClassName)) {

                /* @var BaseValidate $validateClass */
                $validateClass = new $validateClassName;

                if (!$validateClass instanceof BaseValidate) {
                    throw new SystemException("$validateClass not extend BaseValidate");
                }

                if ($validateClass->hasScene($validatorKey)) {
                    $param = $matches + \Swoft::param();
                    $validateClass->scene($validatorKey)->check($param);
                }
            }
        }
        $response = $handler->handle($request);

        return $response;
    }
}