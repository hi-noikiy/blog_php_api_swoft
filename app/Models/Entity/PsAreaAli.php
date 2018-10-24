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
 * @Table(name="ps_area_ali")
 * @uses      PsAreaAli
 */
class PsAreaAli extends Model
{
    /**
     * @var int $id 
     * @Id()
     * @Column(name="id", type="integer")
     */
    private $id;

    /**
     * @var string $areaCode 地区编码
     * @Column(name="areaCode", type="string", length=64)
     * @Required()
     */
    private $areaCode;

    /**
     * @var string $areaName 地区名称
     * @Column(name="areaName", type="string", length=64)
     * @Required()
     */
    private $areaName;

    /**
     * @var string $areaParentId 父级编码
     * @Column(name="areaParentId", type="string", length=64, default="")
     */
    private $areaParentId;

    /**
     * @var int $areaType 区域类型 1国家2省3市4区5街道
     * @Column(name="areaType", type="tinyint", default=0)
     */
    private $areaType;

    /**
     * @param int $value
     * @return $this
     */
    public function setId(int $value)
    {
        $this->id = $value;

        return $this;
    }

    /**
     * 地区编码
     * @param string $value
     * @return $this
     */
    public function setAreaCode(string $value): self
    {
        $this->areaCode = $value;

        return $this;
    }

    /**
     * 地区名称
     * @param string $value
     * @return $this
     */
    public function setAreaName(string $value): self
    {
        $this->areaName = $value;

        return $this;
    }

    /**
     * 父级编码
     * @param string $value
     * @return $this
     */
    public function setAreaParentId(string $value): self
    {
        $this->areaParentId = $value;

        return $this;
    }

    /**
     * 区域类型 1国家2省3市4区5街道
     * @param int $value
     * @return $this
     */
    public function setAreaType(int $value): self
    {
        $this->areaType = $value;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * 地区编码
     * @return string
     */
    public function getAreaCode()
    {
        return $this->areaCode;
    }

    /**
     * 地区名称
     * @return string
     */
    public function getAreaName()
    {
        return $this->areaName;
    }

    /**
     * 父级编码
     * @return string
     */
    public function getAreaParentId()
    {
        return $this->areaParentId;
    }

    /**
     * 区域类型 1国家2省3市4区5街道
     * @return int
     */
    public function getAreaType()
    {
        return $this->areaType;
    }

}
