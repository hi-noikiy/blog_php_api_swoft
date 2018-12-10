<?php
/**
 *
 * @author cpj
 * @date 2018/12/10
 */

namespace App\Models\Services;

use App\Models\Entity\OperatorLog;
use Swoft\Bean\Annotation\Bean;

/**
 * @Bean()
 */
class OperatorLogService
{
    public function write(array $arr)
    {
        $operatorLog = new OperatorLog();
        $operatorLog->fill($arr)->save();
    }
}