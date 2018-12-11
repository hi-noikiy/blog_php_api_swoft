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
    public static function send(array $to, $subject, $body)
    {
        $config = config('mail');

        $mail = new DirectMail($config['AccessKeyID'], $config['AccessKeySecret']);
        $mail->send([
            'from' => '', // 发信地址 AccountName
            'to' => implode($to, ','), // 多个地址可用逗号分隔，最多100个
            'name' => '', // 发件人昵称  FromAlias
            'subject' => '这个是邮件的主题', // Subject
            'body' => 'test', // html or text
            'trace' => 1 // 是否开启数据追踪功能, 1 或 0
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