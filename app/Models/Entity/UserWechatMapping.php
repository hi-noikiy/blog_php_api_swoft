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
 * @Table(name="user_wechat_mapping")
 * @uses      UserWechatMapping
 */
class UserWechatMapping extends Model
{
    /**
     * @var int $id 
     * @Id()
     * @Column(name="id", type="integer")
     */
    private $id;

    /**
     * @var string $userId 
     * @Column(name="user_id", type="string", length=255)
     * @Required()
     */
    private $userId;

    /**
     * @var string $wechatOpenId 
     * @Column(name="wechat_openId", type="string", length=255)
     * @Required()
     */
    private $wechatOpenId;

    /**
     * @var string $scene 
     * @Column(name="scene", type="string", length=11)
     * @Required()
     */
    private $scene;

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
     * @param string $value
     * @return $this
     */
    public function setUserId(string $value): self
    {
        $this->userId = $value;

        return $this;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setWechatOpenId(string $value): self
    {
        $this->wechatOpenId = $value;

        return $this;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setScene(string $value): self
    {
        $this->scene = $value;

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
     * @return string
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @return string
     */
    public function getWechatOpenId()
    {
        return $this->wechatOpenId;
    }

    /**
     * @return string
     */
    public function getScene()
    {
        return $this->scene;
    }

}
