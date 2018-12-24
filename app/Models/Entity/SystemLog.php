<?php
namespace App\Models\Entity;

use Swoft\Db\Bean\Annotation\Column;
use Swoft\Db\Bean\Annotation\Entity;
use Swoft\Db\Bean\Annotation\Id;
use Swoft\Db\Bean\Annotation\Required;
use Swoft\Db\Bean\Annotation\Table;

/**
 * @Entity()
 * @Table(name="system_log")
 * @uses      SystemLog
 */
class SystemLog extends BaseModel
{
    /**
     * @var int $slId 
     * @Id()
     * @Column(name="sl_id", type="integer")
     */
    private $slId;

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
     * @var string $accessToken 
     * @Column(name="access_token", type="string", length=255)
     */
    private $accessToken;

    /**
     * @var string $param 
     * @Column(name="param", type="text", length=16777215)
     * @Required()
     */
    private $param;

    /**
     * @var string $uri 
     * @Column(name="uri", type="string", length=255)
     * @Required()
     */
    private $uri;

    /**
     * @var string $method 
     * @Column(name="method", type="string", length=10)
     * @Required()
     */
    private $method;

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
     * @var string $message 错误消息
     * @Column(name="message", type="string", length=255)
     * @Required()
     */
    private $message;

    /**
     * @var string $ip 
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
    public function setSlId(int $value)
    {
        $this->slId = $value;

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
    public function setAccessToken(?string $value): self
    {
        $this->accessToken = $value;

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
    public function setUri(string $value): self
    {
        $this->uri = $value;

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
    public function getSlId()
    {
        return $this->slId;
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
    public function getAccessToken()
    {
        return $this->accessToken;
    }

    /**
     * @return string
     */
    public function getParam()
    {
        return $this->param;
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
    public function getMethod()
    {
        return $this->method;
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
     * 错误消息
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
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
