<?php
namespace App\Common\Utility;


use App\Models\Entity\SmsRecord;
use Flc\Alidayu\Client;
use Flc\Alidayu\Requests\IRequest;

class Sms
{
    private $config;


    private function Ali_sms($mobile, $template_code, $sms_code)
    {
        Client::configure($this->config);
        $resp = Client::request('alibaba.aliqin.fc.sms.num.send', function (IRequest $req) use ($sms_code, $mobile, $template_code) {
            $req->setRecNum($mobile)
                ->setSmsParam([
                    'code' => $sms_code
                ])
                ->setSmsFreeSignName('为伴')
                ->setSmsTemplateCode($template_code);
        });
        if (!isset($resp->result)) {
            return false;
        }
        if (isset($resp->result) && $resp->result->success) {
            $SmsRecord = new SmsRecord();
            $SmsRecord->setMobile($mobile);
            $SmsRecord->setTemplateCode($template_code);
            $SmsRecord->setRequestId($resp->request_id);
            $SmsRecord->setDate(date('Y-m-d H:i:s', time()));
            $SmsRecord->save();
        }
        return true;
    }


    private function transformType($type)
    {
        switch ($type) {
            case 1:
                $template_code = $this->config['template']['login'];
                break;  //账号登陆
            case 2:
                $template_code = $this->config['template']['register'];
                break; //注册
//            case 3: $template_code = self::TEMPLATE_REG; break;    //修改密码
            case 4:
                $template_code = $this->config['template']['binding'];
                break;   //绑定
            case 5:
                $template_code = $this->config['template']['binding'];
                break;   //第三方绑定 短信一样 不验证手机号码是否存在
        }
        return $template_code;
    }
}