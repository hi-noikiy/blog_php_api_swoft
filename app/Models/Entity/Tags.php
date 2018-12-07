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
     * @var int $Id 
     * @Id()
     * @Column(name="id", type="integer")
     */
    private $Id;

    /**
     * @var string $tagName 标签名字
     * @Column(name="tag_name", type="string", length=20)
     * @Required()
     */
    private $tagName;

    /**
     * @var int $sort 排序
     * @Column(name="sort", type="integer")
     *
     */
    private $sort;

    /**
     * @param int $value
     * @return $this
     */
    public function setId(int $value)
    {
        $this->Id = $value;

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
    public function setsort(int $value): self
    {
        $this->sort = $value;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->Id;
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
    public function getsort()
    {
        return $this->sort;
    }

}
