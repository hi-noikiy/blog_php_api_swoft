<?php

namespace App\Controllers\Dashboard;

use App\Common\Utility\Tree;
use App\Common\Validate\AuthValidate;
use App\Models\Entity\AdminMenu;
use Firebase\JWT\JWT;
use Swoft\Http\Server\Bean\Annotation\Controller;
use Swoft\Http\Server\Bean\Annotation\RequestMapping;
use Swoft\Http\Server\Bean\Annotation\RequestMethod;
use Swoft\Http\Message\Bean\Annotation\Middleware;
use App\Middlewares\JwtMiddleware;
use App\Common\Controller\ApiController;
use Swoft\Http\Message\Server\Request;
use Swoft\Bean\Annotation\Value;
use Swoft\Bean\Annotation\Inject;

/**
 * @Controller(prefix="/dashboard/auth")
 *
 */
class AuthController extends ApiController
{
    /**
     * @Value(env="${JWT_KEY}")
     */
    private $jwt_key;

    /**
     * @Inject()
     * @var \App\Models\Logic\DashBoardAuthLogic
     */
    private $AuthLogic;

    /**
     * @RequestMapping(route="login", method=RequestMethod::POST)
     * @return object
     * @throws
     */
    public function login()
    {
        /* @var AuthValidate */
        $info = $this->AuthLogic->checkManager(\Swoft::param('account'), \Swoft::param('password'));

        $arr = [
            'access-token' => JWT::encode([
                'user_id' => $info['user_id'],
                'exp' => time() + 3600 * 2,
                'role' => explode(',', $info['role'])
            ], $this->jwt_key),
            'info' => [
                'avatar' => $info['avatar'],
                'account' => $info['account']
            ],
            'menu' => (new Tree())->list_to_tree(AdminMenu::findAll()->getResult()->toArray(), 'id', 'pid', 'child', 0, true)
        ];

        return $this->respondWithArray($arr);
    }

}