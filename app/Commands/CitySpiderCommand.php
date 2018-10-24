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
 * 爬取省市区街道
 *
 * @Command(coroutine=false)
 */
class CitySpiderCommand
{

    /**
     * @Mapping("city")
     */
    public function city()
    {
        try {
            $start_time = microtime(true);
            var_dump($start_time);
            $client = new Client([
                'base_uri' => 'http://www.stats.gov.cn/tjsj/tjbz/tjyqhdmhcxhfdm/2017/',
                'adapter' => 'curl'
            ]);

            $content = $client->request('get', "index.html")->getResponse()->getBody()->getContents();
            $dom = HtmlDomParser::str_get_html($content, true, true, 'gbk');

            $gxlist = $dom->find('.provincetr', 0);


            foreach ($gxlist->find('a') as $item) {
                $city_href = $item->href;
                $city_name = characet(strip_tags($item->innertext()));
                Task::deliver('citySpider', 'city', [$city_href, $city_name, $client]);
            }

            $end_time = microtime(true);
            $second = round($end_time - $start_time, 3);
            $memory = memory_get_usage();
        } catch (\Exception $exception) {
            var_dump($exception->getMessage());
        }
        var_dump($second, $memory);
    }
}