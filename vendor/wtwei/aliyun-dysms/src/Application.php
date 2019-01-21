<?php
/**
 * Created by PhpStorm.
 * User: Kevin
 * Date: 2017/12/21
 * Time: 21:04
 */

namespace Aliyun;

use Aliyun\Api\Green\Request\V20170112\TextScanRequest;
use Aliyun\Core\Config as AliyunConfig;
use Aliyun\Core\DefaultAcsClient;
use Aliyun\Core\Profile\DefaultProfile;


class Application
{
    private $accessKeyId = '';
    private $accessKeySecret = '';

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
     * 取得AcsClient
     *
     * @return DefaultAcsClient
     */
    public function getAcsClient()
    {
        //产品名称:云通信流量服务API产品,开发者无需替换
        $product = "Green";

        //产品域名,开发者无需替换
        $domain = "green.cn-shanghai.aliyuncs.com";

        $accessKeyId = $this->getAccessKeyId(); // AccessKeyId

        $accessKeySecret = $this->getAccessKeySecret(); // AccessKeySecret

        // 暂时不支持多Region
        $region = "cn-shanghai";

        // 服务结点
        $endPointName = "cn-shanghai";

        //初始化acsClient,暂不支持region化
        $profile = DefaultProfile::getProfile($region, $accessKeyId, $accessKeySecret);

        // 增加服务结点
        DefaultProfile::addEndpoint($endPointName, $region, $product, $domain);

        return new DefaultAcsClient($profile);
    }

    /**
     * 文本扫描
     * @param array  $content
     * @param string $scenes antispam文本垃圾检测，keyword关键词检测
     * @return array
     */
    public function textScan($content = [], $scenes = 'antispam')
    {
        $request = new TextScanRequest();
        $request->setMethod("POST");
        $request->setAcceptFormat("JSON");

        $task = [];
        foreach ($content as $item) {
            $task[] = [
                'dataId'  => uniqid(),
                'content' => $item,
            ];
        }

        $request->setContent(json_encode([
            "tasks"  => $task,
            "scenes" => [$scenes],
        ]));
        $client   = $this->getAcsClient();
        $response = $client->getAcsResponse($request);

        try {
            if (200 == $response->code) {
                $data        = [];
                $taskResults = $response->data;
                foreach ($taskResults as $taskResult) {
                    if (200 == $taskResult->code) {
                        $sceneResults = $taskResult->results;
                        foreach ($sceneResults as $sceneResult) {
                            $scene      = $sceneResult->scene;
                            $suggestion = $sceneResult->suggestion;
                            $label      = $sceneResult->label;
                            $rate       = $sceneResult->rate;
                            //根据scene和suggetion做相关的处理
                            $data[] = ['rate' => $rate, 'scene' => $scene, 'suggestion' => $suggestion, 'label' => $label];
                        }
                    }
                }
                $return = ['iRet' => 1, 'data' => $data];
            } else {
                $return = ['iRet' => 0, 'info' => $response->msg];
            }
        } catch (\Exception $exception) {
            $return = ['iRet' => 0, 'info' => $exception->getMessage()];
        }

        return $return;
    }


}