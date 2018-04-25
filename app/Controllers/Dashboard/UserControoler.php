<?php

namespace App\Controllers\Dashboard;


use App\Common\Controller\ApiController;
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
class UserControoler extends ApiController
{


    /**
     * 查询列表接口
     * 地址:/user/
     *
     * @RequestMapping(route="/dashboard/user", method={RequestMethod::GET})
     */
    public function list()
    {
        return ['list'];
    }

}