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
 * @version   2018年04月29日
 */
class Rooms extends Model
{
    /**
     * @var int $roomId 
     * @Id()
     * @Column(name="room_id", type=Types::INT)
     */
    private $roomId;

    /**
     * @var string $roomName 房间名字
     * @Column(name="room_name", type=Types::STRING, length=255)
     * @Required()
     */
    private $roomName;

    /**
     * @var int $isShow 
     * @Column(name="is_show", type=Types::INT)
     * @Required()
     */
    private $isShow = 1;

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
     * @return mixed
     */
    public function getRoomName()
    {
        return $this->roomName;
    }

    /**
     * @return int
     */
    public function getIsShow(): int
    {
        return $this->isShow;
    }

}
