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
 * 【配置】后台菜单表

 * @Entity()
 * @Table(name="admin_menu")
 * @uses      AdminMenu
 */
class AdminMenu extends Model
{
    /**
     * @var int $id 菜单ID
     * @Id()
     * @Column(name="id", type="integer")
     */
    private $id;

    /**
     * @var int $pid 上级菜单ID
     * @Column(name="pid", type="integer", default=0)
     */
    private $pid;

    /**
     * @var string $title 菜单名称
     * @Column(name="title", type="string", length=32, default="")
     */
    private $title;

    /**
     * @var string $url 链接地址
     * @Column(name="url", type="string", length=127, default="")
     */
    private $url;

    /**
     * @var string $icon 图标
     * @Column(name="icon", type="string", length=64, default="")
     */
    private $icon;

    /**
     * @var int $menuType 菜单类型
     * @Column(name="menu_type", type="tinyint", default=1)
     */
    private $menuType;

    /**
     * @var int $sort 排序（同级有效）
     * @Column(name="sort", type="tinyint", default=0)
     */
    private $sort;

    /**
     * @var int $status 状态
     * @Column(name="status", type="tinyint", default=1)
     */
    private $status;

    /**
     * @var int $ruleId 权限id
     * @Column(name="rule_id", type="integer", default=61)
     */
    private $ruleId;

    /**
     * @var string $class 
     * @Column(name="class", type="string", length=255)
     */
    private $class;

    /**
     * 菜单ID
     * @param int $value
     * @return $this
     */
    public function setId(int $value)
    {
        $this->id = $value;

        return $this;
    }

    /**
     * 上级菜单ID
     * @param int $value
     * @return $this
     */
    public function setPid(int $value): self
    {
        $this->pid = $value;

        return $this;
    }

    /**
     * 菜单名称
     * @param string $value
     * @return $this
     */
    public function setTitle(string $value): self
    {
        $this->title = $value;

        return $this;
    }

    /**
     * 链接地址
     * @param string $value
     * @return $this
     */
    public function setUrl(string $value): self
    {
        $this->url = $value;

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
     * 菜单类型
     * @param int $value
     * @return $this
     */
    public function setMenuType(int $value): self
    {
        $this->menuType = $value;

        return $this;
    }

    /**
     * 排序（同级有效）
     * @param int $value
     * @return $this
     */
    public function setSort(int $value): self
    {
        $this->sort = $value;

        return $this;
    }

    /**
     * 状态
     * @param int $value
     * @return $this
     */
    public function setStatus(int $value): self
    {
        $this->status = $value;

        return $this;
    }

    /**
     * 权限id
     * @param int $value
     * @return $this
     */
    public function setRuleId(int $value): self
    {
        $this->ruleId = $value;

        return $this;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setClass(string $value): self
    {
        $this->class = $value;

        return $this;
    }

    /**
     * 菜单ID
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * 上级菜单ID
     * @return int
     */
    public function getPid()
    {
        return $this->pid;
    }

    /**
     * 菜单名称
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * 链接地址
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
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
     * 菜单类型
     * @return mixed
     */
    public function getMenuType()
    {
        return $this->menuType;
    }

    /**
     * 排序（同级有效）
     * @return int
     */
    public function getSort()
    {
        return $this->sort;
    }

    /**
     * 状态
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * 权限id
     * @return mixed
     */
    public function getRuleId()
    {
        return $this->ruleId;
    }

    /**
     * @return string
     */
    public function getClass()
    {
        return $this->class;
    }

}
