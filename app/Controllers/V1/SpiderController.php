<?php

namespace App\Controllers\V1;


use App\Common\Controller\ApiController;
use Swoft\Http\Message\Server\Request;
use Swoft\Http\Server\Bean\Annotation\Controller;
use Swoft\Http\Server\Bean\Annotation\RequestMapping;
use Swoft\Http\Server\Bean\Annotation\RequestMethod;
use Swoft\HttpClient\Client;

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

        var_dump(json_encode([0=>'123',1=>'123']));
        return $this->respondWithArray([0=>'123',1=>'123']);
        $client = new Client(['adapter'=>'co']);

        return $this->respondWithArray($client->get('https://www.baidu.com')->getResponse()->getBody()->getContents());
    }

}