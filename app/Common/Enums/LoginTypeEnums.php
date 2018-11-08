<?php

namespace App\Common\Enums;


class LoginTypeEnums
{
    const PASSWORD = 1;//密码登录
    const MOBILE_SMS = 2;//手机验证码登录
    const WECHAT = 3;//微信
    const WEIBO = 4;//微博
    const ALIPAY = 5;//支付宝
}