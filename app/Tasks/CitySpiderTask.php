<?php

namespace App\Tasks;

use App\Common\Enums\CityEnums;
use App\Common\Utility\Qiniu;
use App\Models\Entity\PsAreaAli;
use App\Models\Entity\VirtualUser;
use Swoft\Task\Bean\Annotation\Task;
use Swoft\HttpClient\Client;
use Sunra\PhpSimple\HtmlDomParser;

/**
 *
 * @Task("citySpider")
 */
class CitySpiderTask
{

    private $data = [];


    public function city(string $url, string $city_name, Client $client)
    {
        var_dump("task start");
        var_dump($city_name . ":start");
        //省

        try {
            $psAreaAli = new PsAreaAli();
            $areaParentId = current(explode('.', $url));
//        //插入省信息
            $psAreaAli->setAreaParentId(0)->setAreaCode($areaParentId)->setAreaName($city_name)->setAreaType(CityEnums::PROVINCE)->save()->getResult();
//

            $areaType = CityEnums::CITY;
            $class = '.citytr';
            $data = [];
            $contents = $client->request("get", $url)->getResponse()->getBody()->getContents();

            $dom = HtmlDomParser::str_get_html($contents);
            foreach ($dom->find($class) as $item) {

                $areaCode = strip_tags($item->find('td', 0)->innertext());
                $areaName = strip_tags(characet($item->find('td', 1)->innertext()));
                var_dump($areaCode);
                var_dump($areaName);
                //塞入数组批量插入
                $this->data[] = [
                    'areaCode' => $areaCode,
                    'areaName' => $areaName,
                    'areaParentId' => $areaParentId,
                    'areaType' => $areaType
                ];

                if (isset($item->find('td', 0)->find('a', 0)->href)) {
                    $district_url = $item->find('td', 0)->find('a', 0)->href;
                    $this->district($district_url, $areaCode, $client);
                }
            }

            $res = PsAreaAli::batchInsert($this->data)->getResult();
            var_dump($res);
//        var_dump($thiss->data);

        } catch (\Exception $exception) {
            var_dump($exception->getFile());
            var_dump($exception->getLine());
        }

    }

    /*
    * 市到区到街道 三次循环
    */
    private function district($url, $areaParentId, Client $client)
    {

        $areaType = CityEnums::DISTRICT;
        $class = '.countytr';

        $contents = $client->request("get", $url)->getResponse()->getBody()->getContents();

        $dom = HtmlDomParser::str_get_html($contents);
        foreach ($dom->find($class) as $item) {

            $areaCode = strip_tags($item->find('td', 0)->innertext());
            $areaName = strip_tags(characet($item->find('td', 1)->innertext()));
            //塞入数组批量插入
            $this->data[] = [
                'areaCode' => $areaCode,
                'areaName' => $areaName,
                'areaParentId' => $areaParentId,
                'areaType' => $areaType
            ];

            if (isset($item->find('td', 0)->find('a', 0)->href)) {
                $district_url = $item->find('td', 0)->find('a', 0)->href;
                $district_url = current(explode('/', $url)) . '/' . $district_url;
                $this->street($district_url, $areaCode, $client);
            }
        }


    }

    private function street($url, $areaParentId, Client $client)
    {

        $areaType = CityEnums::ROAD;
        $class = '.towntr';

        $contents = $client->request("get", $url)->getResponse()->getBody()->getContents();

        $dom = HtmlDomParser::str_get_html($contents);
        foreach ($dom->find($class) as $item) {

            $areaCode = strip_tags($item->find('td', 0)->innertext());
            $areaName = strip_tags(characet($item->find('td', 1)->innertext()));
            //塞入数组批量插入
            $this->data[] = [
                'areaCode' => $areaCode,
                'areaName' => $areaName,
                'areaParentId' => $areaParentId,
                'areaType' => $areaType
            ];
        }

    }

}