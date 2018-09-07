<?php

namespace App\Controllers\V1;


use App\Common\Controller\ApiController;
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
 * @Controller(prefix="/v1/rabbit")
 */
class RabbitController extends ApiController
{

    private static $instances = [];
    /**
     * @RequestMapping(route="add", method=RequestMethod::GET)
     * @return string
     */
    public function add()
    {


        $channel = Amqp::getInstance()->channel();

        try{
//            $name = 'example_direct_exchange';
//            $type = AMQP_EX_TYPE_DIRECT;
//            $passive = false;
//            $durable = true;
//            $auto_delete = true;
//            $channel->exchange_declare($name, $type, $passive, $durable, $auto_delete);
//            $channel->queue_bind('hello','example_direct_exchange');
            $channel->queue_declare('hello', false, false, false, false);
            $msg = new AMQPMessage("hello world");
            $channel->basic_publish($msg,'','hello');
        }catch (\AMQPChannelException $e){
            echo $e->getCode();
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
//        $channel->close();

        return $this->respondWithArray($channel);
    }

}