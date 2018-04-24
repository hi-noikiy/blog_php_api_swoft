<?php
namespace App\Common\Bean;

use Swoft\Bean\Annotation\Bean;

/**
 * @\Swoft\Bean\Annotation\Bean("UserData")
 */
class UserData
{
    private $user_info = null;

    public function setUserInfo(array $array){
        $this->user_info = $array;
    }

    public function getUserInfo($key = null)
    {
        if($key && isset($this->user_info[$key])){
            return $this->user_info[$key];
        }
        return $this->user_info;
    }
}