<?php

namespace App\Models\Entity;


use Swoft\Db\Model;

class BaseModel extends Model
{
    /**
     * 进行分页查询
     *
     * @param array $condition
     * @param array $options
     * @param int $page
     * @param int $limit
     *
     * @return array
     */
    public static function getPageList($condition = [], $options = [], $page = 1, $limit = 10)
    {
        // 初始化变量
        $data = [];

        $page = $page > 0 ? $page : 1;
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
}