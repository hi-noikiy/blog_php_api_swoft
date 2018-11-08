<?php

namespace App\Controllers\V1;


use App\Common\Controller\ApiController;
use App\Models\Amqp;
use App\Models\Token;
use Elasticsearch\ClientBuilder;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;
use Ramsey\Uuid\Uuid;
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
 * @Controller(prefix="/v1/test")
 * @Middleware(class=ControllerTestMiddleware::class)
 */
class TestController extends ApiController
{

    /**
     * @RequestMapping(route="index", method=RequestMethod::GET)
     * @return string
     */
    public function index()
    {
        try {

            // Generate a version 1 (time-based) UUID object
            $uuid1 = Uuid::uuid1();
            echo $uuid1->toString() . "\n"; // i.e. e4eaaaf2-d142-11e1-b3e4-080027620cdd

            // Generate a version 3 (name-based and hashed with MD5) UUID object
            $uuid3 = Uuid::uuid3(Uuid::NAMESPACE_DNS, 'php.net');
            echo $uuid3->toString() . "\n"; // i.e. 11a38b9a-b3da-360f-9353-a5a725514269

            // Generate a version 4 (random) UUID object
            $uuid4 = Uuid::uuid4();
            echo $uuid4->toString() . "\n"; // i.e. 25769c6c-d34d-4bfe-ba98-e0ee856f3e7a

            // Generate a version 5 (name-based and hashed with SHA1) UUID object
            $uuid5 = Uuid::uuid5(Uuid::NAMESPACE_DNS, 'php.net');
            echo $uuid5->toString() . "\n"; // i.e. c4a760a8-dbcf-5254-a0d9-6a4474bd1b62

        } catch (UnsatisfiedDependencyException $e) {

            // Some dependency was not met. Either the method cannot be called on a
            // 32-bit system, or it can, but it relies on Moontoast\Math to be present.
            echo 'Caught exception: ' . $e->getMessage() . "\n";

        }
    }

}