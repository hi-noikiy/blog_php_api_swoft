<?php
/**
 * This file is part of Swoft.
 *
 * @link https://swoft.org
 * @document https://doc.swoft.org
 * @contact group@swoft.org
 * @license https://github.com/swoft-cloud/swoft/blob/master/LICENSE
 */

namespace App\Process;

use Swoft\App;
use Swoft\Core\Coroutine;
use Swoft\Process\Bean\Annotation\Process;
use Swoft\Process\Process as SwoftProcess;
use Swoft\Process\ProcessInterface;
use Swoft\Bean\Annotation\Inject;

/**
 * Custom process
 *
 * @Process(name="customProcess", coroutine=false)
 */
class MyProcess implements ProcessInterface
{
    /**
     * @Inject("demoRedis")
     * @var \Swoft\Redis\Redis
     */
    protected $redis;

    public function run(SwoftProcess $process)
    {
        var_dump(1);
        var_dump($this->redis->keys('*'));
        $this->redis->subscribe(['test'],function($instance, $channelName, $message){
            var_dump($message);
        });
        $pname = App::$server->getPname();
        $processName = "$pname myProcess process";
        $process->name($processName);
var_dump($pname);
        echo "Custom child process \n";
        var_dump(Coroutine::id());
    }

    public function check(): bool
    {
        return true;
    }
}