<?php
/**
 * User: cpj
 * Date: 2019/3/22
 */

namespace App\Models\Dao;

use App\Exception\ValidateException;
use App\Models\Entity\Article;
use App\Models\Entity\EcsCategory;
use Swoft\Bean\Annotation\Bean;

/**
 * @Bean()
 */
class EcsCategoryDao
{
    public function getInfoById(int $id)
    {

    }

    public function getCollectionByParentId(int $parent_id)
    {
        return EcsCategory::findAll(['parent_id' => $parent_id, 'is_show' => 1])->getResult();
    }
}