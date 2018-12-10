<?php
/**
 *
 * @author cpj
 * @date 2018/12/6
 */

namespace App\Models\Services;


use App\Models\Dao\TagDao;
use App\Models\Entity\Tags;
use Swoft\Bean\Annotation\Bean;
use Swoft\Bean\Annotation\Inject;

/**
 * @Bean()
 */
class TagService
{
    /**
     *
     * @Inject()
     * @var TagDao
     */
    public $tagDao;

    public function getList()
    {
        return Tags::getPageList();
    }

    public function getInfo(int $id)
    {
        return $this->tagDao->getInfoById($id);
    }

    public function create(array $arr)
    {
        $tags = new Tags();
        $tags->fill($arr)->save();
    }

    public function update(int $id, array $arr)
    {
        $this->tagDao->getInfoById($id)->fill($arr)->update();
    }

    public function delete(int $id)
    {
        $this->tagDao->getInfoById($id)->delete();
    }

}