<?php

namespace App\Common\Factory;

use App\Common\Enums\LoginTypeEnums;
use Swoft\App;
use App\Models\Services\AuthServices\SmsCodeAuthService;
use App\Models\Services\AuthServices\PasswordAuthService;

class AuthFactory
{
    public static function getService(int $login_type)
    {

        switch ($login_type) {
            case LoginTypeEnums::PASSWORD:
                return App::getBean(PasswordAuthService::class);
                break;
            case LoginTypeEnums::MOBILE_SMS:
                return App::getBean(SmsCodeAuthService::class);
                break;
        }

    }
}