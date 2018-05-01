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
 * @Table(name="system_log")
 * @uses      SystemLog
 * @version   2018年04月29日
 */
class SystemLog extends Model
{
    /**
     * @var int $sl_id
     * @Id()
     * @Column(name="sl_id", type=Types::INT)
     * @var null|int
     */
    private $sl_id;

    /**
     * @var string $message 错误消息
     * @Column(name="message", type=Types::STRING, length=255)
     * @Required()
     */
    private $message;

    /**
     * @var string $file 所在文件
     * @Column(name="file", type=Types::STRING, length=255)
     * @Required()
     */
    private $file;

    /**
     * @var int $line
     * @Column(name="line", type=Types::INT)
     * @Required()
     */
    private $line = 0;

    /**
     * @var mixed $recordTime
     * @Column(name="record_time", type="string")
     */
    private $recordTime;

    /**
     * @param int $value
     * @return $this
     */
    public function setSlId(int $value)
    {
        $this->sl_id = $value;

        return $this;
    }

    /**
     * 错误消息
     * @param string $value
     * @return $this
     */
    public function setMessage(string $value): self
    {
        $this->message = $value;

        return $this;
    }

    /**
     * 所在文件
     * @param string $value
     * @return $this
     */
    public function setFile(string $value): self
    {
        $this->file = $value;

        return $this;
    }

    /**
     * @param int $value
     * @return $this
     */
    public function setLine(int $value): self
    {
        $this->line = $value;

        return $this;
    }

    /**
     * @param $value
     * @return $this
     */
    public function setRecordTime($value): self
    {
        $this->recordTime = $value;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSlId()
    {
        return $this->sl_id;
    }

    /**
     * 错误消息
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * 所在文件
     * @return mixed
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @return mixed
     */
    public function getLine()
    {
        return $this->line;
    }

    /**
     * @return mixed
     */
    public function getRecordTime()
    {
        return $this->recordTime;
    }

}
