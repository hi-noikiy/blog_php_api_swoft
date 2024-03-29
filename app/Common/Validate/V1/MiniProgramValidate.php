<?php
/**
 *
 * @author cpj
 * @date 2018/12/17
 */

namespace App\Common\Validate\V1;


use App\Common\Validate\BaseValidate;

class MiniProgramValidate extends BaseValidate
{
    protected $rule = [
        'code' => 'require',
        'iv' => 'require',
        'encryptedData' => 'require'
    ];

    protected $message = [
    ];

    protected $scene = [
        'login' => ['code'],
        'signin' => ['code', 'iv', 'encryptedData']
    ];
}