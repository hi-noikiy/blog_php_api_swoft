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
        $token_index = sprintf('%s:%d', Token::TOKEN_INDEX, $users->getUserId());

        $info = [
            'user_id' => $users->getUserId(),
            'mobile' => $users->getMobile()
        ];
        //不存在则生成
        if (!$hData = redis()->hGetAll($token_index)) {
//            Token:
            $token_arr = Token::setToken($info);
        } else {
            $access_token_ttl = redis()->ttl(sprintf("%s:%s", Token::ACCESS_TOKEN, $hData['access_token']));
            if ($access_token_ttl == -2) {
                $token_arr = Token::setToken($info);
//            else if ($access_token_ttl < 3600) {
//                    redis()->del();
//                }
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