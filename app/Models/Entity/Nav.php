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
 * @Table(name="nav")
 * @uses      Nav
 */
class Nav extends Model
{
    /**
     * @var int $navId 
     * @Id()
     * @Column(name="nav_id", type="integer")
     */
    private $navId;

    /**
     * @var string $navName 导航栏名称
     * @Column(name="nav_name", type="string", length=20)
     * @Required()
     */
    private $navName;

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
     * @var int $sort 排序
     * @Column(name="sort", type="integer", default=0)
     */
    private $sort;

    /**
     * @param int $value
     * @return $this
     */
    public function setNavId(int $value)
    {
        $this->navId = $value;

        return $this;
    }

    /**
     * 导航栏名称
     * @param string $value
     * @return $this
     */
    public function setNavName(string $value): self
    {
        $this->navName = $value;

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
     * 排序
     * @param int $value
     * @return $this
     */
    public function setSort(int $value): self
    {
        $this->sort = $value;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getNavId()
    {
        return $this->navId;
    }

    /**
     * 导航栏名称
     * @return string
     */
    public function getNavName()
    {
        return $this->navName;
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
     * 排序
     * @return int
     */
    public function getSort()
    {
        return $this->sort;
    }

}
