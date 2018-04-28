<?php


namespace App\Controllers\Dashboard;

use App\Common\Utility\Tree;
use App\Models\Entity\BoSystemLog;
use Swoft\Http\Server\Bean\Annotation\Controller;
use Swoft\Http\Server\Bean\Annotation\RequestMapping;
use Swoft\Http\Server\Bean\Annotation\RequestMethod;
use Swoft\Http\Message\Bean\Annotation\Middleware;
use App\Common\Controller\ApiController;
use Exception;
use App\Middlewares\JwtMiddleware;

/**
 * @Controller(prefix="/dashboard/menu")
 * @Middleware(JwtMiddleware::class)
 */
class MenuController extends ApiController
{
    /**
     * 返回权限菜单列表
     * @RequestMapping(route="/dashboard/menu", method={RequestMethod::GET})
     */
    public function info(){
//        $arr['menu'] =
        throw new Exception('test');
        return ['list'];
    }
}