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


    public function createUser(array $data): Users
    {
        $user = new Users();
        return $user->fill($data)->save()->getResult();
    }
}
