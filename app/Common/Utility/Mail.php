<?php
/**
 *
 * @author cpj
 * @date 2018/12/11
 */

namespace App\Common\Utility;


use Draguo\DirectMail\DirectMail;

class Mail
{
    /**
     *
     *
     * @access public
     * @param array $to 目标地址，多个 email 地址可以用逗号分隔，最多100个地址。
     * @param string $subject 邮件主题，建议填写。
     * @param string $body 邮件 html 正文，限制28K。
     * @param String $trace 取值范围 0~1: 1 为打开数据跟踪功能; 0 为关闭数据跟踪功能。该参数默认值为 0。
     * @return string
     *
     */
    public static function send(array $to, string $subject = '', string $body = '', string $trace = '1')
    {
        $config = config('mail');

        $mail = new DirectMail($config['AccessKeyID'], $config['AccessKeySecret']);
        return $mail->send([
            'from' => $config['SendMail'], // 发信地址 AccountName
            'to' => implode($to, ','), // 多个地址可用逗号分隔，最多100个
            'name' => '你猜', // 发件人昵称  FromAlias
            'subject' => 'test', // Subject
            'body' => 'test', // html or text
            'trace' => $trace // 是否开启数据追踪功能, 1 或 0
        ]);
    }


    public static function transformType($type)
    {
//        $config = config('alisms');
//        switch ($type) {
//            case SmsEnum::LOGIN:
//                $template_code = $config['template']['login'];
//                break;  //账号登陆
//            case SmsEnum::REGISTER:
//                $template_code = $config['template']['register'];
//                break; //注册
////            case 3: $template_code = self::TEMPLATE_REG; break;    //修改密码
//            case SmsEnum::BINDING:
//                $template_code = $config['template']['binding'];
//                break;   //绑定
//            case SmsEnum::THIRD_BINDING:
//                $template_code = $config['template']['binding'];
////                break;   //第三方绑定 短信一样 不验证手机号码是否存在
//        }
//        return $template_code;
    }
}