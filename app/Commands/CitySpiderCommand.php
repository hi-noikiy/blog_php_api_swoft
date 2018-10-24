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

            $gxlist = $dom->find('.provincetr',3);


            foreach ($gxlist->find('a') as $item) {
                $city_href = $item->href;
                $city_name = characet(strip_tags($item->innertext()));
                var_dump($city_name);
                Task::deliver('citySpider', 'city', [$city_href, $city_name, $client]);
            }

            return;


//            $city_href = "61.html";
//            $city_name = "陕西test";
//            Task::deliver('citySpider', 'city', [$city_href, $city_name, $client]);
            $gxlist = $dom->find('.provincetr');

            foreach ($gxlist as $key => $elements) {
//                var_dump($key);
                if ($key == 1) {
                    var_dump($elements);
                    foreach ($elements->find('a') as $item) {
                        $city_href = $item->href;
                        $city_name = characet(strip_tags($item->innertext()));
                        var_dump($city_name);
//                        Task::deliver('citySpider', 'city', [$city_href, $city_name, $client]);
                    }
                }
                break;
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