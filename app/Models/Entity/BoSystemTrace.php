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
 * @Table(name="bo_system_trace")
 * @uses      BoSystemTrace
 * @version   2018年04月28日
 */
class BoSystemTrace extends Model
{
    /**
     * @var int $traceId 
     * @Id()
     * @Column(name="trace_id", type=Types::INT)
     */
    private $traceId;

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
        $this->traceId = $value;

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
        return $this->traceId;
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
