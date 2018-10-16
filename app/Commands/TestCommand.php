<?php
/**
 * This file is part of Swoft.
 *
 * @link https://swoft.org
 * @document https://doc.swoft.org
 * @contact group@swoft.org
 * @license https://github.com/swoft-cloud/swoft/blob/master/LICENSE
 */

namespace App\Commands;

use App\Models\Logic\UserLogic;
use Swoft\App;
use Swoft\Console\Bean\Annotation\Command;
use Swoft\Console\Bean\Annotation\Mapping;
use Swoft\Console\Input\Input;
use Swoft\Console\Output\Output;
use Swoft\Core\Coroutine;
use Swoft\Log\Log;
use Swoft\Task\Task;

/**
 * Test command
 *
 * @Command(coroutine=false)
 */
class TestCommand
{
    /**
     * this test command
     *
     * @Usage
     * test:{command} [arguments] [options]
     *
     * @Options
     * -o,--o this is command option
     *
     * @Arguments
     * arg this is argument
     *
     * @Example
     * php swoft test:test arg=stelin -o opt
     *
     * @param Input  $input
     * @param Output $output
     *
     * @Mapping("test2")
     */
    public function test(Input $input, Output $output)
    {

        $arr = [-1, 0, 1, 2, -1, -4];
        $count  = count($arr);
        if($count < 3){
            return;
        }
        $new_arr =  [];
        for($i=0;$i<$count-2;$i++){
            array_push($new_arr,[$i,$i+1,$i+2]);
        }
        var_dump($new_arr);
        return ;
    }

    /**
     * this demo command
     *
     * @Usage
     * test:{command} [arguments] [options]
     *
     * @Options
     * -o,--o this is command option
     *
     * @Arguments
     * arg this is argument
     *
     * @Example
     * php swoft test:demo arg=stelin -o opt
     *
     * @Mapping()
     */
    public function demo()
    {
        $hasOpt = input()->hasOpt('o');
        $opt    = input()->getOpt('o');
        $name   = input()->getArg('arg', 'swoft');

        App::trace('this is command log');
        Log::info('this is comamnd info log');
        /* @var UserLogic $logic */
        $logic = App::getBean(UserLogic::class);
        $data  = $logic->getUserInfo(['uid1']);
        var_dump($hasOpt, $opt, $name, $data);
    }

    /**
     * this task command
     *
     * @Usage
     * test:{command} [arguments] [options]
     *
     * @Options
     * -o,--o this is command option
     *
     * @Arguments
     * arg this is argument
     *
     * @Example
     * php swoft test:task
     *
     * @Mapping()
     */
    public function task()
    {
        var_dump(123);
        $result = Task::deliver('sync', 'console', ['console'],Task::TYPE_ASYNC);
        var_dump($result);
    }
}