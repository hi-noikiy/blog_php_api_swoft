<?php

namespace App\Common\Validate;

use think\Validate;


class AuthValidate extends Validate
{
    protected $rule = [
        'login_type' => 'require|between:1,2',
        'mobile' => 'require',
        'sms_code' => 'require',
        'password' => 'require|length:6,20',
        'repassword' => 'require|confirm:password',
        'openid' => 'require',
        'type' => 'require|between:1,5',
    ];

    protected $message = [
        'mobile.require' => '请输入用户名或手机号码',
        'password.require' => '请输入密码',
        'password.length' => '密码长度在6-20位之内',
        'repassword.require' => '请再输入一次密码',
        'repassword.confirm' => '两次密码不一致',
        'sms_code.require' => '请输入短信验证码',
        'login_type.require' => '请选择登陆方式',
        'login_type.between' => '登陆方式不正确',
        'unionid.require' => 'unionid不能为空',
        'type.require' => 'oauth2类型不能为空'
    ];
    protected $scene = [
        'signup' => ['mobile', 'password', 'sms_code'],
        'signin_first' => ['login_type'],
        'password_signin' => ['mobile', 'password'],
        'sms_code_signin' => ['mobile', 'sms_code'],
        'forget' => ['mobile', 'password', 'repassword', 'sms_code'],
        'oauth2' => ['openid', 'type'],
        'oauth2_binding' => ['mobile', 'sms_code', 'openid', 'type']
    ];

}