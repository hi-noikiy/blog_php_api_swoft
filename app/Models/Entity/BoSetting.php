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

 * @Entity()
 * @Table(name="bo_setting")
 * @uses      BoSetting
 * @version   2018年04月28日
 */
class BoSetting extends Model
{
    /**
     * @var int $settingId 
     * @Id()
     * @Column(name="setting_id", type=Types::INT)
     */
    private $settingId;

    /**
     * @var string $settingKey 
     * @Column(name="setting_key", type=Types::STRING, length=255)
     * @Required()
     */
    private $settingKey;

    /**
     * @var string $settingValue 
     * @Column(name="setting_value", type=Types::STRING, length=255)
     * @Required()
     */
    private $settingValue;

    /**
     * @param int $value
     * @return $this
     */
    public function setSettingId(int $value)
    {
        $this->settingId = $value;

        return $this;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setSettingKey(string $value): self
    {
        $this->settingKey = $value;

        return $this;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setSettingValue(string $value): self
    {
        $this->settingValue = $value;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSettingId()
    {
        return $this->settingId;
    }

    /**
     * @return mixed
     */
    public function getSettingKey()
    {
        return $this->settingKey;
    }

    /**
     * @return mixed
     */
    public function getSettingValue()
    {
        return $this->settingValue;
    }

}
