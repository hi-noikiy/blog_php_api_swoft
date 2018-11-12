<?php

namespace App\Models\Services\AuthServices;


use App\Common\Enums\Sms;
use App\Common\Mapping\AuthInterface;
use App\Models\Entity\Users;

class SmsCodeAuthService extends BaseAuthService implements AuthInterface
{
    public function auth(array $data)
    {
        // TODO: Implement auth() method.
        //能发送验证 已经保证了账号的存在性

        $hData = \Swoft::redis()->hGetAll(sprintf(Sms::SMS_SEND_TYPE,$data['mobile'],$data['type']));
        if ($hData){

        }
        $data['type'];
        $data['sms_code'];

        /* @var Users $user */
        $user = Users::findOne(['mobile' => $data['mobile']])->getResult();
        return $this->generateToken($user);
    }

    private function check(){

    }
}