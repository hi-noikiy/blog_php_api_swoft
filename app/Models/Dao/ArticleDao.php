<?php

namespace App\Models\Dao;


use App\Exception\ValidateException;
use App\Models\Entity\Article;
use App\Models\Entity\Tags;
use Swoft\Bean\Annotation\Bean;

/**
 * @Bean()
 */
class ArticleDao
{

    public function getList($condition = [], $options = [])
    {
        return Article::getPageList($condition, $options);
    }

    public function getInfoById(int $id)
    {
        $data = Article::findById($id)->getResult();
        if (!$data) {
            throw new ValidateException("数据不存在或者已经删除");
        }
        return $data;
    }

    public function create(array $arr)
    {
        $article = new Article();
        $article->fill($arr)->save();
    }

}