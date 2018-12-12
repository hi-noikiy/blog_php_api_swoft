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


    public function create(array $data): Users
    {
        $user = new Users();
        return $user->fill($data)->save()->getResult();
    }
}
