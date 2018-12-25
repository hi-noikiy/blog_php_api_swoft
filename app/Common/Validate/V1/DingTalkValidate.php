<?php
/**
 *
 * @author cpj
 * @date 2018/12/12
 */

namespace App\Common\Validate\V1;


use App\Common\Enums\MailEnum;
use App\Common\Enums\SmsEnum;
use App\Common\Validate\BaseValidate;
use App\Models\Dao\UserDao;
use Swoft\App;
use think\Validate;


class DingTalkValidate extends BaseValidate
{
    protected $rule = [
        'encrypt' => 'require',
        'signature' => 'require',
        'timestamp'=>'require',
        'nonce'=>'require',
    ];

    protected $scene = [
        'callback' => ['encrypt', 'signature','timestamp','nonce'],
    ];
}