<?php
/**
 *
 * @author cpj
 * @date 2018/12/10
 */

namespace App\Common\Validate;


use App\Exception\ValidateException;
use think\Validate;

class BaseValidate extends Validate
{
    public function check($data, $rules = [], $scene = '')
    {
        var_dump($data);
        if (!parent::check($data, $rules, $scene)) {
            throw new ValidateException($this->getError());
        }
        return true;
    }
}