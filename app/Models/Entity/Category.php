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
 * @Entity()
 * @Table(name="category")
 * @uses      Category
 * @version   2018年04月29日
 */
class Category extends Model
{
    /**
     * @var int $catId 
     * @Id()
     * @Column(name="cat_id", type=Types::INT)
     */
    private $catId;

    /**
     * @var string $catName 分类名字
     * @Column(name="cat_name", type=Types::STRING, length=20)
     * @Required()
     */
    private $catName;

    /**
     * @var string $icon 图标
     * @Column(name="icon", type=Types::STRING, length=20)
     * @Required()
     */
    private $icon;

    /**
     * @var string $router 路由
     * @Column(name="router", type=Types::STRING, length=20)
     * @Required()
     */
    private $router;

    /**
     * @var int $sort 降序
     * @Column(name="sort", type=Types::INT)
     * @Required()
     */
    private $sort = 0;

    /**
     * @var int $able 0禁用|1启动
     * @Column(name="able", type=Types::INT)
     * @Required()
     */
    private $able = 1;

    /**
     * @param int $value
     * @return $this
     */
    public function setCatId(int $value)
    {
        $this->catId = $value;

        return $this;
    }

    /**
     * 分类名字
     * @param string $value
     * @return $this
     */
    public function setCatName(string $value): self
    {
        $this->catName = $value;

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
     * @return mixed
     */
    public function getCatId()
    {
        return $this->catId;
    }

    /**
     * 分类名字
     * @return mixed
     */
    public function getCatName()
    {
        return $this->catName;
    }

    /**
     * 图标
     * @return mixed
     */
    public function getIcon()
    {
        return $this->icon;
    }

    /**
     * 路由
     * @return mixed
     */
    public function getRouter()
    {
        return $this->router;
    }

    /**
     * 降序
     * @return mixed
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
