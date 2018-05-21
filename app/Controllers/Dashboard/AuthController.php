<?php

namespace App\Controllers\Dashboard;

use App\Common\Code\Code;
use App\Common\Utility\Tree;
use App\Models\Entity\AdminMenu;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\JWT;
use Swoft\Http\Server\Bean\Annotation\Controller;
use Swoft\Http\Server\Bean\Annotation\RequestMapping;
use Swoft\Http\Server\Bean\Annotation\RequestMethod;
use Swoft\Http\Message\Bean\Annotation\Middleware;
use App\Common\Controller\ApiController;
use Swoft\Http\Message\Server\Request;
use Exception;
use Swoft\Bean\Annotation\Value;
use Swoft\Bean\Annotation\Inject;

/**
 * @Controller(prefix="/dashboard/auth")
 */
class AuthController extends ApiController
{
    /**
     * @Value(env="${JWT_KEY}")
     */
    private $jwt_key;

    /**
     * @Inject()
     * @var \App\Models\Logic\AuthLogic
     */
    private $AuthLogic;

    /**
     * @RequestMapping(route="login", method=RequestMethod::POST)
     * @return object
     * @throws
     */
    public function login()
    {
        $this->validate('App\Common\Validate\Dashboard\AuthValidate.login');
        $info = $this->AuthLogic->checkManager(request()->post('account'), request()->post('password'));

        $this->AuthLogic->updateUserInfo($info['user_id']);
        $arr = [
            'access-token' => JWT::encode(
                array_merge(['user_id' => $info['user_id']], ['exp' => time() + 3600 * 2])
                , $this->jwt_key),
            'info' => [
                'avatar' => $info['avatar'],
                'account' => $info['account']
            ],
            'menu' => (new Tree())->list_to_tree(AdminMenu::findAll()->getResult()->toArray(), 'id', 'pid', 'child', 0, true)
        ];

        return $this->respondWithArray($arr);
    }

}