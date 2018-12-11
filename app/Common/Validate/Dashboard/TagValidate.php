<?php
/**
 *
 * @author cpj
 * @date 2018/12/10
 */

namespace App\Common\Validate\Dashboard;

use App\Common\Validate\BaseValidate;

class TagValidate extends BaseValidate
{
    protected $rule = [
        'id' => 'require|number',
        'tag_name' => 'require',
        'sort' => 'number',
    ];

    protected $message = [
        'tag_name.require' => '请输入标签名称',
    ];

    protected $scene = [
        'create' => ['tag_name', 'sort'],
        'update' => ['id', 'tag_name', 'sort'],
        'delete' => ['id']
    ];

//    public function sceneupdate()
//    {
//        return $this->remove('tag_name', 'require')
//            ->remove('sort', 'require');
//    }
}