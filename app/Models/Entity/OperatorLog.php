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
 * 请求日志
 * @Entity()
 * @Table(name="operator_log")
 * @uses      OperatorLog
 */
class OperatorLog extends BaseModel
{
    /**
     * @var int $id
     * @Id()
     * @Column(name="id", type="integer")
     */
    private $id;

    /**
     * @var int $operatorUserId
     * @Column(name="operator_user_id", type="integer")
     */
    private $operatorUserId;

    /**
     * @var string $operatorUserName
     * @Column(name="operator_user_name", type="string", length=50)
     */
    private $operatorUserName;

    /**
     * @var string $uri
     * @Column(name="uri", type="string", length=255)
     * @Required()
     */
    private $uri;

    /**
     * @var string $param
     * @Column(name="param", type="string", length=255)
     * @Required()
     */
    private $param;

    /**
     * @var string $method
     * @Column(name="response", type="string", length=255)
     * @Required()
     */
    private $response;

    /**
     * @var string $method
     * @Column(name="method", type="string", length=10)
     * @Required()
     */
    private $method;

    /**
     * @var string $method
     * @Column(name="ip", type="string", length=30)
     * @Required()
     */
    private $ip;

    /**
     * @var string $createdAt
     * @Column(name="created_at", type="timestamp")
     */
    private $createdAt;

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
     * @param int $value
     * @return $this
     */
    public function setOperatorUserId(int $value): self
    {
        $this->operatorUserId = $value;

        return $this;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setOperatorUserName(string $value): self
    {
        $this->operatorUserName = $value;

        return $this;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setUri(string $value): self
    {
        $this->uri = $value;

        return $this;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setParam(string $value): self
    {
        $this->param = $value;

        return $this;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setResponse(string $value): self
    {
        $this->response = $value;

        return $this;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setMethod(string $value): self
    {
        $this->method = $value;

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
    public function setCreatedAt(string $value): self
    {
        $this->createdAt = $value;

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
     * @return int
     */
    public function getOperatorUserId()
    {
        return $this->operatorUserId;
    }

    /**
     * @return string
     */
    public function getOperatorUserName()
    {
        return $this->operatorUserName;
    }

    /**
     * @return string
     */
    public function getUri()
    {
        return $this->uri;
    }

    /**
     * @return string
     */
    public function getParam()
    {
        return $this->param;
    }


    /**
     *
     * @return string
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
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
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

}
