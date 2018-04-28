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
 * @Table(name="bo_admin_menu")
 * @uses      BoAdminMenu
 * @version   2018年04月28日
 */
class BoAdminMenu extends Model
{
    /**
     * @var int $id 菜单ID
     * @Id()
     * @Column(name="id", type=Types::INT)
     */
    private $id;

    /**
     * @var int $pid 上级菜单ID
     * @Column(name="pid", type=Types::INT)
     */
    private $pid = 0;

    /**
     * @var string $title 菜单名称
     * @Column(name="title", type=Types::STRING, length=32)
     */
    private $title;

    /**
     * @var string $url 链接地址
     * @Column(name="url", type=Types::STRING, length=127)
     */
    private $url;

    /**
     * @var string $icon 图标
     * @Column(name="icon", type=Types::STRING, length=64)
     */
    private $icon;

    /**
     * @var int $menuType 菜单类型
     * @Column(name="menu_type", type=Types::INT)
     */
    private $menuType = 1;

    /**
     * @var int $sort 排序（同级有效）
     * @Column(name="sort", type=Types::INT)
     */
    private $sort = 0;

    /**
     * @var int $status 状态
     * @Column(name="status", type=Types::INT)
     */
    private $status = 1;

    /**
     * @var int $ruleId 权限id
     * @Column(name="rule_id", type=Types::INT)
     */
    private $ruleId = 61;

    /**
     * @var string $class 
     * @Column(name="class", type=Types::STRING, length=255)
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
     * @return mixed
     */
    public function getPid()
    {
        return $this->pid;
    }

    /**
     * 菜单名称
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * 链接地址
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
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
     * 菜单类型
     * @return int
     */
    public function getMenuType(): int
    {
        return $this->menuType;
    }

    /**
     * 排序（同级有效）
     * @return mixed
     */
    public function getSort()
    {
        return $this->sort;
    }

    /**
     * 状态
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * 权限id
     * @return int
     */
    public function getRuleId(): int
    {
        return $this->ruleId;
    }

    /**
     * @return mixed
     */
    public function getClass()
    {
        return $this->class;
    }

}
