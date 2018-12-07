<?php

namespace App\Models\Logic;

use App\Models\Dao\AdminUserDao;
use App\Models\Entity\AdminUsers;
use App\Models\Entity\Users;
use Swoft\Bean\Annotation\Bean;
use App\Common\Code\Code;
use Exception;
use Swoft\Bean\Annotation\Inject;
use Swoft\Db\Db;
use SwoftTest\Db\Testing\Entity\User;

/**
 * @Bean()
 */
class DashBoardAuthLogic
{

    /**
     *
     * @Inject()
     * @var AdminUserDao
     */
    private $AdminUserDao;

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
        $user = $this->AdminUserDao->getUserInfoByAccount($account);

        if (!password_check($password, $user->getSalt(), $user->getPassword())) {
            throw new Exception('用户或密码错误', Code::INVALID_PARAMETER);
        }
        $this->updateUserInfo($user);
        return [
            'user_id' => $user->getUserId(),
            'account' => $user->getAccount(),
            'avatar' => $user->getAvatar(),
            'role' => $user->getRole()
        ];
    }

    public function updateUserInfo(AdminUsers $user)
    {
        $user->visitCount++;
        $user->setLoginTime(date('Y-m-d H:i:s'));
        $user->setLastIp(ip());
        $user->update();
    }
}