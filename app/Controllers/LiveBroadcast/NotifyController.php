<?php

namespace App\Controllers\LiveBroadcast;


use App\Common\Controller\ApiController;
use App\Common\Enums\ContentType;
use App\Models\Amqp;
use App\Models\Token;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;
use Swoft\App;
use Swoft\Bean\BeanFactory;
use Swoft\Db\Query;
use Swoft\Http\Message\Server\Request;
use Swoft\Http\Server\Bean\Annotation\Controller;
use Swoft\Http\Server\Bean\Annotation\RequestMapping;
use Swoft\Http\Server\Bean\Annotation\RequestMethod;
use Swoft\Http\Message\Bean\Annotation\Middlewares;
use Swoft\Http\Message\Bean\Annotation\Middleware;
use App\Middlewares\SignMiddleware;
use App\Middlewares\AuthMiddleware;
use Swoft\Bean\Annotation\Inject;

/**
 * @Controller(prefix="/livebroadcast/notify")
 */
class NotifyController extends ApiController
{

    /**
     * @RequestMapping(route="/livebroadcast/notify")
     * @param Request $request
     * @return string
     */
    public function index(Request $request)
    {

        $this->redis->sAdd("notify",$request->raw());

//        $this->redis->get()
        return $this->respondWithArray( );
    }

}