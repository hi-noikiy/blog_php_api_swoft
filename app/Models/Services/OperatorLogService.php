<?php
/**
 *
 * @author cpj
 * @date 2018/12/10
 */

namespace App\Models\Services;

use App\Models\Data\OperatorLogData;
use Swoft\Bean\Annotation\Bean;
use Swoft\Bean\Annotation\Inject;

/**
 * @Bean()
 */
class OperatorLogService
{
    /**
     *
     * @Inject()
     * @var OperatorLogData
     */
    private $operatorLodData;

    public function write(array $arr)
    {
        $this->operatorLodData->writeToMysql($arr);
    }
}