<?php

namespace App\Models\Services;

use App\Common\Code\Code;
use App\Common\Enums\SmsEnum;
use App\Common\Utility\Sms;
use App\Exception\CustomException;
use App\Exception\ExtendDataException;
use App\Exception\SystemException;
use App\Models\Dao\SmsRecordDao;
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

    /**
     *
     * @Inject()
     * @var SmsRecordDao
     */
    private $smsRecordDao;

    public function send(string $mobile, int $type): void
    {

        $sms_send_type = sprintf(SmsEnum::SMS_SEND_TYPE, $type, $mobile);
        if ($this->redis->exists($sms_send_type)) {
            $sms_ttl = $this->redis->ttl($sms_send_type);
            if (600 - intval($sms_ttl) < 60) {
                throw new ExtendDataException(['ttl' => 600 - intval($sms_ttl)], '请求频繁!', Code::ERROR);
            }
        }

        $template_code = Sms::transformType($type);
        $sms_code = rand(10000, 99999);

        $flag = Sms::send($mobile, $template_code, $sms_code);

        if ($flag) {
            $array['ttl'] = 3;
            $array['sms_code'] = $sms_code;
            try {
                $this->redis->hMset($sms_send_type, $array);
                $this->redis->expire($sms_send_type, 600);
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
        $sms_send_type_mobile = sprintf(SmsEnum::SMS_SEND_TYPE, $type, $mobile);
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
     * 风控
     * @param string $mobile |$ip 手机号|ip
     *
     * @return void
     * @throws CustomException
     */
    public function risk(string $mobile)
    {

        $key = sprintf(SmsEnum::SMS_DAY_RISK, $mobile);
        // 不存在数据
        $dataCount = $this->redis->get($key);

        if ($dataCount && $dataCount > SmsEnum::DAY_LIMIT) {
            throw new CustomException('手机短信发送次数超出当天限制');
        }

        if (empty($dataCount)) {
            $this->redis->incrBy($key, 1);
            $this->redis->expire($key, 600);
        } else {
            if ($dataCount < SmsEnum::DAY_LIMIT) {
                $this->redis->incrBy($key, 1);
            } else {
                throw new CustomException('手机短信发送次数超出当天限制');
            }
        }
    }

    /**
     *
     * 短信发送记录
     * @access public
     * @param string $mobile 手机号
     * @param string $template_code 模板id
     * @param string $request_id 状态码-返回OK代表请求成功,其他错误码详见错误码列表
     * @param string $biz_id 发送回执ID,可根据该ID查询具体的发送状态
     * @return void
     *
     */
    public function record(string $mobile, string $template_code, string $request_id, string $biz_id)
    {
        $ip = \Swoft::ip();
        $data = compact('mobile', 'template_code', 'request_id', 'biz_id', 'ip');
        $this->smsRecordDao->create($data);
    }

    public function notifyUpdate()
    {

    }


}