<?php

namespace App\Commands;

use App\Common\Enums\CityEnums;
use App\Common\Utility\Qiniu;
use App\Models\Entity\PsAreaAli;
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
use Swoft\HttpClient\Exception\RuntimeException;
use Swoft\Log\Log;
use Swoft\Process\ProcessBuilder;
use Swoft\Redis\Redis;
use Swoft\Task\Task;

/**
 * 爬取省市区街道
 *
 * @Command(coroutine=false)
 */
class CitySpiderCommand
{
    private $data = [];
    const ONCE_TIME = 'ONCE_TIME';
    const ONCE_BEGIN_TIME = 'ONCE_BEGIN_TIME';
    const HASH_CITY_ONCE_TIME = 'HASH_CITY_ONCE_TIME';
    const HASH_CITY_ONCE_COUNT = 'HASH_CITY_ONCE_COUNT';

    /**
     * @Mapping("city")
     */
    public function city()
    {
        /* @var Redis $cache */
        $cache = App::getBean(Redis::class);
        try {
            $start_time = microtime(true);
            $cache->set('START_TIME', $start_time);
            var_dump("开始时间:" . $start_time);
            $client = new Client([
                'base_uri' => 'http://www.stats.gov.cn/tjsj/tjbz/tjyqhdmhcxhfdm/2017/',
                'adapter' => 'curl',
                'timeout' => 5
            ]);
            $content = $client->request('get', "index.html")->getResponse()->getBody()->getContents();
            $dom = HtmlDomParser::str_get_html($content, true, true, 'gbk');

//            $gxlist = $dom->find('.provincetr',3);


//            foreach ($gxlist->find('a') as $item) {
//                $city_href = $item->href;
//                $city_name = characet(strip_tags($item->innertext()));
//                $this->cityS($city_href,$city_name,$client);
////                sleep(1);
////                var_dump($city_name);
////                Task::deliver('citySpider', 'city', [$city_href, $city_name, $client]);
//            }

//            return;
//
//            $city_href = "51.html";
//            $city_name = "四川省";
////            $this->cityS($city_href,$city_name,$client);
//            Task::deliver('citySpider', 'city', [$city_href, $city_name, $client]);
//            return;


//            $city_href = "44/4419.html";
//            $areaParentId = "441900000000";
////            $this->cityS($city_href,$city_name,$client);
//            Task::deliver('citySpider', 'district', [$city_href, $areaParentId, $client]);
//            return;

            $gxlist = $dom->find('.provincetr');

            foreach ($gxlist as $key => $elements) {
//                var_dump($elements);
                foreach ($elements->find('a') as $item) {
                    $city_href = $item->href;
                    $city_name = characet(strip_tags($item->innertext()));
                    Task::deliver('citySpider', 'city', [$city_href, $city_name, $client]);
                }
            }

            $end_time = microtime(true);
            $second = round($end_time - $start_time, 3);
            $memory = memory_get_usage();
        } catch (\Exception $exception) {
            var_dump($exception->getMessage());
        }
        var_dump($second, $memory);
    }


//    public function cityS(string $url, string $city_name, Client $client)
//    {
//        echo "-------\n";
//        sleep(1);
//        /* @var Redis $cache */
//        $cache = App::getBean(Redis::class);
//        $start_time = microtime(true);
//
//        var_dump("task_城市{$city_name} start");
//        //省
//        $this->data = [];
//        try {
//            $psAreaAli = new PsAreaAli();
//            $areaParentId = current(explode('.', $url));
////        //插入省信息
//            $psAreaAli->setAreaParentId(0)->setAreaCode($areaParentId)->setAreaName($city_name)->setAreaType(CityEnums::PROVINCE)->save()->getResult();
////
//
//            $areaType = CityEnums::CITY;
//            $class = '.citytr';
////            $data = [];
//            $contents = $client->request("get", $url)->getResponse()->getBody()->getContents();
//            var_dump($contents);
//            $dom = HtmlDomParser::str_get_html($contents);
//            foreach ($dom->find($class) as $item) {
//
//                $areaCode = strip_tags($item->find('td', 0)->innertext());
//                $areaName = strip_tags($item->find('td', 1)->innertext());
//                var_dump($areaName);
//                //塞入数组批量插入
//                $this->data[] = [
//                    'areaCode' => $areaCode,
//                    'areaName' => $areaName,
//                    'areaParentId' => $areaParentId,
//                    'areaType' => $areaType
//                ];
//
//                if (isset($item->find('td', 0)->find('a', 0)->href)) {
//                    $district_url = $item->find('td', 0)->find('a', 0)->href;
//                    $this->district($district_url, $areaCode, $client);
////                    var_dump("投递district.url:" . $district_url);
////                    echo "\n";
////                    TaskD::deliver('citySpider', 'district', [$district_url, $areaCode, $client]);
//                } else {
//                    var_dump($areaParentId . $areaName . "无下一级");
//                }
//            }
//            var_dump($city_name . "总共:" . count($this->data));
//
//
//
//            PsAreaAli::batchInsert($this->data);
//        }catch (\Exception $exception) {
//            var_dump($exception->getFile());
//            var_dump($exception->getLine());
//            var_dump($exception->getMessage());
//        }
//
//
//        $end_time = microtime(true);
//        $second = round($end_time - $start_time, 3);
//
////        $cache->hSet(self::HASH_CITY_ONCE_TIME, $city_name, $second);
//        $cache->zAdd(self::HASH_CITY_ONCE_TIME, $end_time, $city_name);
//        $cache->hSet(self::HASH_CITY_ONCE_COUNT, $city_name, count($this->data));
//
//        var_dump($city_name . "耗时:" . $second . "秒");
//    }
//
//    /*
//    * 市到区到街道 三次循环
//    */
//    public function district($url, $areaParentId, Client $client)
//    {
////        echo "-------\n";
////        $start_time = microtime(true);
////        var_dump("task_区 start");
//        sleep(1);
//        $areaType = CityEnums::DISTRICT;
//        $class = '.countytr';
//
//        $contents = $client->request("get", $url)->getResponse()->getBody()->getContents();
////        $data = [];
//        $dom = HtmlDomParser::str_get_html($contents);
//        foreach ($dom->find($class) as $item) {
//
//            $areaCode = strip_tags($item->find('td', 0)->innertext());
//            $areaName = strip_tags(characet($item->find('td', 1)->innertext()));
//            //塞入数组批量插入
//            $this->data[] = [
//                'areaCode' => $areaCode,
//                'areaName' => $areaName,
//                'areaParentId' => $areaParentId,
//                'areaType' => $areaType
//            ];
//
//            if (isset($item->find('td', 0)->find('a', 0)->href)) {
//                $district_url = $item->find('td', 0)->find('a', 0)->href;
//
//                $district_url = current(explode('/', $url)) . '/' . $district_url;
////                var_dump("街区投递.url:" . $district_url);
//                $this->street($district_url, $areaCode, $client);
////                TaskD::deliver('citySpider', 'street', [$district_url, $areaCode, $client]);
//            } else {
//                var_dump($areaParentId . $areaName . "无下一级");
//            }
//        }
//
////        var_dump("task_区:".$areaParentId . "总共:" . count($data));
////        PsAreaAli::batchInsert($data);
////
////        $end_time = microtime(true);
////        $second = round($end_time - $start_time, 3);
////        var_dump("task_区:".$areaParentId . "耗时:" . $second . "秒");
//
//    }
//
//    public function street($url, $areaParentId, Client $client)
//    {
////        echo "-------\n";
////        $start_time = microtime(true);
////        var_dump("task_街区 start");
//        sleep(1);
//        $areaType = CityEnums::ROAD;
//        $class = '.towntr';
//
//        $contents = $client->request("get", $url)->getResponse()->getBody()->getContents();
//        $data = [];
//        $dom = HtmlDomParser::str_get_html($contents);
//        foreach ($dom->find($class) as $item) {
//
//            $areaCode = strip_tags($item->find('td', 0)->innertext());
//            $areaName = strip_tags(characet($item->find('td', 1)->innertext()));
//            //塞入数组批量插入
//            $this->data[] = [
//                'areaCode' => $areaCode,
//                'areaName' => $areaName,
//                'areaParentId' => $areaParentId,
//                'areaType' => $areaType
//            ];
//        }
//
////        var_dump("task_街区:".$areaParentId . "总共:" . count($data));
////        PsAreaAli::batchInsert($data);
////
////        $end_time = microtime(true);
////        $second = round($end_time - $start_time, 3);
////        var_dump("task_街区:".$areaParentId . "耗时:" . $second . "秒");
//    }
}