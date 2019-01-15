<?php

namespace App\Common\Enums;


class SourceEnums
{
    const PC = 1;     //pc端浏览器
    const MOBILE = 2; //移动端浏览器
    const WECHAT = 3; //微信浏览器
    const MINIPROGRAM = 4;//微信小程序
    const UNKNOWN = 5; //未知来源 postman等接口调试
}