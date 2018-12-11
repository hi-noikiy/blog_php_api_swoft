<?php
/**
 *
 * @author cpj
 * @date 2018/12/6
 */

namespace App\Models\Services;

use App\Models\Dao\ArticleDao;
use App\Models\Entity\Article;
use Swoft\Bean\Annotation\Bean;
use Swoft\Bean\Annotation\Inject;

/**
 * @Bean()
 */
class ArticleService
{
    /**
     *
     * @Inject()
     * @var ArticleDao
     */
    public $articleDao;

    public function getList()
    {
//        $condition['fields'] = '';
        return $this->articleDao->getList();
    }

    public function getInfo(int $id)
    {
        return $this->articleDao->getInfoById($id);
    }

    public function create(array $arr)
    {
        $this->articleDao->create($arr);
    }

    public function update(int $id, array $arr)
    {
        $this->articleDao->getInfoById($id)->fill($arr)->update();
    }

    public function delete(int $id)
    {
        $this->articleDao->getInfoById($id)->delete();
    }

}