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
 * @Table(name="sms_record")
 * @uses      SmsRecord
 * @version   2018年04月29日
 */
class SmsRecord extends Model
{
    /**
     * @var int $id 
     * @Id()
     * @Column(name="id", type=Types::INT)
     */
    private $id;

    /**
     * @var string $mobile 
     * @Column(name="mobile", type=Types::STRING, length=50)
     * @Required()
     */
    private $mobile;

    /**
     * @var string $templateCode 
     * @Column(name="template_code", type=Types::STRING, length=100)
     * @Required()
     */
    private $templateCode;

    /**
     * @var string $requestId 
     * @Column(name="request_id", type=Types::STRING, length=50)
     * @Required()
     */
    private $requestId;

    /**
     * @var string $ip 
     * @Column(name="ip", type=Types::STRING, length=50)
     * @Required()
     */
    private $ip;

    /**
     * @var mixed $date 
     * @Column(name="date", type="string")
     * @Required()
     */
    private $date;

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
    public function setMobile(string $value): self
    {
        $this->mobile = $value;

        return $this;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setTemplateCode(string $value): self
    {
        $this->templateCode = $value;

        return $this;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setRequestId(string $value): self
    {
        $this->requestId = $value;

        return $this;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setIp(string $value): self
    {
        $this->ip = $value;

        return $this;
    }

    /**
     * @param $value
     * @return $this
     */
    public function setDate($value): self
    {
        $this->date = $value;

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
     * @return mixed
     */
    public function getMobile()
    {
        return $this->mobile;
    }

    /**
     * @return mixed
     */
    public function getTemplateCode()
    {
        return $this->templateCode;
    }

    /**
     * @return mixed
     */
    public function getRequestId()
    {
        return $this->requestId;
    }

    /**
     * @return mixed
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

}
