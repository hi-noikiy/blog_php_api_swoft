<?php

namespace App\Controllers\LiveBroadcast;

use App\Common\Controller\ApiController;
use Swoft\Http\Message\Server\Request;
use Swoft\Http\Server\Bean\Annotation\Controller;
use Swoft\Http\Server\Bean\Annotation\RequestMapping;
use Swoft\Http\Server\Bean\Annotation\RequestMethod;

/**
 * @Controller(prefix="/livebroadcast/push")
 */
class PushController extends ApiController
{
    /**
     * @RequestMapping(route="/livebroadcast/push")
     * @param Request $request
     * @return string
     */
    public function index(Request $request)
    {
        $push_url = getPushUrl(31212,'test','78be0729347852eb2ca37a6eb0175a94');

        return $this->respondWithArray(compact('push_url'));
    }


}