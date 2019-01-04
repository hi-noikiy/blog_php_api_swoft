<?php

namespace App\Models;

use App\Common\Code\Code;
use PhpAmqpLib\Channel\AMQPChannel;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use Swoft\Bean\Annotation\Inject;
use Swoft\Bean\Annotation\Bean;
use Swoft\Bean\Annotation\Scope;
use Exception;

/**
 *
 * @Bean()
 */
class Amqp
{
    private static $instances = [];

    /**
     *
     *
     * @var AMQPStreamConnection
     * @return AMQPStreamConnection
     *
     */
    public static function getInstance($vhost = 'test')
    {
        $host = "114.215.110.111";
        $port = 5672;
        $user = "admin";
        $pass = "147258369";
//        $vhost = "test";

        if (!isset(static::$instances[$vhost])) {

            try {
                static::$instances[$vhost] = new AMQPStreamConnection($host, $port, $user, $pass, $vhost);
            } catch (\Exception $e) {
                echo 'Caught exception: ', $e->getMessage(), "\n";
            }
        }

        return static::$instances[$vhost];
    }


    private function __clone()
    {
    }  //覆盖__clone()方法，禁止克隆
}