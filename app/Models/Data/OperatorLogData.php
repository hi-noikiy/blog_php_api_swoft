<?php

namespace App\Models\Data;

use App\Models\Dao\OperatorLogDao;
use Swoft\Bean\Annotation\Bean;
use Swoft\Bean\Annotation\Inject;

/**
 * @Bean()
 */
class OperatorLogData
{

    /**
     *
     * @Inject()
     * @var OperatorLogDao
     */
    private $operatorLogDao;

    public function writeToQueue(array $arr)
    {

    }

    public function writeToMysql(array $arr)
    {
        $this->operatorLogDao->create($arr);
    }

}