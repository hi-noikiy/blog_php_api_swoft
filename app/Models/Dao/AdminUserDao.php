<?php

namespace App\Models\Dao;

use App\Models\Entity\AdminUsers;
use Swoft\Bean\Annotation\Bean;

/**
 *
 * @Bean()
 * @uses      AdminUserDao
 */
class AdminUserDao
{
    public function getUserInfo(int $user_id)
    {
        /* @var AdminUsers */
        return AdminUsers::findById($user_id,[
            'fields'=>['user_id','account','avatar']
        ])->getResult();
    }
}