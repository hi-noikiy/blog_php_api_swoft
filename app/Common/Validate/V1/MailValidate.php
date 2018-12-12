<?php
/**
 *
 * @author cpj
 * @date 2018/12/12
 */

namespace App\Common\Validate\V1;


use App\Common\Enums\MailEnum;
use App\Common\Enums\SmsEnum;
use App\Models\Dao\UserDao;
use Swoft\App;
use think\Validate;


class SmsValidate extends Validate
{
    protected $rule = [
        'type' => 'require|between:2,4|number',
        'mail' => 'require|regex:/^1[34758]{1}\d{9}$/|check_mail',
    ];

    protected $message = [
        'mail.require' => '请输入邮箱',
        'mobile.regex' => '请填写正确的邮箱地址',
        'type.require' => '请输入发送类型',
        'type.between' => '请输入正确的发送类型',
    ];
    protected $scene = [
        'send' => ['type', 'mail'],
    ];

    protected function check_mail($value, $rule, $data)
    {

        /* @var UserDao $userDao */
        $userDao = App::getBean(UserDao::class);
        $arr = $userDao->getInfoByMail($data['mobile']);

        if ($data['type'] == MailEnum::REGISTER && $arr) {
            return '您已经注册过了';
        }

        if ($data['type'] == MailEnum::BINDING && $arr) {
            return '该邮箱已经被绑定过了';
        }

        if ($data['type'] == MailEnum::MODIFY && !$arr) {
            return '该账号不存在';
        }

        return true;
    }
}