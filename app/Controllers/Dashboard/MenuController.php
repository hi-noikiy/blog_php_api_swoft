<?php


namespace App\Controllers\Dashboard;

use App\Common\Utility\Tree;
use App\Controllers\Psr7Controller;
use App\Models\Entity\AdminMenu;
use App\Models\Entity\SystemLog;
use Swoft\Db\Db;
use Swoft\Db\Query;
use Swoft\Db\Validator\DatetimeValidator;
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
     * @throws
     */
    public function info()
    {
        $menusList = AdminMenu::findAll()->getResult()->toArray();
        $res['menu'] = (new Tree())->list_to_tree($menusList, 'id', 'pid', 'child', 0, true);

        return $this->respondWithArray($res);
    }
}