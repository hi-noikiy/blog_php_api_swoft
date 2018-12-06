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
 * @Table(name="tags")
 * @uses      Tags
 */
class Tags extends BaseModel
{
    /**
     * @var int $tagId 
     * @Id()
     * @Column(name="tag_id", type="integer")
     */
    private $tagId;

    /**
     * @var string $tagName 标签名字
     * @Column(name="tag_name", type="string", length=20)
     * @Required()
     */
    private $tagName;

    /**
     * @var int $order 排序
     * @Column(name="order", type="integer")
     * @Required()
     */
    private $order;

    /**
     * @param int $value
     * @return $this
     */
    public function setTagId(int $value)
    {
        $this->tagId = $value;

        return $this;
    }

    /**
     * 标签名字
     * @param string $value
     * @return $this
     */
    public function setTagName(string $value): self
    {
        $this->tagName = $value;

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
     * @return mixed
     */
    public function getTagId()
    {
        return $this->tagId;
    }

    /**
     * 标签名字
     * @return string
     */
    public function getTagName()
    {
        return $this->tagName;
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
