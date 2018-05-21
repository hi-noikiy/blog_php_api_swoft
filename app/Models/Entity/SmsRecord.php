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
 */
class SmsRecord extends Model
{
    /**
     * @var int $id 
     * @Id()
     * @Column(name="id", type="integer")
     */
    private $id;

    /**
     * @var string $mobile 
     * @Column(name="mobile", type="string", length=50)
     * @Required()
     */
    private $mobile;

    /**
     * @var string $templateCode 
     * @Column(name="template_code", type="string", length=100)
     * @Required()
     */
    private $templateCode;

    /**
     * @var string $requestId 
     * @Column(name="request_id", type="string", length=50)
     * @Required()
     */
    private $requestId;

    /**
     * @var string $ip 
     * @Column(name="ip", type="string", length=50)
     * @Required()
     */
    private $ip;

    /**
     * @var string $date 
     * @Column(name="date", type="timestamp")
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
     * @param string $value
     * @return $this
     */
    public function setDate(string $value): self
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
     * @return string
     */
    public function getMobile()
    {
        return $this->mobile;
    }

    /**
     * @return string
     */
    public function getTemplateCode()
    {
        return $this->templateCode;
    }

    /**
     * @return string
     */
    public function getRequestId()
    {
        return $this->requestId;
    }

    /**
     * @return string
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * @return string
     */
    public function getDate()
    {
        return $this->date;
    }

}
