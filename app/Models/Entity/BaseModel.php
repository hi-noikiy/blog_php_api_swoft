<?php

namespace App\Models\Entity;


use Swoft\Db\Model;

class BaseModel extends Model
{
    /**
     * 进行分页查询
     *
     * @param array $where
     * @param int $page
     * @param int $limit
     * @param string $order
     *
     * @return array
     */
    public static function getPageList($where = [], $order = 'DESC', $page = 1, $limit = 10)
    {
        // 初始化变量
        $data = [];


        // 进行list查询
        $data['list'] = self::findAll(array_merge($where, [
            'limit' => [$limit, ($page - 1) * $limit],
            'order' => $order,
        ]));

        // 判断是否为object
        $data['list'] = is_object($data['list']) ? $data['list']->toArray() : [];
        // 进行count查询
        $data['count'] = self::count($where);
        // 增加总页数
        $data['totalPage'] = bcdiv($data['count'], $limit, 0) + ($data['count'] % $limit == 0 ? 0 : 1);
        // 返回数据
        return $data;
    }
}