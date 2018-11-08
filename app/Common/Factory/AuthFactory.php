<?php
/**
 * Created by PhpStorm.
 * User: losingbattle
 * Date: 2018/11/8
 * Time: 18:18
 */

namespace App\Common\Factory;


use App\Common\Enums\LoginTypeEnums;
use Swoft\App;

class AuthFactory
{
    public function getService(int $login_type){

        switch ($login_type){
            case LoginTypeEnums::PASSWORD:
                return App::getBean();
                break;
            case LoginTypeEnums::MOBILE_SMS:
                return App::getBean();
                break;
        }
        App::getBean()
    }
}