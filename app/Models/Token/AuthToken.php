<?php
/**
 *
 * @author cpj
 * @date 2018/12/27
 */

namespace App\Models\Token;

use Swoft\Bean\Annotation\Bean;
use Swoft\Bean\Annotation\Scope;

/**
 * @Bean(scope=Scope::PROTOTYPE)
 */
class AuthToken
{

    private $user_id = 0;

    private $mobile;

    private $github_id;

    private $wechat_unionId;

    private $nick;

    private $avatar;

    private $age;

    private $sex;

    private $mail;


    protected $user_info = [];


    public function getUserId(): int
    {
        return $this->user_id;
    }

    public function setUserId(int $user_id): self
    {
        $this->user_id = $user_id;
        return $this;
    }

    public function getUserInfo($key = '', $default = null): array
    {
        if ($key) {
            return $this->user_info[$key] ?? $default;
        }
        return $this->user_info;
    }

    public function setUserInfo(array $user_info): self
    {
        $this->user_info = $user_info;
        return $this;
    }
}