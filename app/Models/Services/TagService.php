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
    public $TagDao;

    public function getList()
    {
        return Tags::getPageList();
    }

    public function getInfo(int $id)
    {
        return $this->TagDao->getInfoById($id);
    }

    public function create(array $arr)
    {

        $tags = new Tags();

        $tags->setTagName($arr['tag_name']);
        $tags->save();
    }

    public function delete(int $id)
    {
        $this->TagDao->getInfoById($id)->delete();
    }

}