<?php

namespace App\Models\Services;

use App\Common\Code\Code;
use App\Common\Enums\Sms;
use App\Exception\CustomException;
use App\Exception\ExtendDataException;
use App\Exception\SystemException;
use App\Models\Entity\SmsRecord;
use Swoft\Bean\Annotation\Bean;
use Swoft\Bean\Annotation\Inject;

/**
 * @Bean()
 */
class SmsService
{

    /**
     * @Inject("demoRedis")
     * @var \Redis
     */
    private $redis;

    public function send(string $mobile, int $type): void
    {

        $sms_send_type = sprintf(Sms::SMS_SEND_TYPE, $type, $mobile);
        if ($this->redis->exists($sms_send_type)) {
            $sms_ttl = $this->redis->ttl($sms_send_type);
            if (600 - intval($sms_ttl) < 60) {
                throw new ExtendDataException(['ttl' => 600 - intval($sms_ttl)], '请求频繁!', Code::ERROR);
            }
        }

        $template_code = $this->transformType($type);
        $sms_code = rand(10000, 99999);
        $flag = $this->Ali_sms($mobile, $template_code, $sms_code);

        if ($flag) {
            $array['ttl'] = 3;
            $array['sms_code'] = $sms_code;
            try {
                $this->redis->hMset($sms_send_type, $array);
                $this->redis->expire($sms_send_type, 600);

                $sms_day_risk = sprintf(Sms::SMS_DAY_RISK, $mobile);
                $this->redis->incrBy($sms_day_risk, 1);
                $this->redis->expire($sms_day_risk, 600);
            } catch (\Exception $e) {
                throw new SystemException($e->getMessage(), Code::SYSTEM_ERROR);
            }
        } else {
            throw new CustomException('请稍后重试');
        }
    }

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
            throw new CustomException("验证码失效,请重新获取");
        }

        if ($hashSmsData['sms_code'] != $sms_code) {
            //未超过3次 记录ttl--
            if ($hashSmsData['ttl'] > 0) {
                $this->redis->hIncrBy($sms_send_type_mobile, 'ttl', -1);
                throw new CustomException("验证码错误,还有" . ($hashSmsData['ttl'] - 1) . "次机会");
            } else {
                //试错3次 删除验证码
                $this->redis->delete($sms_send_type_mobile);
                throw new CustomException("输错3次,请重新获取验证码");
            }
        } else {
            //验证成功也删除验证码
            $this->redis->delete($sms_send_type_mobile);
        }

    }


    /**
     *
     * 阿里大鱼发送验证码
     * @access public
     * @param string $mobile
     * @param string $template_code
     * @param int $sms_code
     * @return bool
     *
     */
    public function Ali_sms(string $mobile, string $template_code, int $sms_code)
    {

        $config = config('alisms');

        $aliYunSms = new \Aliyun\Sms($config['AccessKeyID'], $config['AccessKeySecret']);
        $aliYunSms->setSignName($config['sign']);
        $aliYunSms->setTemplateCode($template_code);
        $res = $aliYunSms->send($mobile, ['code' => $sms_code]);
        if (isset($res) && $res->Code == 'OK') {
            $SmsRecord = new SmsRecord();
            $SmsRecord->setMobile($mobile)->setTemplateCode($template_code)
                ->setRequestId($res->RequestId)->setBizId($res->BizId)
                ->setIp(swoole_header('remote-host'))->setDate(date('Y-m-d H:i:s'))
                ->save();
        } else {
            return false;
        }
        return true;
    }

    private function transformType($type)
    {
        $config = config('alisms');
        switch ($type) {
            case Sms::LOGIN:
                $template_code = $config['template']['login'];
                break;  //账号登陆
            case Sms::REGISTER:
                $template_code = $config['template']['register'];
                break; //注册
//            case 3: $template_code = self::TEMPLATE_REG; break;    //修改密码
            case Sms::BINDING:
                $template_code = $config['template']['binding'];
                break;   //绑定
            case Sms::THIRD_BINDING:
                $template_code = $config['template']['binding'];
//                break;   //第三方绑定 短信一样 不验证手机号码是否存在
        }
        return $template_code;
    }

    /**
     * 风控
     * @param string $mobile |$ip 手机号|ip
     *
     * @return void
     * @throws CustomException
     */
    public function risk(string $mobile)
    {

        $key = sprintf(Sms::SMS_DAY_RISK, $mobile);
        // 不存在数据
        $dataCount = $this->redis->get($key);

        if ($dataCount && $dataCount > Sms::DAY_LIMIT) {
            throw new CustomException('手机短信发送次数超出当天限制');
        }

        if (empty($dataCount)) {
            $this->redis->incrBy($key, 1);
            $this->redis->expire($key, 600);
        } else {
            if ($dataCount < Sms::DAY_LIMIT) {
                $this->redis->incrBy($key, 1);
            } else {
                throw new CustomException('手机短信发送次数超出当天限制');
            }
        }
    }
}