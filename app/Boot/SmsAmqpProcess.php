<?php

namespace App\Boot;

use App\Models\Amqp;
use Swoft\App;
use Swoft\Process\Bean\Annotation\Process;
use Swoft\Process\Process as SwoftProcess;
use Swoft\Process\ProcessBuilder;
use Swoft\Process\ProcessInterface;
use Swoft\Task\Task;
use  AMQPConnection;

/**
 * Custom process
 *
 * @Process(boot=false)
 */
class SmsAmqpProcess implements ProcessInterface
{
    public function run(SwoftProcess $process)
    {
        $channel = Amqp::getInstance()->channel();

        $channel->queue_declare('hello',false,false,false,false);

        $callback = function($msg) {
            echo " [x] Received sms-queue:", $msg->body, "\n";
        };

        //在接收消息的时候调用$callback函数
        $channel->basic_consume('sms', '', false, true, false, false, $callback);

        while(count($channel->callbacks)) {
            $channel->wait();
        }
    }

    public function check(): bool
    {
        return true;
    }
}