<?php

namespace App\Models;

use App\Common\Code\Code;
use Swoft\Bean\Annotation\Inject;
use Swoft\Bean\Annotation\Bean;
use Swoft\Bean\Annotation\Scope;
use Exception;

/**
 *
 * @Bean()
 * @uses      Token
 */
class Token
{
    /**
     * @Inject()
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
    private $clientInfo = null;

    private function buildAccessToken($lenght = 32)
    {
        //生成AccessToken
        $str_pol = "1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ123456789abcdefghijklmnopqrstuvwxyz";
        $AccessToken = substr(str_shuffle($str_pol), 0, $lenght);

        //如果redis中已存在则递归执行
        if ($this->redis->has($AccessToken)) {
            return $this->buildAccessToken();
        }
        return $AccessToken;
    }

    public function setToken(array $data): string
    {
        $AccessToken = $this->buildAccessToken();
        $this->redis->hMset($AccessToken, $data);
        $this->redis->expire($AccessToken, $this->expires);
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
            if ($hkeys = $this->redis->hKeys($accessToken)) {
                $hvals = $this->redis->hVals($accessToken);
                $this->setClientInfo(array_combine($hkeys, $hvals));
            } else {
                $this->setClientInfo(null);
            }
        } else {
            if (!empty($accessToken)) {
                if ($hkeys = $this->redis->hKeys($accessToken)) {
                    $hvals = $this->redis->hVals($accessToken);
                    $this->setClientInfo(array_combine($hkeys, $hvals));
                } else {
                    throw new Exception('账号异常,请重新登录', Code::INVALID_TOKEN);
                }
            } else {
                throw new Exception('账号异常,请重新登录', Code::UNLOGIN);
            }
        }
    }

    public function setClientInfo($data)
    {
        $this->clientInfo = $data;
    }

    public function getClientInfo(string $name = null)
    {
        if ($this->clientInfo) {
            if ($name && isset($this->clientInfo[$name])) {
                return $this->clientInfo[$name];
            } else {
                return $this->clientInfo;
            }
        } else {
            return null;
        }
    }

}