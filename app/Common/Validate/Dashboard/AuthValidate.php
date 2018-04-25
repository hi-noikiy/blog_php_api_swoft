<?php

namespace App\Common\Validate\Dashboard;

use App\Models\Entity\User;
use think\Validate;

class AuthValidate extends Validate
{
    protected $rule = [
        'account'=>'require',
        'password'=>'require',
    ];

    protected $message = [
        'account.require' => '请输入账号',
        'password.require'=> '请输入密码',
    ];
    protected $scene = [
        'login' => ['account','password'],
    ];

    protected function checkUser($value,$rule,$data){

        $arr = User::findOne(['mobile'=>$data['account']])->getResult();
        var_dump(1);
        return true;
        var_dump(2);
        if($arr){
            $md5Password = md5(md5($data['password']).$arr['salt']);
            if($md5Password == $arr['password']){
                return $arr;
            }else{
                return '用户或密码错误';
            }
        }else{
            return '该用户不存在';
        }
    }
}