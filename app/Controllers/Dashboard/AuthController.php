<?php

namespace App\Controllers\Dashboard;

use App\Common\Code\Code;
use App\Models\Entity\BoUsers;
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
     */
    public function login()
    {
        $this->validate('App\Common\Validate\Dashboard\AuthValidate.login');
        $info = $this->AuthLogic->checkUser(request()->post('account'), request()->post('password'));
        var_dump($info);

        $arr = [
            'access-token' => JWT::encode(
                array_merge($info, ['exp' => time() + 600 * 2])
                , $this->jwt_key)
        ];


        return $this->respondWithArray($arr);
    }

}