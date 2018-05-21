<?php

namespace App\Models\Dao;

use App\Models\Entity\SystemLog;
use Swoft\Bean\Annotation\Bean;
use Swoft\Db\QueryBuilder;

/**
 * @Bean()
 */
class Log
{
    public function list(int $page, int $limit)
    {

        return [
            'item' => SystemLog::query()->orderBy('record_time', QueryBuilder::ORDER_BY_DESC)->limit($limit,page($page,$limit))->get()->getResult(),
            'count' => (int)SystemLog::query()->count()->getResult(),
            'pagecount' => ceil((int)SystemLog::query()->count()->getResult() / $limit),
        ];
    }

}