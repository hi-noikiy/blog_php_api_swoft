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
     * @RequestMapping(route="login", method=RequestMethod::POST)
     * @return object
     */
    public function login()
    {
        $this->validate('App\Common\Validate\Dashboard\AuthValidate.login');
        $uid = $this->checkUser(request()->input('account'), request()->input('password'));


        $arr = [
            'access-token'=>JWT::encode([
                'uid'=>$uid,
                'exp'=>time()+60*2
            ],$this->jwt_key)
        ];




        return $this->respondWithArray($arr);
    }

    private function checkUser(string $account, string $password)
    {
        $user = BoUsers::findOne(['is_admin' => 1, 'mobile' => $account], ['fields' => ['user_id', 'password', 'salt']])->getResult();
        if (!$user) {
            throw new Exception('该用户不存在', Code::INVALID_PARAMETER);
        }
        $md5Password = md5(md5($password) . $user->getSalt());
        if ($md5Password == $user->getPassword()) {
            return $user->getUserId();
        } else {
            throw new Exception('用户或密码错误', Code::INVALID_PARAMETER);
        }
    }
}