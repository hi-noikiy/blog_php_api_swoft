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
 * @Table(name="bo_tags")
 * @uses      BoTags
 * @version   2018年04月25日
 */
class BoTags extends Model
{
    /**
     * @var int $tag_id 
     * @Id()
     * @Column(name="tag_id", type=Types::INT)
     */
    private $tag_id = '';

    /**
     * @var string $tag_name 标签名字
     * @Column(name="tag_name", type=Types::STRING, length=20)
     * @Required()
     */
    private $tag_name = '';

    /**
     * @var int $order 排序
     * @Column(name="order", type=Types::INT)
     * @Required()
     */
    private $order = '';

 
    /**
     * 
     * @param int $value
     * @return $this
     */
    public function setTagId(int $value)
    {
        $this->tag_id = $value;

        return $this;
    }

    /**
     * 标签名字
     * @param string $value
     * @return $this
     */
    public function setTagName(string $value): self
    {
        $this->tag_name = $value;

        return $this;
    }

    /**
     * 排序
     * @param int $value
     * @return $this
     */
    public function setOrder(int $value): self
    {
        $this->order = $value;

        return $this;
    }

 
    /**
     * 
     * @return int
     */
    public function getTagId()
    {
        return $this->tag_id;
    }

    /**
     * 标签名字
     * @return string
     */
    public function getTagName()
    {
        return $this->tag_name;
    }

    /**
     * 排序
     * @return int
     */
    public function getOrder()
    {
        return $this->order;
    }

}
