<?php

namespace App\Models\Logic;

use App\Models\Entity\AdminUsers;
use App\Models\Entity\Users;
use Swoft\Bean\Annotation\Bean;
use App\Common\Code\Code;
use Exception;
use Swoft\Db\Db;

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
        $user = Users::findOne(['mobile' => $account], ['fields' => ['user_id', 'password', 'salt']])->getResult();
        if (!$user) {
            throw new Exception('该用户不存在', Code::INVALID_PARAMETER);
        }

        $md5Password = md5(md5($password) . $user->getSalt());
        if ($md5Password == $user->getPassword()) {
            return [
                'uid' => $user->getUserId()
            ];
        } else {
            throw new Exception('用户或密码错误', Code::INVALID_PARAMETER);
        }
    }

    public function checkManager(string $account, string $password)
    {
        /* @var AdminUsers $user */
        $user = AdminUsers::findOne(['account' => $account], ['fields' => ['user_id', 'password', 'salt', 'avatar', 'account', 'role']])->getResult();
        if (!$user) {
            throw new Exception('该用户不存在', Code::INVALID_PARAMETER);
        }

        $md5Password = md5(md5($password) . $user->getSalt());
        if ($md5Password == $user->getPassword()) {
            return [
                'user_id' => $user->getUserId(),
                'account' => $user->getAccount(),
                'avatar' => $user->getAvatar(),
                'role' => $user->getRole()
            ];
        } else {
            throw new Exception('用户或密码错误', Code::INVALID_PARAMETER);
        }
    }

    public function updateUserInfo(int $user_id)
    {

        Db::query("update admin_users set last_ip = '" . ip() . "',login_time = '" . date('Y-m-d H:i:s') . "',visit_count = visit_count+1 where user_id = " . $user_id . " limit 1");
//        Db::query('update admin_users set last_ip = :last_ip,login_time = :login_time,visit_count = :visit_count where user_id = :user_id',[
//            'last_ip' => ip(),
//            'login_time'=>date('Y-m-d H:i:s'),
//            'visit_count' => 'visit_count+1',
//            'user_id'=>$user_id
//        ])->getResult();
//        $res = AdminUsers::updateOne([
//            'last_ip' => ip(),
//            'login_time' => date('Y-m-d H:i:s'),
//            'visit_count' => 'visit_count+1'
//        ], ['user_id' => $user_id])->getResult();
//        var_dump($res);
    }
}