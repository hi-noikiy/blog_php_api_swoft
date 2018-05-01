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
 * @Table(name="system_trace")
 * @uses      SystemTrace
 * @version   2018年04月29日
 */
class SystemTrace extends Model
{
    /**
     * @var int $traceId 
     * @Id()
     * @Column(name="trace_id", type=Types::INT)
     */
    private $trace_id;

    /**
     * @var int $slId 
     * @Column(name="sl_id", type=Types::INT)
     * @Required()
     */
    private $slId = 0;

    /**
     * @var string $trace 
     * @Column(name="trace", type=Types::STRING, length=65535)
     */
    private $trace;

    /**
     * @param int $value
     * @return $this
     */
    public function setTraceId(int $value)
    {
        $this->trace_id = $value;

        return $this;
    }

    /**
     * @param int $value
     * @return $this
     */
    public function setSlId(int $value): self
    {
        $this->slId = $value;

        return $this;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setTrace(string $value): self
    {
        $this->trace = $value;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTraceId()
    {
        return $this->trace_id;
    }

    /**
     * @return mixed
     */
    public function getSlId()
    {
        return $this->slId;
    }

    /**
     * @return mixed
     */
    public function getTrace()
    {
        return $this->trace;
    }

}
