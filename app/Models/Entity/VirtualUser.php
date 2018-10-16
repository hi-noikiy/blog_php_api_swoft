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
 * @Table(name="virtual_user")
 * @uses      VirtualUser
 */
class VirtualUser extends Model
{
    /**
     * @var int $virtualUserId 
     * @Id()
     * @Column(name="virtual_user_id", type="integer")
     */
    private $virtualUserId;

    /**
     * @var string $virtualNick 
     * @Column(name="virtual_nick", type="string", length=255, default="")
     */
    private $virtualNick;

    /**
     * @var string $virtualAvatar 
     * @Column(name="virtual_avatar", type="string", length=255)
     */
    private $virtualAvatar;

    /**
     * @param int $value
     * @return $this
     */
    public function setVirtualUserId(int $value)
    {
        $this->virtualUserId = $value;

        return $this;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setVirtualNick(string $value): self
    {
        $this->virtualNick = $value;

        return $this;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setVirtualAvatar(string $value): self
    {
        $this->virtualAvatar = $value;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getVirtualUserId()
    {
        return $this->virtualUserId;
    }

    /**
     * @return string
     */
    public function getVirtualNick()
    {
        return $this->virtualNick;
    }

    /**
     * @return string
     */
    public function getVirtualAvatar()
    {
        return $this->virtualAvatar;
    }

}
