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
 * @Table(name="rooms")
 * @uses      Rooms
 */
class Rooms extends Model
{
    /**
     * @var int $roomId 
     * @Id()
     * @Column(name="room_id", type="integer")
     */
    private $roomId;

    /**
     * @var string $roomName 房间名字
     * @Column(name="room_name", type="string", length=255)
     * @Required()
     */
    private $roomName;

    /**
     * @var int $isShow 
     * @Column(name="is_show", type="tinyint", default=1)
     */
    private $isShow;

    /**
     * @param int $value
     * @return $this
     */
    public function setRoomId(int $value)
    {
        $this->roomId = $value;

        return $this;
    }

    /**
     * 房间名字
     * @param string $value
     * @return $this
     */
    public function setRoomName(string $value): self
    {
        $this->roomName = $value;

        return $this;
    }

    /**
     * @param int $value
     * @return $this
     */
    public function setIsShow(int $value): self
    {
        $this->isShow = $value;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getRoomId()
    {
        return $this->roomId;
    }

    /**
     * 房间名字
     * @return string
     */
    public function getRoomName()
    {
        return $this->roomName;
    }

    /**
     * @return mixed
     */
    public function getIsShow()
    {
        return $this->isShow;
    }

}
