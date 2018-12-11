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
 */
class Category extends BaseModel
{
    /**
     * @var int $catId 
     * @Id()
     * @Column(name="cat_id", type="integer")
     */
    private $catId;

    /**
     * @var string $catName 分类名字
     * @Column(name="cat_name", type="string", length=20)
     * @Required()
     */
    private $catName;

    /**
     * @var string $icon 图标
     * @Column(name="icon", type="string", length=20)
     * @Required()
     */
    private $icon;

    /**
     * @var string $router 路由
     * @Column(name="router", type="string", length=20)
     * @Required()
     */
    private $router;

    /**
     * @var int $sort 降序
     * @Column(name="sort", type="integer", default=0)
     */
    private $sort;

    /**
     * @var int $able 0禁用|1启动
     * @Column(name="able", type="tinyint", default=1)
     */
    private $able;

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
     * @return string
     */
    public function getCatName()
    {
        return $this->catName;
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
     * @return mixed
     */
    public function getAble()
    {
        return $this->able;
    }

}
