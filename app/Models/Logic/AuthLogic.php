<?php

namespace App\Models\Logic;

use App\Models\Entity\Users;
use Swoft\Bean\Annotation\Bean;
use App\Common\Code\Code;
use Exception;

/**
 * @Bean()
 */
class AuthLogic
{

    /**
     * @param $account string 用户名
     * @param $password string 密码
     * @return array
     * @throws
     */
    public function checkUser(string $account, string $password)
    {
        $user = Users::findOne(['mobile' => $account], ['fields' => ['user_id', 'password', 'salt', 'is_admin']])->getResult();
        if (!$user) {
            throw new Exception('该用户不存在', Code::INVALID_PARAMETER);
        }

        $md5Password = md5(md5($password) . $user->getSalt());
        if ($md5Password == $user->getPassword()) {
            return [
                'uid' => $user->getUserId(),
                'is_admin' => $user->getIsAdmin()
            ];
        } else {
            throw new Exception('用户或密码错误', Code::INVALID_PARAMETER);
        }
    }

}