<?php

namespace App\Common\Utility;

use App\Common\Code\Code;
use function Sodium\compare;
use Swoft\Bean\Annotation\Inject;
use Swoft\Bean\Annotation\Bean;
use Swoft\Bean\Annotation\Scope;
use Exception;

class Token
{
    // 有效期
    const expires = 7200;
    const refresh_expires = 2592000; //一个月有效
    // session名
    const ACCESS_TOKEN = 'access_token';
    const REFRESH_TOKEN = 'refresh_token';
    const TOKEN_INDEX = 'token_index';//token索引 维护token关系和数量
    // TokenKey
    protected $_tokenKey;

    private static function buildRandom($token_name, $length = 32)
    {
        //生成AccessToken
        $str_pol = "1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ123456789abcdefghijklmnopqrstuvwxyz";
        $random_str = substr(str_shuffle($str_pol), 0, $length);

        $token = sprintf('%s:%s', $token_name, $random_str);
        //如果redis中已存在则递归执行
        if (redis()->exists($token)) {
            return self::buildRandom($token_name, $length);
        }
        return $random_str;
    }

    public static function Generate(array $data, string $old_access_token_key = null, string $old_refresh_token_key = null): array
    {
        $access_token = self::buildRandom(self::ACCESS_TOKEN);
        $refresh_token = self::buildRandom(self::REFRESH_TOKEN);

        $access_token_key = self::getAccessTokenKey($access_token);
        redis()->hMset($access_token_key, $data);
        redis()->expire($access_token_key, self::expires);
        //维护旧的access_token5分钟 防止前端并发请求
        if ($old_access_token_key) {
            redis()->hMset($old_access_token_key, $data);
            redis()->expire($old_access_token_key, 300);
        }


        $refresh_token_key = self::getRefreshTokenKey($refresh_token);
        redis()->hMset($refresh_token_key, ['access_token' => $access_token, 'user_id' => $data['user_id']]);
        redis()->expire($refresh_token_key, self::refresh_expires);
        //refresh时 删除旧的refresh_token
        if ($old_refresh_token_key) {
            redis()->del($old_refresh_token_key);
        }


        $token_index = sprintf('%s:%s', self::TOKEN_INDEX, $data['user_id']);
        redis()->hMset($token_index, compact('access_token', 'refresh_token'));
        redis()->expire($token_index, self::refresh_expires);
        return compact('access_token', 'refresh_token');
    }


    public static function getRefreshTokenKey($refresh_token)
    {
        return sprintf("%s:%s", Token::REFRESH_TOKEN, $refresh_token);
    }

    public static function getAccessTokenKey($access_token)
    {
        return sprintf("%s:%s", Token::ACCESS_TOKEN, $access_token);
    }

    public static function getTokenIndex(int $user_id)
    {
        return sprintf("%s:%s", Token::TOKEN_INDEX, $user_id);
    }

    /**
     * main
     * @param $accessToken string
     * @param $rank bool false不严格验证登录态 使用场景:显示是否已经点赞等|true验证用户信息准确性
     * @return array
     * @throws Exception
     */
    public function checkBasicAuth(string $accessToken = null, bool $rank = false)
    {

        if ($rank == false) {
            if ($hData = $this->redis->hGetAll($accessToken)) {
                return $hData;
            } else {
                return null;
            }
        } else {
            if (!empty($accessToken)) {
                if ($hData = $this->redis->hGetAll($accessToken)) {
                    return $hData;
                } else {
                    throw new Exception('账号异常,请重新登录', Code::INVALID_TOKEN);
                }
            } else {
                throw new Exception('账号异常,请重新登录', Code::UNLOGIN);
            }
        }
    }

}