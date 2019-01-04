<?php

namespace App\Models\Services;

use App\Common\Code\Code;
use App\Common\Utility\Token;
use App\Exception\AuthException;
use App\Models\Data\UserData;
use App\Models\Entity\Users;
use App\Models\Services\Auth\BaseAuthService;
use Swoft\Bean\Annotation\Bean;
use Swoft\Bean\Annotation\Inject;

/**
 * @Bean()
 */
class TokenService
{

    /**
     *
     * @Inject()
     * @var UserData
     */
    private $UserData;

    public function generateToken(Users $users): array
    {
        $token_index = Token::getTokenIndex($users->getUserId());

        $info = [
            'user_id' => $users->getUserId(),
            'mobile' => $users->getMobile(),
            'github_id' => $users->getGithubId(),
            'wechat_unionId' => $users->getWechatUnionId(),
            'nick' => $users->getNick(),
            'avatar' => $users->getAvatar(),
            'age' => $users->getAge(),
            'sex' => $users->getSex(),
            'mail' => $users->getMail(),
        ];
        //不存在则生成 1.第一次登录 2.彻底失效 token_index的ttl和refresh_token的失效时间都为30天 token_index失效时 refresh_token同时失效
        if (!$hData = \Swoft::redis()->hGetAll($token_index)) {
            $token_arr = Token::Generate($info);
        } else {
            $old_access_token_key = Token::getAccessTokenKey($hData['access_token']);
            $old_refresh_token_key = Token::getRefreshTokenKey($hData['access_token']);
            $access_token_ttl = \Swoft::redis()->ttl($old_access_token_key);
            //access_token已经过期失效 失效是-2 也是<600 ..||access_token生存失效小于10分钟  刷新
            if ($access_token_ttl < 600) {
                $token_arr = Token::Generate($info, $old_access_token_key,$old_refresh_token_key);
            } else {
                $token_arr = ['access_token' => $hData['access_token'], 'refresh_token' => $hData['refresh_token']];
            }
        }

        return [
            'access_token' => $token_arr['access_token'],
            'refresh_token' => $token_arr['refresh_token'],
            'info' => $info,
        ];
    }

    public function refresh(int $user_id): array
    {
        $user = $this->UserData->getUserInfo($user_id);
        return $this->generateToken($user);
    }

    public function getUserInfoByToken(string $access_token): array
    {

        $userInfo = \Swoft::redis()->hGetAll(Token::getAccessTokenKey($access_token));
        if (!$userInfo) {
            $refresh_data = \Swoft::redis()->hGetAll(sprintf("%s:%s", Token::ACCESS_TOKEN, $access_token));
            //存在则返回刷新code 不存在则返回重新登录code
            if ($refresh_data) {
                throw new AuthException(Code::REFRESH_TOKEN, '请重新登录');
            } else {
                throw new AuthException(Code::INVALID_TOKEN, '请重新登录');
            }
        }

        return $userInfo;
    }

}