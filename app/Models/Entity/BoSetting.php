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
 * app配置表
 *
 * @Entity()
 * @Table(name="bo_setting")
 * @uses      BoSetting
 * @version   2018年04月25日
 */
class BoSetting extends Model
{
    /**
     * @var int $setting_id 
     * @Id()
     * @Column(name="setting_id", type=Types::INT)
     */
    private $setting_id = '';

    /**
     * @var string $setting_key 
     * @Column(name="setting_key", type=Types::STRING, length=255)
     * @Required()
     */
    private $setting_key = '';

    /**
     * @var string $setting_value 
     * @Column(name="setting_value", type=Types::STRING, length=255)
     * @Required()
     */
    private $setting_value = '';

 
    /**
     * 
     * @param int $value
     * @return $this
     */
    public function setSettingId(int $value)
    {
        $this->setting_id = $value;

        return $this;
    }

    /**
     * 
     * @param string $value
     * @return $this
     */
    public function setSettingKey(string $value): self
    {
        $this->setting_key = $value;

        return $this;
    }

    /**
     * 
     * @param string $value
     * @return $this
     */
    public function setSettingValue(string $value): self
    {
        $this->setting_value = $value;

        return $this;
    }

 
    /**
     * 
     * @return int
     */
    public function getSettingId()
    {
        return $this->setting_id;
    }

    /**
     * 
     * @return string
     */
    public function getSettingKey()
    {
        return $this->setting_key;
    }

    /**
     * 
     * @return string
     */
    public function getSettingValue()
    {
        return $this->setting_value;
    }

}
