<?php

namespace App\Models\Services;

use App\Common\Enums\Sms;
use App\Common\Utility\Token;
use App\Models\Data\UserData;
use App\Models\Entity\Users;
use App\Models\Services\AuthServices\BaseAuthService;
use Swoft\Bean\Annotation\Bean;
use Swoft\Bean\Annotation\Inject;

/**
 * @Bean()
 */
class SmsService
{

    /**
     * @Inject("demoRedis")
     * @var \Swoft\Redis\Redis
     */
    private $redis;

    /**
     * 验证手机验证码
     * @param string $mobile 手机号码
     * @param int $sms_code 手机验证码
     * @param int $type 类型
     */
    public function check(string $mobile, int $sms_code, int $type)
    {
        $sms_send_type_mobile = sprintf(Sms::SMS_SEND_TYPE, $type, $mobile);
        if (!$hashSmsData = $this->redis->hGetAll($sms_send_type_mobile)) {
            throw new \InvalidArgumentException("验证码失效,请重新获取");
        }

        if ($hashSmsData['sms_code'] != $sms_code) {
            //未超过3次 记录ttl--
            if ($hashSmsData['ttl'] > 0) {
                $this->redis->hIncrBy($sms_send_type_mobile, 'ttl', -1);
                throw new \InvalidArgumentException("验证码错误,还有" . ($hashSmsData['ttl'] - 1) . "次机会");
            } else {
                //试错3次 删除验证码
                $this->redis->delete($sms_send_type_mobile);
                throw new \InvalidArgumentException("输错3次,请重新获取验证码");
            }
        } else {
            //验证成功也删除验证码
            $this->redis->delete($sms_send_type_mobile);
        }

    }
}