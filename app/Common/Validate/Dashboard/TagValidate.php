<?php
/**
 *
 * @author cpj
 * @date 2018/12/10
 */

namespace App\Common\Validate\Dashboard;


use think\Validate;

class TagValidate extends Validate
{
    protected $rule = [
        'tag_name' => 'require',
        'sort' => 'require|number',
    ];

    protected $message = [
        'tag_name.require' => '请输入标签名称',
    ];


    public function sceneUpdate()
    {
        return $this->only(['tag_name', 'sort'])
            ->remove('tag_name', 'require')
            ->remove('sort', 'require');
    }
}