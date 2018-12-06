<?php

namespace App\Models\Dao;

use App\Common\Code\Code;
use App\Exception\ExtendDataException;
use App\Models\Entity\AdminUsers;
use Swoft\Bean\Annotation\Bean;

/**
 *
 * @Bean()
 * @uses      AdminUserDao
 */
class AdminUserDao
{
    public function getUserInfoById(int $user_id)
    {
        /* @var AdminUsers */
        return AdminUsers::findById($user_id, [
            'fields' => ['user_id', 'account', 'avatar']
        ])->getResult();
    }

    public function getUserInfoByAccount(string $account, array $field = [])
    {
        if (!$field) {
            $field = ['user_id', 'password', 'salt', 'avatar', 'account', 'role'];
        }

        $data = AdminUsers::findOne(['account' => $account], ['fields' => $field])->getResult();
        if (!$data) {
            throw new ExtendDataException('该用户不存在', Code::INVALID_PARAMETER);
        }
        return $data;
    }
}