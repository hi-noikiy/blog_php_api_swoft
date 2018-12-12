<?php

namespace App\Models\Dao;


use App\Models\Entity\OperatorLog;
use Swoft\Bean\Annotation\Bean;

/**
 * @Bean()
 */
class OperatorLogDao
{
    public function create(array $arr)
    {
        $article = new OperatorLog();
        $article->fill($arr)->save();
    }

}