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
     * @var string $mobile 发送短信手机号

     * @Column(name="mobile", type="string", length=50)
     * @Required()
     */
    private $mobile;

    /**
     * @var string $templateCode 模版id
     * @Column(name="template_code", type="string", length=100)
     * @Required()
     */
    private $templateCode;

    /**
     * @var string $requestId 状态码-返回OK代表请求成功,其他错误码详见错误码列表
     * @Column(name="request_id", type="string", length=50)
     * @Required()
     */
    private $requestId;

    /**
     * @var string $bizId 发送回执ID,可根据该ID查询具体的发送状态
     * @Column(name="biz_id", type="string", length=50)
     * @Required()
     */
    private $bizId;

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
     * @var int $status 0:业务触发发送|1:回调通知发送成功|2:回调通知发送失败
     * @Column(name="status", type="tinyint", default=0)
     */
    private $status;

    /**
     * @var string $errMsg 
     * @Column(name="err_msg", type="string", length=255, default="")
     */
    private $errMsg;

    /**
     * @var string $sendTime 
     * @Column(name="send_time", type="timestamp")
     */
    private $sendTime;

    /**
     * @var string $reportTime 
     * @Column(name="report_time", type="timestamp")
     */
    private $reportTime;

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
     * 发送短信手机号

     * @param string $value
     * @return $this
     */
    public function setMobile(string $value): self
    {
        $this->mobile = $value;

        return $this;
    }

    /**
     * 模版id
     * @param string $value
     * @return $this
     */
    public function setTemplateCode(string $value): self
    {
        $this->templateCode = $value;

        return $this;
    }

    /**
     * 状态码-返回OK代表请求成功,其他错误码详见错误码列表
     * @param string $value
     * @return $this
     */
    public function setRequestId(string $value): self
    {
        $this->requestId = $value;

        return $this;
    }

    /**
     * 发送回执ID,可根据该ID查询具体的发送状态
     * @param string $value
     * @return $this
     */
    public function setBizId(string $value): self
    {
        $this->bizId = $value;

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
     * 0:业务触发发送|1:回调通知发送成功|2:回调通知发送失败
     * @param int $value
     * @return $this
     */
    public function setStatus(int $value): self
    {
        $this->status = $value;

        return $this;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setErrMsg(string $value): self
    {
        $this->errMsg = $value;

        return $this;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setSendTime(string $value): self
    {
        $this->sendTime = $value;

        return $this;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setReportTime(string $value): self
    {
        $this->reportTime = $value;

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
     * 发送短信手机号

     * @return string
     */
    public function getMobile()
    {
        return $this->mobile;
    }

    /**
     * 模版id
     * @return string
     */
    public function getTemplateCode()
    {
        return $this->templateCode;
    }

    /**
     * 状态码-返回OK代表请求成功,其他错误码详见错误码列表
     * @return string
     */
    public function getRequestId()
    {
        return $this->requestId;
    }

    /**
     * 发送回执ID,可根据该ID查询具体的发送状态
     * @return string
     */
    public function getBizId()
    {
        return $this->bizId;
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

    /**
     * 0:业务触发发送|1:回调通知发送成功|2:回调通知发送失败
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return string
     */
    public function getErrMsg()
    {
        return $this->errMsg;
    }

    /**
     * @return string
     */
    public function getSendTime()
    {
        return $this->sendTime;
    }

    /**
     * @return string
     */
    public function getReportTime()
    {
        return $this->reportTime;
    }

}
