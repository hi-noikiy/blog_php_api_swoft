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
 * @Table(name="bo_admin_rule")
 * @uses      BoAdminRule
 * @version   2018年04月28日
 */
class BoAdminRule extends Model
{
    /**
     * @var int $ruleId 
     * @Id()
     * @Column(name="rule_id", type=Types::INT)
     */
    private $ruleId;

    /**
     * @var string $title 名称
     * @Column(name="title", type=Types::STRING, length=100)
     * @Required()
     */
    private $title;

    /**
     * @var string $name 定义
     * @Column(name="name", type=Types::STRING, length=30)
     * @Required()
     */
    private $name;

    /**
     * @var int $level 级别。1模块,2控制器,3操作
     * @Column(name="level", type=Types::INT)
     * @Required()
     */
    private $level = 0;

    /**
     * @var int $pid 父id，默认0
     * @Column(name="pid", type=Types::INT)
     * @Required()
     */
    private $pid = 0;

    /**
     * @var int $connect 同级编辑
     * @Column(name="connect", type=Types::INT)
     * @Required()
     */
    private $connect = 0;

    /**
     * @var int $status 状态，1启用，0禁用
     * @Column(name="status", type=Types::INT)
     * @Required()
     */
    private $status = 1;

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
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * 定义
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * 级别。1模块,2控制器,3操作
     * @return mixed
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * 父id，默认0
     * @return mixed
     */
    public function getPid()
    {
        return $this->pid;
    }

    /**
     * 同级编辑
     * @return mixed
     */
    public function getConnect()
    {
        return $this->connect;
    }

    /**
     * 状态，1启用，0禁用
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

}
