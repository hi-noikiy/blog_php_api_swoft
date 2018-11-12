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
    public function getUserInfo(int $user_id)
    {
        return Users::findById($user_id)->getResult();
    }
}
