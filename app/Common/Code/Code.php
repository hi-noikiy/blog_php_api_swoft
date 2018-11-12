<?php

namespace App\Common\Code;

class Code
{
    const SYSTEM_ERROR = -1; //系统错误
    const EMPTY_ERROR = -2; //返回值为空
    const ERROR_NO_DEFINED = 411; //未定义的错误类型
    const SUCCESS = 200; //请求成功
    const ERROR = 400; //失败
    const ERROR_NOT_FOUND = 404; //找不到该数据
    const ERROR_NO_AUTH = 1000; //签名失败
    const EMPTY_PARAMETER = 450;
    const UNLOGIN = 2001; //未登录
    const INVALID_PARAMETER = 2002; //不合法的参数,缺少参数
    const INVALID_REQUEST = 2003; //不合法的请求格式
    const INVALID_TOKEN = 2004; //access_token不存在||access_token和refresh_token都已经失效
    const REFRESH_TOKEN = 2005;//access_token失效,refresh_token未失效|刷新access_token值标识符
    const CHECK_CODE_ERROR = 2006; //验证码错误
    const UN_REGISTERED = 2007; //未注册
    const INVALID_SIGN = 2008;//不合法的签名
    const REGISTERED = 2009; //已注册，直接登录
    const REDIRECT = 2010; //前端路由重定向标识符
    const ACCOUNT_SYSTEM = 2018;//系统账号
    const ACCOUNT_BAD = 2019;//账号异常
    const BEYOND_LIMIT = 2020; //超过上限
    const PAYMENT_ERROR = 2030;//支付失败
    const AUTH_FALSE = 0; //未认证
    const AUTH_TURE = 1; //已认证
    const PAY_DONE = 2040;
    const ttl = 2592000; /*-一个月的秒数*/

    const LOGIN = 1;
    const REGISTER = 2;
    const BIND = 3;
}