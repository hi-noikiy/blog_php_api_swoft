<?php

namespace App\Common\Utility;

use App\Common\Code\Code;
use Exception;
use Swoft\App;
use Swoft\Bean\Annotation\Inject;
use Swoft\Redis\Redis;

class Token
{
    /**
     * @Inject("demoRedis")
     * @var \Swoft\Redis\Redis
     */
    private $redis;

    // 有效期
    public $expires = 3600;
    // session名
    private static $token_name = 'access-token';
    // TokenKey
    protected $_tokenKey;

    /**
     * 客户端信息
     * @var $clientInfo array|null
     */
    public $clientInfo = null;

    public function __construct(Redis $redis)
    {
        $this->redis = $redis;
    }

    public function buildAccessToken($lenght = 32)
    {
        var_dump($this->redis);
        //生成AccessToken
        $str_pol = "1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ123456789abcdefghijklmnopqrstuvwxyz";
        $AccessToken = substr(str_shuffle($str_pol), 0, $lenght);

        //如果redis中已存在则递归执行

        if ($this->redis->has($AccessToken)) {
            return $this->buildAccessToken();
        }
        return $AccessToken;
    }

    /**
     * main
     * @param $accessToken string
     * @param $rank bool false不严格验证登录态 使用场景:显示是否已经点赞等|true验证用户信息准确性
     * @return void
     * @throws Exception
     */
    public function checkBasicAuth(string $accessToken = null, bool $rank = false)
    {

        if ($rank == false) {
            if ($map = $this->redis->hGetAll($accessToken)) {
                $this->clientInfo = $map;
            }
        } else {
            if (!empty($accessToken)) {

                if ($map = $this->redis->hGetAll($accessToken)) {
                    $this->setClientInfo($map);
                } else {
                    throw new Exception('账号异常,请重新登录', Code::INVALID_TOKEN);
                }
            } else {
                throw new Exception('账号异常,请重新登录', Code::UNLOGIN);
            }
        }
    }

    public function setClientInfo($data){
        $this->clientInfo = $data;
    }

    public function getClientInfo(string $name){
        if($this->clientInfo){
            if($name){
                return $this->clientInfo[$name];
            }else{
                return $this->clientInfo;
            }
        }else{
            return null;
        }
    }
}