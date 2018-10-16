<?php
namespace App\Models\Dao;

use Swoft\Bean\Annotation\Bean;

/**
 *
 * @Bean()
 * @uses      UserDao
 */
class UserDao
{
    public function getUserInfo()
    {
        return [
            'uid' => 666,
            'name' => 'stelin'
        ];
    }
}
