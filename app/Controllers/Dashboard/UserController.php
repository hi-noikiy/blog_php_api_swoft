<?php

namespace App\Controllers\Dashboard;


use App\Common\Controller\ApiController;
use Swoft\Core\RequestContext;
use Swoft\Http\Message\Server\Request;
use Swoft\Http\Server\Bean\Annotation\Controller;
use Swoft\Http\Server\Bean\Annotation\RequestMapping;
use Swoft\Http\Server\Bean\Annotation\RequestMethod;
use Swoft\Http\Message\Bean\Annotation\Middleware;
use App\Middlewares\JwtMiddleware;
use Swoft\Bean\Annotation\Inject;

/**
 * @Controller(prefix="/dashboard/user")
 *     @Middleware(JwtMiddleware::class)
 */
class UserController extends ApiController
{
    /**
     * @RequestMapping(route="/dashboard/user", method={RequestMethod::GET})
     */
    public function list(Request $request)
    {


        return $request->getAttribute('uid');
        return ['list'];
    }

}