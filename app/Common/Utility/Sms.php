<?php

namespace App\Common\Utility;

use App\Common\Enums\SmsEnum;
use App\Models\Entity\SmsRecord;

class Sms
{

    public static function send($mobile, $template_code, $sms_code)
    {
        $config = config('alisms');

        $aliYunSms = new \Aliyun\Sms($config['AccessKeyID'], $config['AccessKeySecret']);
        $aliYunSms->setSignName($config['sign']);
        $aliYunSms->setTemplateCode($template_code);
        $res = $aliYunSms->send($mobile, ['code' => $sms_code]);
        if (!isset($resp->result)) {
            return false;
        }
        if (isset($res) && $res->Code == 'OK') {
            $SmsRecord = new SmsRecord();
            $SmsRecord->setMobile($mobile)->setTemplateCode($template_code)
                ->setRequestId($res->RequestId)->setBizId($res->BizId)
                ->setIp(\Swoft::ip())->setDate(date('Y-m-d H:i:s'))
                ->save();
        } else {
            return false;
        }
        return true;
    }


    public static function transformType($type)
    {
        $config = config('alisms');
        switch ($type) {
            case SmsEnum::LOGIN:
                $template_code = $config['template']['login'];
                break;  //账号登陆
            case SmsEnum::REGISTER:
                $template_code = $config['template']['register'];
                break; //注册
//            case 3: $template_code = self::TEMPLATE_REG; break;    //修改密码
            case SmsEnum::BINDING:
                $template_code = $config['template']['binding'];
                break;   //绑定
            case SmsEnum::THIRD_BINDING:
                $template_code = $config['template']['binding'];
//                break;   //第三方绑定 短信一样 不验证手机号码是否存在
        }
        return $template_code;
    }
}