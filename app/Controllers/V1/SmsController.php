<?php
//
//namespace App\HttpController\V1;
//
//use App\Common\Code\Code;
//use App\Common\Controller\ApiController;
//use Flc\Alidayu\Client;
//use Flc\Alidayu\Requests\IRequest;
//
//
//
//class SmsController extends ApiController
//{
//
//    private $config;
//
//    public function onRequest($action):?bool
//    {
//
//        $this->config = Config::getInstance()->getConf('ALIDAYU');
//        return true;
//    }
//
//    public function send()
//    {
//
//        $validate = $this->validate('App\Common\Validate\SmsValidate.send');
//        if ($validate !== true) {
//            return $this->setStatusCode(Code::INVALID_PARAMETER)->respondWithError($validate);
//        }
//
//        $string = sprintf('BO_SMS:%d:%s', $this->data['type'], $this->data['mobile']);
//        if ($this->getRedisObject()->exec('EXISTS', $string)) {
//            $sms_ttl = $this->getRedisObject()->exec('TTL', $string);
//            if (600 - intval($sms_ttl) < 60) {
//                return $this->setStatusCode(Code::ERROR)->respondWithError('请求频繁!');
//            }
//        }
//        $this->risk($this->ip());
//        $this->risk($this->data['mobile']);
//        $template_code = $this->transformType($this->data['type']);
//        $sms_code = rand(10000, 99999);
//        $flag = $this->Ali_sms($this->data['mobile'], $template_code, $sms_code);
//
//        if ($flag) {
//            $array['ttl'] = 3;
//            $array['sms_code'] = $sms_code;
//            try {
//                $this->getRedisObject()->exec('HMSET', $string, $array);
//                $this->getRedisObject()->exec('EXPIRE', $string, 600);
//            } catch (\Exception $e) {
//                $this->onException($e, $this->getActionName());
//            }
//            return $this->respondWithArray(null, '短信发送成功');
//        }
//        return $this->setStatusCode(Code::ERROR)->respondWithError('请稍后重试');
//    }
//
//
//    private function Ali_sms($mobile, $template_code, $sms_code)
//    {
//        Client::configure($this->config);
//        $resp = Client::request('alibaba.aliqin.fc.sms.num.send', function (IRequest $req) use ($sms_code, $mobile, $template_code) {
//            $req->setRecNum($mobile)
//                ->setSmsParam([
//                    'code' => $sms_code
//                ])
//                ->setSmsFreeSignName('为伴')
//                ->setSmsTemplateCode($template_code);
//        });
//        if (!isset($resp->result)) {
//            return false;
//        }
//        if (isset($resp->result) && $resp->result->success) {
//            Db::name('sms_record')->insert(['mobile' => $mobile, 'template_code' => $template_code, 'request_id' => $resp->request_id, 'ip' => $this->ip(), 'date' => date('Y-m-d H:i:s', time())]);
//        }
//        return true;
//    }
//
//    private function transformType($type)
//    {
//        switch ($type) {
//            case 1:
//                $template_code = $this->config['template']['login'];
//                break;  //账号登陆
//            case 2:
//                $template_code = $this->config['template']['register'];
//                break; //注册
////            case 3: $template_code = self::TEMPLATE_REG; break;    //修改密码
//            case 4:
//                $template_code = $this->config['template']['binding'];
//                break;   //绑定
//            case 5:
//                $template_code = $this->config['template']['binding'];
//                break;   //第三方绑定 短信一样 不验证手机号码是否存在
//        }
//        return $template_code;
//    }
//
//    /**
//     * 风控
//     * @param $mobile
//     *
//     * @return bool
//     */
//    private function risk($mobile)
//    {
//
//        $key = sprintf('BO_SMS_RISK:%s', $mobile);
//        $limit = 10;
//        // 不存在数据
//        $dataCount = $this->getRedisObject()->exec('GET', $key);
//        if (empty($dataCount)) {
//            $this->getRedisObject()->exec('incrBy', $key, 1);
//            $this->getRedisObject()->exec('expire', $key, today_rest());
//        } else {
//            if ($dataCount < $limit) {
//                $this->getRedisObject()->exec('incrBy', $key, 1);
//            } else {
//                $this->setStatusCode(Code::SYSTEM_ERROR);
//                return '手机短信发送次数超出当天限制';
//            }
//        }
//
//        return true;
//    }
//
//
//}