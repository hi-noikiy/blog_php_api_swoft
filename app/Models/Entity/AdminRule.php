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
 * @Table(name="admin_rule")
 * @uses      AdminRule
 */
class AdminRule extends Model
{
    /**
     * @var int $ruleId 
     * @Id()
     * @Column(name="rule_id", type="integer")
     */
    private $ruleId;

    /**
     * @var string $title 名称
     * @Column(name="title", type="string", length=100, default="")
     */
    private $title;

    /**
     * @var string $name 定义
     * @Column(name="name", type="char", length=30, default="")
     */
    private $name;

    /**
     * @var int $level 级别。1模块,2控制器,3操作
     * @Column(name="level", type="tinyint")
     * @Required()
     */
    private $level;

    /**
     * @var int $pid 父id，默认0
     * @Column(name="pid", type="integer", default=0)
     */
    private $pid;

    /**
     * @var int $connect 同级编辑
     * @Column(name="connect", type="integer", default=0)
     */
    private $connect;

    /**
     * @var int $status 状态，1启用，0禁用
     * @Column(name="status", type="tinyint", default=1)
     */
    private $status;

    /**
     * @param int $value
     * @return $this
     */
    public function setRuleId(int $value)
    {
        $this->ruleId = $value;

        return $this;
    }

    /**
     * 名称
     * @param string $value
     * @return $this
     */
    public function setTitle(string $value): self
    {
        $this->title = $value;

        return $this;
    }

    /**
     * 定义
     * @param string $value
     * @return $this
     */
    public function setName(string $value): self
    {
        $this->name = $value;

        return $this;
    }

    /**
     * 级别。1模块,2控制器,3操作
     * @param int $value
     * @return $this
     */
    public function setLevel(int $value): self
    {
        $this->level = $value;

        return $this;
    }

    /**
     * 父id，默认0
     * @param int $value
     * @return $this
     */
    public function setPid(int $value): self
    {
        $this->pid = $value;

        return $this;
    }

    /**
     * 同级编辑
     * @param int $value
     * @return $this
     */
    public function setConnect(int $value): self
    {
        $this->connect = $value;

        return $this;
    }

    /**
     * 状态，1启用，0禁用
     * @param int $value
     * @return $this
     */
    public function setStatus(int $value): self
    {
        $this->status = $value;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getRuleId()
    {
        return $this->ruleId;
    }

    /**
     * 名称
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * 定义
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * 级别。1模块,2控制器,3操作
     * @return int
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * 父id，默认0
     * @return int
     */
    public function getPid()
    {
        return $this->pid;
    }

    /**
     * 同级编辑
     * @return int
     */
    public function getConnect()
    {
        return $this->connect;
    }

    /**
     * 状态，1启用，0禁用
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

}
