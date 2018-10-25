<?php

namespace App\Boot;

use App\Common\Enums\CityEnums;
use App\Models\Amqp;
use Swoft\App;
use Swoft\Process\Bean\Annotation\Process;
use Swoft\Process\Process as SwoftProcess;
use Swoft\Process\ProcessBuilder;
use Swoft\Process\ProcessInterface;
use Swoft\Redis\Redis;
use Swoft\Task\Task;

/**
 * Custom process
 *
 * @Process(boot=false)
 */
//class CitySpiderProcess implements ProcessInterface
//{
//    public function run(SwoftProcess $process)
//    {
//        /* @var Redis $redis */
//        $redis = App::getBean(Redis::class);
//
//        while ($data  = $redis->brPop([CityEnums::CITY_URL_LIST], 1)) {
//            $data = json_decode($data,true);
//            switch ($data['type']){
//                case
//            }
//        }
//    }
//
//    public function check(): bool
//    {
//        return true;
//    }
//
//    private function as(){
//
//    }
//}