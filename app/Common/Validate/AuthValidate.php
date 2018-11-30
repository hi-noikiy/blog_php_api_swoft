<?php

namespace App\Common\Validate;

use App\Common\Enums\LoginTypeEnums;
use App\Models\Entity\Users;
use Swoft\App;
use SwoftTest\Db\Testing\Entity\User;
use think\Validate;
use think\validate\ValidateRule;


class AuthValidate extends Validate
{
    protected $rule = [
        'login_type' => 'require|between:1,2|login_validate',
        'mobile' => 'require|regex:/^1[34578]\d{9}$/',
        'sms_code' => 'require',
        'password' => 'require|length:6,20',
        'repassword' => 'require|confirm:password',
        'openid' => 'require',
        'type' => 'require|between:1,5',
        'refresh_token' => 'require'
    ];

    protected $message = [
        'mobile.require' => '手机号不能为空',
        'mobile.regex' => '手机号格式错误',
        'sms_code.require' => '请输入短信验证码',
        'repassword.require' => '请再输入一次密码',
        'repassword.confirm' => '两次密码不一致',
        'login_type.require' => '请选择登陆方式',
        'login_type.between' => '登陆方式不正确',
        'unionid.require' => 'unionid不能为空',
        'type.require' => 'oauth2类型不能为空',
    ];

    protected $scene = [
        'signin' => ['login_type'],
        'signup' => ['mobile', 'password', 'sms_code'],
        'forget' => ['mobile', 'password', 'repassword', 'sms_code'],
        'oauth2' => ['openid', 'type'],
        'oauth2_binding' => ['mobile', 'sms_code', 'openid', 'type'],
        'refresh' => ['refresh_token']
    ];

    public function login_validate($value, $rule, $data)
    {
        switch ($data['login_type']) {
            case LoginTypeEnums::PASSWORD:
                $rule = [
                    'mobile' => 'require',
                    'password' => 'require|length:6,20',
                ];
                $msg = [
                    'mobile.require' => '请输入手机号',
                    'password.require' => '请输入密码',
                    'password.length' => '密码长度在6-20位之内',
                ];
                break;
            case LoginTypeEnums::MOBILE_SMS:
                $rule = [
                    'mobile' => 'require',
                    'sms_code' => 'require',
                ];
                $msg = [
                    'mobile.require' => '请输入手机号',
                    'sms_code.require' => '请输入短信验证码',
                ];
                break;
        }
        $validate = Validate::make($rule, $msg);
        if (!$validate->check($data)) {
            return $validate->getError();
        }
        /* @var Users $user */
//        $user = App::getBean(Users::class);
        $user = Users::findOne(['mobile' => $data['mobile']])->getResult();
        if (!$user) {
            return '该账号还未注册';
        }

        return true;
    }

}