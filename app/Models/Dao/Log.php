<?php

namespace App\Models\Dao;

use App\Models\Entity\SystemLog;
use App\Models\Entity\SystemTrace;
use Swoft\Bean\Annotation\Bean;
use Swoft\Db\QueryBuilder;

/**
 * @Bean()
 */
class Log
{
    public function list()
    {
        return SystemLog::getPageList(
            [],
            ['orderby' => ['sl_id' => QueryBuilder::ORDER_BY_DESC]]);
    }

    public function trace($id)
    {
        return SystemTrace::findOne(['sl_id'=>$id])->getResult();
    }

}