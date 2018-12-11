<?php
/**
 *
 * @author cpj
 * @date 2018/12/11
 */

namespace App\Models\Dao;


use App\Models\Entity\SmsRecord;
use Swoft\Bean\Annotation\Bean;

/**
 * @Bean()
 */
class SmsRecordDao
{
    public function create(array $arr)
    {
        $smsRecord = new SmsRecord();
        $smsRecord->fill($arr)->save();
    }
}