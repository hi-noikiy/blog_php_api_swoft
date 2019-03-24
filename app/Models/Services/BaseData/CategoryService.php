<?php
/**
 * User: cpj
 * Date: 2019/3/22
 */

namespace App\Models\Services\BaseData;

use App\Models\Dao\EcsCategoryDao;
use Swoft\Bean\Annotation\Bean;
use Swoft\Bean\Annotation\Inject;

/**
 * @Bean()
 */
class CategoryService
{

    /**
     *
     * @Inject()
     * @var EcsCategoryDao
     */
    public $ecsCategoryDao;


    public function getCollection(int $parent_id)
    {
        return $this->ecsCategoryDao->getCollectionByParentId($parent_id);
    }
}