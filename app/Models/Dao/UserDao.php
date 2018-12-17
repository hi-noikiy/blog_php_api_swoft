<?php

namespace App\Models\Dao;

use App\Models\Entity\Users;
use Swoft\Bean\Annotation\Bean;

/**
 *
 * @Bean()
 */
class UserDao
{

    /**
     *
     * @access public
     * @param int $user_id
     * @return Users
     *
     */
    public function getUserInfoById(int $user_id)
    {
        return Users::findById($user_id)->getResult();
    }

    public function getInfoByMobile(string $mobile)
    {
        /* @var Users $user */
        return Users::findOne(['mobile' => $mobile])->getResult();
    }

    public function getInfoByMail(string $mail)
    {
        return Users::findOne(['mail' => $mail])->getResult();
    }

    public function getInfoByGithubId(int $github_id)
    {
        return Users::findOne(['github_id' => $github_id])->getResult();
    }

    public function getInfoByUnionId(string $wechat_unionId)
    {
        return Users::findOne(['wechat_unionId' => $wechat_unionId])->getResult();
    }


    public function create(array $data): int
    {
        $user = new Users();
        $user_id = $user->fill($data)->save()->getResult();

        return $user_id;
    }
}
