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
 */
class SystemLog extends Model
{
    /**
     * @var int $slId 
     * @Id()
     * @Column(name="sl_id", type="integer")
     */
    private $slId;

    /**
     * @var string $message 错误消息
     * @Column(name="message", type="string", length=255)
     * @Required()
     */
    private $message;

    /**
     * @var string $file 所在文件
     * @Column(name="file", type="string", length=255)
     * @Required()
     */
    private $file;

    /**
     * @var int $line 
     * @Column(name="line", type="integer")
     * @Required()
     */
    private $line;

    /**
     * @var string $recordTime 
     * @Column(name="record_time", type="timestamp")
     */
    private $recordTime;

    /**
     * @param int $value
     * @return $this
     */
    public function setSlId(int $value)
    {
        $this->slId = $value;

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
     * @param string $value
     * @return $this
     */
    public function setRecordTime(string $value): self
    {
        $this->recordTime = $value;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSlId()
    {
        return $this->slId;
    }

    /**
     * 错误消息
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * 所在文件
     * @return string
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @return int
     */
    public function getLine()
    {
        return $this->line;
    }

    /**
     * @return string
     */
    public function getRecordTime()
    {
        return $this->recordTime;
    }

}
