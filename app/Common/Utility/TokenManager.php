<?php
namespace App\Common\Utility;

use Swoft\Bean\Annotation\Bean;
use Swoft\Bean\Annotation\Inject;
use Swoft\Session\Handler\RedisSessionHandler;
/**
 * @Bean(scope=Scope::PROTOTYPE)
 */
class TokenManager
{
    protected $handlers = [
        'redis' => RedisSessionHandler::class
    ];

}