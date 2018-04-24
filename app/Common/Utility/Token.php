<?php

namespace App\Common\Utility;

use Swoft\Bean\Annotation\Inject;

class Token
{
    /**
     * @Inject("demoRedis")
     * @var \Swoft\Redis\Redis
     */
    private $redis;

    private $request;
    private $response;

    // 有效期
    public $expires = 3600;
    // session名
    private static $token_name = 'access-token';
    // TokenKey
    protected $_tokenKey;

    public function __construct()
    {
    }

    protected function buildAccessToken($lenght = 32)
    {
        //生成AccessToken
        $str_pol = "1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ123456789abcdefghijklmnopqrstuvwxyz";
        $AccessToken =  substr(str_shuffle($str_pol), 0, $lenght);

        //如果redis中已存在则递归执行
        if($this->redis->exists($AccessToken)){
            return $this->buildAccessToken();
        }
        return $AccessToken;
    }
}