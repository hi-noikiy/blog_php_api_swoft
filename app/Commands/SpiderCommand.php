<?php

namespace App\Commands;

use App\Common\Utility\Qiniu;
use App\Models\Entity\VirtualUser;
use App\Models\Logic\UserLogic;
use Sunra\PhpSimple\HtmlDomParser;
use Swoft\App;
use Swoft\Console\Bean\Annotation\Command;
use Swoft\Console\Bean\Annotation\Mapping;
use Swoft\Console\Input\Input;
use Swoft\Console\Output\Output;
use Swoft\Core\Coroutine;
use Swoft\HttpClient\Client;
use Swoft\Log\Log;
use Swoft\Process\ProcessBuilder;
use Swoft\Task\Task;

/**
 * Test command
 *
 * @Command(coroutine=false)
 */
class SpiderCommand
{

    /**
     * @Mapping()
     */
    public function task()
    {
        $qiniu = new Qiniu();

        try {
            $start_time = microtime(true);
            var_dump($start_time);
            $client = new Client([
                'base_uri' => 'https://www.qqtn.com/tx/',
                'adapter' => 'curl'
            ]);

            $virtualUser = new VirtualUser();
            $k = 0;
//            for ($i = 15; $i <= 54; $i++) {
                $content = $client->request('get', "qinglvtx_6.html")->getResponse()->getBody()->getContents();
                var_dump("weixintx_2.html");
                $dom = HtmlDomParser::str_get_html($content);

                $gxlist = $dom->find('.g-gxlist-imgbox', 0);

                foreach ($gxlist->find('li') as $item) {
                    foreach ($item->find('a') as $item2) {
                        var_dump($item2->href);
                        $article = $client->request('get', $item2->href)->getResult();

                        $dom = HtmlDomParser::str_get_html($article);
                        $inside_gxlist = $dom->find('#content', 0);
                        if($inside_gxlist){
                            foreach ($inside_gxlist->find('img') as $item3) {
                                $k++;
                                var_dump("投递第{$k}张图片\n");
                                Task::deliver('spider', 'avatar', [$item3->src, $qiniu, $virtualUser], Task::TYPE_ASYNC);
                            }
                        }
                    }
                }
//            }

            $end_time = microtime(true);
            $second = round($end_time - $start_time, 3);
            $memory = memory_get_usage();
        } catch (\Exception $exception) {
            var_dump($exception->getMessage());
        }
        var_dump($second, $memory);
    }
}