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
 */
class SystemTrace extends Model
{
    /**
     * @var int $traceId 
     * @Id()
     * @Column(name="trace_id", type="integer")
     */
    private $traceId;

    /**
     * @var int $slId 
     * @Column(name="sl_id", type="integer")
     * @Required()
     */
    private $slId;

    /**
     * @var string $trace 
     * @Column(name="trace", type="text", length=65535)
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
     * @return int
     */
    public function getSlId()
    {
        return $this->slId;
    }

    /**
     * @return string
     */
    public function getTrace()
    {
        return $this->trace;
    }

}
