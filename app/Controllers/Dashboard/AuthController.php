<?php

namespace App\Controllers\Dashboard;

use App\Common\Code\Code;
use App\Models\Entity\BoUsers;
use Swoft\Http\Server\Bean\Annotation\Controller;
use Swoft\Http\Server\Bean\Annotation\RequestMapping;
use Swoft\Http\Server\Bean\Annotation\RequestMethod;
use Swoft\Http\Message\Bean\Annotation\Middleware;
use App\Common\Controller\ApiController;
use Swoft\Http\Message\Server\Request;
use Exception;
use Swoft\Bean\Annotation\Value;

/**
 * @Controller(prefix="/dashboard/auth")
 */
class AuthController extends ApiController
{
    /**
     * @Value(name="${config.db}")
     */
    private $config;

    /**
     * @RequestMapping(route="login", method=RequestMethod::POST)
     * @return object
     */
    public function login()
    {
        return $this->config;
        return $this->respondWithArray($this->config);
        $this->validate('App\Common\Validate\Dashboard\AuthValidate.login');
        $user = $this->checkUser(request()->input('account'), request()->input('password'));



        return $this->respondWithArray($user);
    }

    private function checkUser(string $account, string $password)
    {
        $user = BoUsers::findOne(['is_admin' => 1, 'mobile' => $account], ['fields' => ['user_id', 'password', 'salt']])->getResult();
        if (!$user) {
            throw new Exception('该用户不存在', Code::INVALID_PARAMETER);
        }
        $md5Password = md5(md5($password) . $user->getSalt());
        if ($md5Password == $user->getPassword()) {
            return ['info' => $user->toArray()];
        } else {
            throw new Exception('用户或密码错误', Code::INVALID_PARAMETER);
        }
    }
}