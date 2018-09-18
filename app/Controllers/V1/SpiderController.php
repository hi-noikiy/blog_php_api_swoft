<?php

namespace App\Controllers\V1;


use App\Common\Controller\ApiController;
use App\Common\Utility\Qiniu;
use Sunra\PhpSimple\HtmlDomParser;
use Swoft\Http\Message\Server\Request;
use Swoft\Http\Server\Bean\Annotation\Controller;
use Swoft\Http\Server\Bean\Annotation\RequestMapping;
use Swoft\Http\Server\Bean\Annotation\RequestMethod;
use Swoft\HttpClient\Client;
use Wa72\HtmlPageDom\HtmlPage;
use Wa72\HtmlPageDom\HtmlPageCrawler;

/**
 * @Controller(prefix="/v1/spider")
 */
class SpiderController extends ApiController
{

    /**
     * @RequestMapping(route="index", method=RequestMethod::GET)
     * @return string
     */
    public function index()
    {

//        $client = new Client(['adapter'=>'curl']);
        $qiniu = new Qiniu();

        try {
            $start_time = microtime(true);
            var_dump($start_time);
            $client = new Client(['adapter' => 'curl']);

            $content = $client->request('get', 'https://www.qqtn.com/tx/weixintx_1.html')->getResponse()->getBody()->getContents();
            $fileType = mb_detect_encoding($content, array('UTF-8', 'GBK', 'LATIN1', 'BIG5'));

            $dom = HtmlDomParser::str_get_html($content);

            $gxlist = $dom->find('.g-gxlist-imgbox', 0);
            foreach ($gxlist->find('a') as $item) {
                echo $item->href;
            }
            echo "\n";
            foreach ($gxlist->find('img') as $item) {

                var_dump($item->src);
                var_dump($qiniu->single_upload_url($item->src, 'virtual_avatar'));
                break;
            }

//            foreach ($lists as $item){
//
//                echo $item->src;
//                break;
//            }
            $end_time = microtime(true);
            $second = round($end_time - $start_time, 3);
            $memory = memory_get_usage();
        } catch (\Exception $exception) {
            var_dump($exception->getMessage());
        }

        return $this->respondWithArray($gxlist->src);
    }

}