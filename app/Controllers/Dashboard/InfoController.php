<?php

namespace App\Controllers\Dashboard;

use App\Common\Controller\ApiController;
use App\Models\Dao\AdminUserDao;
use App\Models\Data\AdminUserData;
use Swoft\Http\Message\Server\Request;
use Swoft\Http\Server\Bean\Annotation\Controller;
use Swoft\Http\Server\Bean\Annotation\RequestMapping;
use Swoft\Http\Server\Bean\Annotation\RequestMethod;
use Swoft\Http\Message\Bean\Annotation\Middleware;
use App\Middlewares\JwtMiddleware;
use Swoft\Bean\Annotation\Inject;

/**
 * @Controller(prefix="/dashboard/info")
 * @Middleware(JwtMiddleware::class)
 */
class InfoController extends ApiController
{
    /**
     *
     * @Inject()
     * @var AdminUserData
     */
    private $adminUserData;

    /**
     *
     * @RequestMapping(route="/dashboard/info", method={RequestMethod::GET})
     * @param Request $request
     * @return string
     */
    public function info(Request $request)
    {
        $user_id = $request->getAttribute('user_id');

        $data = $this->adminUserData->getUserBaseInfo($user_id);
        return $this->respondWithArray($data);
    }
}