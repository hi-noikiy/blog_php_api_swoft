<?php
namespace App\Common\Validate;

use App\Common\Model\Users;
use think\Validate;

class GeetestValidate extends Validate
{
    protected $rule = [
        'account'=>'require|admin_validate',
    ];

    protected $scene = [
        'start'=>['account'],
    ];

    function admin_validate($value,$rule,$data){
        (new Users())->findUser($value);
        return true;
    }
}