<?php

namespace App\Common\Enums;


class SmsEnum
{
    const LOGIN = 1;
    const REGISTER = 2;
    const MODIFY = 3;
    const BINDING = 4;
    const THIRD_BINDING = 4;


    const SMS_SEND_TYPE = 'SMS:%d:%s';
    const SMS_DAY_RISK = 'SMS_DAY_RISK:%s';
    const SMS_HOUR_RISK = 'SMS_HOUR_RISK:%s';


    const MIN_LIMIT = 1;
    const HOUR_LIMIT = 5;
    const DAY_LIMIT = 10;
}