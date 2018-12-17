<?php

namespace App\Models\Dao;


use App\Exception\ValidateException;
use App\Models\Entity\Tags;
use App\Models\Entity\UserWechatMapping;
use Swoft\Bean\Annotation\Bean;

/**
 * @Bean()
 */
class UserWechatMappingDao
{
    public function create(array $data)
    {
        $userWechatMapping = new UserWechatMapping();
        $userWechatMapping->fill($data)->save();
    }

}