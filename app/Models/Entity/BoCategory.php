<?php

namespace App\Models\Entity;

use Swoft\Db\Model;
use Swoft\Db\Bean\Annotation\Column;
use Swoft\Db\Bean\Annotation\Entity;
use Swoft\Db\Bean\Annotation\Id;
use Swoft\Db\Bean\Annotation\Required;
use Swoft\Db\Bean\Annotation\Table;
use Swoft\Db\Types;

/**
 * 
 *
 * @Entity()
 * @Table(name="bo_category")
 * @uses      BoCategory
 * @version   2018年04月25日
 */
class BoCategory extends Model
{
    /**
     * @var int $cat_id 
     * @Id()
     * @Column(name="cat_id", type=Types::INT)
     */
    private $cat_id = '';

    /**
     * @var string $cat_name 分类名字
     * @Column(name="cat_name", type=Types::STRING, length=20)
     * @Required()
     */
    private $cat_name = '';

    /**
     * @var string $icon 图标
     * @Column(name="icon", type=Types::STRING, length=20)
     * @Required()
     */
    private $icon = '';

    /**
     * @var string $router 路由
     * @Column(name="router", type=Types::STRING, length=20)
     * @Required()
     */
    private $router = '';

    /**
     * @var int $sort 降序
     * @Column(name="sort", type=Types::INT)
     * @Required()
     */
    private $sort = '0';

    /**
     * @var int $able 0禁用|1启动
     * @Column(name="able", type=Types::INT)
     * @Required()
     */
    private $able = '1';

 
    /**
     * 
     * @param int $value
     * @return $this
     */
    public function setCatId(int $value)
    {
        $this->cat_id = $value;

        return $this;
    }

    /**
     * 分类名字
     * @param string $value
     * @return $this
     */
    public function setCatName(string $value): self
    {
        $this->cat_name = $value;

        return $this;
    }

    /**
     * 图标
     * @param string $value
     * @return $this
     */
    public function setIcon(string $value): self
    {
        $this->icon = $value;

        return $this;
    }

    /**
     * 路由
     * @param string $value
     * @return $this
     */
    public function setRouter(string $value): self
    {
        $this->router = $value;

        return $this;
    }

    /**
     * 降序
     * @param int $value
     * @return $this
     */
    public function setSort(int $value): self
    {
        $this->sort = $value;

        return $this;
    }

    /**
     * 0禁用|1启动
     * @param int $value
     * @return $this
     */
    public function setAble(int $value): self
    {
        $this->able = $value;

        return $this;
    }

 
    /**
     * 
     * @return int
     */
    public function getCatId()
    {
        return $this->cat_id;
    }

    /**
     * 分类名字
     * @return string
     */
    public function getCatName()
    {
        return $this->cat_name;
    }

    /**
     * 图标
     * @return string
     */
    public function getIcon()
    {
        return $this->icon;
    }

    /**
     * 路由
     * @return string
     */
    public function getRouter()
    {
        return $this->router;
    }

    /**
     * 降序
     * @return int
     */
    public function getSort()
    {
        return $this->sort;
    }

    /**
     * 0禁用|1启动
     * @return int
     */
    public function getAble(): int
    {
        return $this->able;
    }

}
