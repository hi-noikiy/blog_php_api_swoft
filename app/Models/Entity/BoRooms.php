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
 * 
 *
 * @Entity()
 * @Table(name="bo_rooms")
 * @uses      BoRooms
 * @version   2018年04月25日
 */
class BoRooms extends Model
{
    /**
     * @var int $room_id 
     * @Id()
     * @Column(name="room_id", type=Types::INT)
     */
    private $room_id = '';

    /**
     * @var string $room_name 房间名字
     * @Column(name="room_name", type=Types::STRING, length=255)
     * @Required()
     */
    private $room_name = '';

    /**
     * @var int $is_show 
     * @Column(name="is_show", type=Types::INT)
     * @Required()
     */
    private $is_show = '1';

 
    /**
     * 
     * @param int $value
     * @return $this
     */
    public function setRoomId(int $value)
    {
        $this->room_id = $value;

        return $this;
    }

    /**
     * 房间名字
     * @param string $value
     * @return $this
     */
    public function setRoomName(string $value): self
    {
        $this->room_name = $value;

        return $this;
    }

    /**
     * 
     * @param int $value
     * @return $this
     */
    public function setIsShow(int $value): self
    {
        $this->is_show = $value;

        return $this;
    }

 
    /**
     * 
     * @return int
     */
    public function getRoomId()
    {
        return $this->room_id;
    }

    /**
     * 房间名字
     * @return string
     */
    public function getRoomName()
    {
        return $this->room_name;
    }

    /**
     * 
     * @return int
     */
    public function getIsShow(): int
    {
        return $this->is_show;
    }

}
