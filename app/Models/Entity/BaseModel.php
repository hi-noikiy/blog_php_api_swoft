<?php

namespace App\Models\Entity;


use Swoft\Core\ResultInterface;
use Swoft\Db\Model;

class BaseModel extends Model
{
    protected $condition;

    protected $options;

    public function save(): ResultInterface
    {
        if (method_exists($this, 'setcreatedAt')) {
            $this->setcreatedAt(date('Y-m-d H:i:s'));
        }
        if (method_exists($this, 'setupdatedAt')) {
            $this->setupdatedAt(date('Y-m-d H:i:s'));
        }
        return parent::save(); // TODO: Change the autogenerated stub
    }

    public function update(): ResultInterface
    {
        if (method_exists($this, 'setupdatedAt')) {
            $this->setupdatedAt(date('Y-m-d H:i:s'));
        }
        return parent::update(); // TODO: Change the autogenerated stub
    }

    /**
     * 进行分页查询
     *
     * @param array $condition 查找条件，数组
     * @param array $options  额外选项。 如： orderby limit offset
     *
     * @return array
     */
    public static function getPageList($condition = [], $options = [])
    {
        // 初始化变量
        $data = [];

        $page = \Swoft::param('page', 1);
        $limit = \Swoft::param('limit', 20);
        $page = $page > 0 ? $page : 1;
        $limit = $limit > 0 ? $limit : 20;
        // 进行list查询
        $data['list'] = self::findAll($condition,
            array_merge($options, [
                'limit' => $limit,
                'offset' => ($page - 1) * $limit
            ])
        )->getResult();

        // 判断是否为object
        $data['list'] = is_object($data['list']) ? $data['list']->toArray() : [];
        // 进行count查询
        $data['count'] = (int)self::count('*', $condition)->getResult();
        // 增加总页数
        $data['totalPage'] = bcdiv($data['count'], $limit, 0) + ($data['count'] % $limit == 0 ? 0 : 1);
        // 返回数据
        return $data;
    }

    protected function getCondition()
    {
        return $this->condition;
    }

    protected function setCondition(array $condition = [])
    {
        $this->condition = $condition;
        return $this;
    }
}