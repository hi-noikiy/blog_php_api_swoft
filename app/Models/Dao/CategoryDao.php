<?php

namespace App\Models\Dao;


use App\Exception\ValidateException;
use App\Models\Entity\Category;
use Swoft\Bean\Annotation\Bean;

/**
 * @Bean()
 */
class CategoryDao
{

    public function getList($condition = [], $options = [])
    {
        return Category::getPageList($condition, $options);
    }

    public function getInfoById(int $id)
    {
        $data = Category::findById($id)->getResult();
        if (!$data) {
            throw new ValidateException("数据不存在或者已经删除");
        }
        return $data;
    }

    public function create(array $arr)
    {
        $article = new Category();
        $article->fill($arr)->save();
    }

}