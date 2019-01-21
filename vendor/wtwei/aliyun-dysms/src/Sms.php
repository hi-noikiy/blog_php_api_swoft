<?php
/**
 * Created by PhpStorm.
 * User: Kevin
 * Date: 2017/12/21
 * Time: 21:04
 */

namespace Aliyun;

use Aliyun\Api\Sms\Request\V20170525\QuerySendDetailsRequest;
use Aliyun\Api\Sms\Request\V20170525\SendSmsRequest;
use Aliyun\Core\Config as AliyunConfig;
use Aliyun\Core\DefaultAcsClient;
use Aliyun\Core\Profile\DefaultProfile;


class Sms
{
    private $accessKeyId = '';
    private $accessKeySecret = '';
    private $signName = '';
    private $templateCode = '';
    private $outId = '';

    public function __construct($access_key, $access_secret)
    {
        $this->setAccessKeyId($access_key);
        $this->setAccessKeySecret($access_secret);

        // 初始化阿里云config
        AliyunConfig::load();
    }

    /**
     * @return string
     */
    public function getAccessKeyId()
    {
        return $this->accessKeyId;
    }

    /**
     * @param string $accessKeyId
     */
    public function setAccessKeyId($accessKeyId)
    {
        $this->accessKeyId = $accessKeyId;
    }

    /**
     * @return string
     */
    public function getAccessKeySecret()
    {
        return $this->accessKeySecret;
    }

    /**
     * @param string $accessKeySecret
     */
    public function setAccessKeySecret($accessKeySecret)
    {
        $this->accessKeySecret = $accessKeySecret;
    }

    /**
     * @return string
     */
    public function getSignName()
    {
        return $this->signName;
    }

    /**
     * @param string $signName
     */
    public function setSignName($signName)
    {
        $this->signName = $signName;
    }

    /**
     * @return string
     */
    public function getTemplateCode()
    {
        return $this->templateCode;
    }

    /**
     * @param string $templateCode
     */
    public function setTemplateCode($templateCode)
    {
        $this->templateCode = $templateCode;
    }

    /**
     * @return string
     */
    public function getOutId()
    {
        return $this->outId;
    }

    /**
     * @param string $outId
     */
    public function setOutId($outId)
    {
        $this->outId = $outId;
    }

    /**
     * 取得AcsClient
     *
     * @return DefaultAcsClient
     */
    public function getAcsClient()
    {
        //产品名称:云通信流量服务API产品,开发者无需替换
        $product = "Dysmsapi";

        //产品域名,开发者无需替换
        $domain = "dysmsapi.aliyuncs.com";

        $accessKeyId = $this->getAccessKeyId(); // AccessKeyId

        $accessKeySecret = $this->getAccessKeySecret(); // AccessKeySecret

        // 暂时不支持多Region
        $region = "cn-hangzhou";

        // 服务结点
        $endPointName = "cn-hangzhou";

        //初始化acsClient,暂不支持region化
        $profile = DefaultProfile::getProfile($region, $accessKeyId, $accessKeySecret);

        // 增加服务结点
        DefaultProfile::addEndpoint($endPointName, $region, $product, $domain);

        return new DefaultAcsClient($profile);
    }

    /**
     * 发送短信
     * @param string $phone
     * @param array  $param
     * @return mixed|\SimpleXMLElement
     */
    public function send($phone, $param = [])
    {
        // 初始化SendSmsRequest实例用于设置发送短信的参数
        $request = new SendSmsRequest();

        // 必填，设置短信接收号码
        $request->setPhoneNumbers($phone);

        // 必填，设置签名名称，应严格按"签名名称"填写，请参考: https://dysms.console.aliyun.com/dysms.htm#/develop/sign
        $request->setSignName($this->getSignName());

        // 必填，设置模板CODE，应严格按"模板CODE"填写, 请参考: https://dysms.console.aliyun.com/dysms.htm#/develop/template
        $request->setTemplateCode($this->getTemplateCode());

        // 可选，设置模板参数
        $param && $request->setTemplateParam(json_encode($param));

        // 可选，设置流水号
        $this->outId && $request->setOutId($this->outId);

        // 发起访问请求
        $acsResponse = $this->getAcsClient()->getAcsResponse($request);

        return $acsResponse;
    }

    /**
     * 短信发送记录查询短信接收号码
     * @param string $phone
     * @param string $date      短信发送日期，格式Ymd，支持近30天记录查询
     * @param int    $page      当前页码
     * @param int    $page_size 分页大小
     * @param string $bizId     短信发送流水号
     * @return mixed|\SimpleXMLElement
     */
    public function querySendDetails($phone, $date, $page = 1, $page_size = 20, $bizId = '')
    {

        // 初始化QuerySendDetailsRequest实例用于设置短信查询的参数
        $request = new QuerySendDetailsRequest();

        // 必填，
        $request->setPhoneNumber($phone);

        // 必填，
        $request->setSendDate($date);

        // 必填，
        $request->setPageSize($page_size);

        // 必填，
        $request->setCurrentPage($page);

        // 选填，
        $request->setBizId($bizId);

        // 发起访问请求
        $acsResponse = $this->getAcsClient()->getAcsResponse($request);

        return $acsResponse;
    }


}