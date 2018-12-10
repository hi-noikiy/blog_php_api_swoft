<?php

namespace App\Models\Dao;


use App\Exception\ValidateException;
use App\Models\Entity\Tags;
use Swoft\Bean\Annotation\Bean;

/**
 * @Bean()
 */
class TagDao
{

    public function getInfoById(int $id): Tags
    {
        $data = Tags::findById($id)->getResult();
        if (!$data) {
            throw new ValidateException("数据不存在或者已经删除");
        }
        return $data;
    }

}