<?php

namespace App\Common\Validate\Dashboard;

use App\Common\Model\Users;
use EasySwoole\Core\Component\Logger;
use EasySwoole\Core\Http\Request;
use EasySwoole\Core\Http\Response;
use think\Validate;

class AuthValidate extends Validate
{
    protected $rule = [
        'account'=>'require',
        'password'=>'require',
        'challenge'=>'require',
        'validate'=>'require',
        'seccode'=>'requires'
    ];

    protected $message = [
        'account.require' => '请输入账号',
        'password.require'=> '请输入密码',
    ];
    protected $scene = [
        'signin' => ['account','password'],
    ];

}