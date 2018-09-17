<?php

namespace App\Controllers\V1;


use App\Common\Controller\ApiController;
use App\Models\Amqp;
use App\Models\Token;
use Elasticsearch\ClientBuilder;
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
 * @Controller(prefix="/v1/ela")
 */
class ElaController extends ApiController
{

    /**
     * @RequestMapping(route="add", method=RequestMethod::GET)
     * @return string
     */
    public function add()
    {

        $builder = ClientBuilder::create();
        $builder->setHosts(['47.105.45.91:9200']);
        $client=  $builder->build();
        $params = [
            'index'=>'megacorp',
            'type'=>'employee',
            'id'=>1
        ];
        $client->search($params);
        return $this->respondWithArray($client->get($params));
    }

}