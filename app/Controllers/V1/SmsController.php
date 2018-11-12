<?php

namespace App\Controllers\V1;

use App\Common\Enums\Sms;
use App\Common\Validate\SmsValidate;
use App\Models\Entity\SmsRecord;
use Swoft\Http\Server\Bean\Annotation\Controller;
use Swoft\Http\Server\Bean\Annotation\RequestMapping;
use Swoft\Http\Server\Bean\Annotation\RequestMethod;
use Swoft\Http\Message\Bean\Annotation\Middleware;
use App\Middlewares\SignMiddleware;
use App\Common\Code\Code;
use App\Common\Controller\ApiController;
use Swoft\Http\Message\Server\Request;
use Exception;

/**
 * @Controller(prefix="/v1/sms")
 * @Middleware(SignMiddleware::class)
 */
class SmsController extends ApiController
{


    /**
     * @RequestMapping(route="send", method=RequestMethod::POST)
     * @param Request $request
     * @return string
     * @throws Exception
     */
    public function send(Request $request)
    {
        /* @var SmsValidate */
        $this->validate('App\Common\Validate\SmsValidate.send');
        $type = $request->input('type');
        $mobile = $request->input('mobile');

        $sms_send_type = sprintf(Sms::SMS_SEND_TYPE, $type, $mobile);
        if (redis()->exists($sms_send_type)) {
            $sms_ttl = redis()->ttl($sms_send_type);
            if (600 - intval($sms_ttl) < 60) {
                return $this->setStatusCode(Code::ERROR)->respondWithArray(['ttl' => 600 - intval($sms_ttl)], '请求频繁!');
            }
        }
        $this->risk(swoole_header('remote-host'));
        $this->risk($mobile);
        $template_code = $this->transformType($type);
        $sms_code = rand(10000, 99999);
        $flag = $this->Ali_sms($mobile, $template_code, $sms_code);

        if ($flag) {
            $array['ttl'] = 3;
            $array['sms_code'] = $sms_code;
            try {
                redis()->hMset($sms_send_type, $array);
                redis()->expire($sms_send_type, 600);

                $sms_day_risk = sprintf(Sms::SMS_DAY_RISK, $mobile);
                redis()->incrBy($sms_day_risk, 1);
                redis()->expire($sms_day_risk, 600);
            } catch (Exception $e) {
                throw new Exception($e->getMessage(), Code::SYSTEM_ERROR);
            }
            return $this->respondWithArray(null, '短信发送成功');
        }
        return $this->setStatusCode(Code::ERROR)->respondWithError('请稍后重试');
    }

    /**
     * @RequestMapping(route="notify", method={RequestMethod::GET,RequestMethod::POST})
     * @param Request $request
     * @return array
     * @throws Exception
     */
    public function notify(Request $request)
    {

        $res = json_decode($request->raw(), true);

        if ($res) {
            foreach ($res as $item) {
                SmsRecord::updateOne([
                    'send_time' => $item['send_time'],
                    'report_time' => $item['report_time'],
                    'err_msg' => $item['err_msg'],
                    'status' => $item['success'] ? 1 : 2
                ], ['biz_id' => $item['biz_id']]);
            }
        }

        return ['code' => 0, 'msg' => '接受成功'];
    }


    private function Ali_sms($mobile, $template_code, $sms_code)
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
                break;   //第三方绑定 短信一样 不验证手机号码是否存在
            default:
                break;
        }
        return $template_code;
    }

    /**
     * 风控
     * @param string $mobile |$ip 手机号|ip
     *
     * @return void
     * @throws Exception
     */
    private function risk(string $mobile)
    {

        $key = sprintf(Sms::SMS_DAY_RISK, $mobile);
        // 不存在数据
        $dataCount = redis()->get($key);

        if ($dataCount && $dataCount > Sms::DAY_LIMIT) {
            throw new Exception('手机短信发送次数超出当天限制', Code::SYSTEM_ERROR);
        }

//        if (empty($dataCount)) {
//            redis()->incrBy($key, 1);
//            redis()->expireAt($key, time() + 600);
//        } else {
//            if ($dataCount < Sms::DAY_LIMIT) {
//                redis()->incrBy($key, 1);
//            } else {
//                throw new Exception('手机短信发送次数超出当天限制', Code::SYSTEM_ERROR);
//            }
//        }
    }
}