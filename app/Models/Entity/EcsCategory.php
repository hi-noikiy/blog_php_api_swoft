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
 * @Table(name="ecs_category")
 * @uses      EcsCategory
 */
class EcsCategory extends Model
{
    /**
     * @var int $cat_id 
     * @Id()
     * @Column(name="cat_id", type="smallint")
     */
    private $cat_id;

    /**
     * @var string $cat_name 
     * @Column(name="cat_name", type="string", length=90, default="")
     */
    private $cat_name;

    /**
     * @var string $mobile_icon 
     * @Column(name="mobile_icon", type="string", length=255)
     * @Required()
     */
    private $mobile_icon;

    /**
     * @var int $parent_id 
     * @Column(name="parent_id", type="smallint", default=0)
     */
    private $parent_id;

    /**
     * @var int $sort 
     * @Column(name="sort", type="tinyint", default=50)
     */
    private $sort;

    /**
     * @var int $is_show 
     * @Column(name="is_show", type="tinyint", default=1)
     */
    private $is_show;

    /**
     * @param int $value
     * @return $this
     */
    public function setCatId(int $value)
    {
        $this->cat_id = $value;

        return $this;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setCatName(string $value): self
    {
        $this->cat_name = $value;

        return $this;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setMobileIcon(string $value): self
    {
        $this->mobile_icon = $value;

        return $this;
    }

    /**
     * @param int $value
     * @return $this
     */
    public function setParentId(int $value): self
    {
        $this->parent_id = $value;

        return $this;
    }

    /**
     * @param int $value
     * @return $this
     */
    public function setSort(int $value): self
    {
        $this->sort = $value;

        return $this;
    }

    /**
     * @param int $value
     * @return $this
     */
    public function setIsShow(int $value): self
    {
        $this->is_show = $value;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCatId()
    {
        return $this->cat_id;
    }

    /**
     * @return string
     */
    public function getCatName()
    {
        return $this->cat_name;
    }

    /**
     * @return string
     */
    public function getMobileIcon()
    {
        return $this->mobile_icon;
    }

    /**
     * @return int
     */
    public function getParentId()
    {
        return $this->parent_id;
    }

    /**
     * @return mixed
     */
    public function getSort()
    {
        return $this->sort;
    }

    /**
     * @return mixed
     */
    public function getIsShow()
    {
        return $this->is_show;
    }

}
