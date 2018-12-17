<?php

namespace App\Models\Data;

use App\Common\Code\Code;
use App\Exception\AuthException;
use App\Models\Dao\UserDao;
use Swoft\Bean\Annotation\Bean;
use Swoft\Bean\Annotation\Inject;

/**
 * @Bean()
 */
class UserData
{
    /**
     *
     * @Inject()
     * @var UserDao
     */
    private $UserDao;

    public function getUserInfo(int $user_id)
    {
        $user_info = $this->UserDao->getUserInfoById($user_id);
        if (!$user_info) {
            throw new AuthException(Code::ERROR_NOT_FOUND, '该账号不存在');
        }
        return $user_info;
    }

    public function createUser(array $data)
    {
        return $this->UserDao->createUser($data);
    }
}
