<?php

namespace App\Models\Logic;

use Swoft\Bean\Annotation\Bean;
use App\Common\Code\Code;
use App\Models\Entity\BoUsers;
use Exception;

/**
 * @Bean()
 */
class AuthLogic
{

    public function checkUser(string $account, string $password)
    {
        $user = BoUsers::findOne(['mobile' => $account], ['fields' => ['user_id', 'password', 'salt', 'is_admin']])->getResult();
        if (!$user) {
            throw new Exception('该用户不存在', Code::INVALID_PARAMETER);
        }

        $md5Password = md5(md5($password) . $user->getSalt());
        if ($md5Password == $user->getPassword()) {
            return [
                'uid'=>$user->getUserId(),
                'is_admin'=>$user->getIsAdmin()
            ];
        } else {
            throw new Exception('用户或密码错误', Code::INVALID_PARAMETER);
        }
    }

    public function menu(int $uid){

    }
}