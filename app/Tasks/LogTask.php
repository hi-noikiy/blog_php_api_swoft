<?php

namespace App\Tasks;

use App\Models\Entity\SystemLog;
use App\Models\Entity\SystemTrace;
use Swoft\Task\Bean\Annotation\Task;
use Throwable;

/**
 * 全局错误拦截写入数据库
 * @Task("Log")
 */
class LogTask
{
    public function record(string $message, int $line, string $file, string $trace, array $request)
    {
        $systemlog = new SystemLog();
        $systrace = new SystemTrace();

        $insert = [
            'message' => $message,
            'file' => addslashes($file),
            'line' => $line,
        ];
        $insert = array_merge($insert, $request);

        $sl_id = $systemlog->fill($insert)->save()->getResult();
        $systrace->setSlId($sl_id);
        $systrace->setTrace($trace);
        $systrace->save();
    }
}