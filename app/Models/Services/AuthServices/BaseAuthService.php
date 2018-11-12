<?php

namespace App\Models\Services\AuthServices;

use App\Models\Entity\Users;
use App\Common\Utility\Token;
use Swoft\Bean\Annotation\Bean;

class BaseAuthService
{

    public function update_user_info(Users $user): void
    {
        $user->setLoginTime(date('Y-m-d H:i:s'));
        $user->visitCount++;
        $user->update();
    }

    public function generateToken(Users $users): array
    {
        $token_index = Token::getTokenIndex($users->getUserId());

        $info = [
            'user_id' => $users->getUserId(),
            'mobile' => $users->getMobile()
        ];
        //不存在则生成 1.第一次登录 2.彻底失效 token_index的ttl和refresh_token的失效时间都为30天 token_index失效时 refresh_token同时失效
        if (!$hData = redis()->hGetAll($token_index)) {
            $token_arr = Token::Generate($info);
        } else {
            $old_access_token_key = Token::getAccessTokenKey($hData['access_token']);
            $old_refresh_token_key = Token::getRefreshTokenKey($hData['refresh_token']);
            $access_token_ttl = redis()->ttl($old_access_token_key);
            //access_token已经过期失效 失效是-2 也是<600 ..||access_token生存失效小于10分钟  刷新
            if ($access_token_ttl < 600) {
                $token_arr = Token::Generate($info, $old_access_token_key, $old_refresh_token_key);
            } else {
                $token_arr = ['access_token' => $hData['access_token'], 'refresh_token' => $hData['refresh_token']];
            }
        }

        return [
            'access_token' => $token_arr['access_token'],
            'refresh_token' => $token_arr['refresh_token'],
            'info' => [
                'mobile' => $users->getMobile(),
                'nick' => $users->getNick(),
                'avatar' => $users->getAvatar(),
                'age' => $users->getAge(),
                'sex' => $users->getSex()
            ],
        ];
    }

    public function md5_salt(string $password, string $salt): string
    {
        return md5(md5($password) . $salt);
    }

}