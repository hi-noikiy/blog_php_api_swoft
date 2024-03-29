<?php

/*
 * This file is part of Swoft.
 * (c) Swoft <group@swoft.org>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

return [
    'serverDispatcher' => [
        'middlewares' => [
//            \Swoft\View\Middleware\ViewMiddleware::class,
//            \Swoft\Auth\Middleware\AuthMiddleware::class,
            \Swoft\Devtool\Middleware\DevToolMiddleware::class,
//             \Swoft\Session\Middleware\SessionMiddleware::class,
            \App\Middlewares\ValidateMiddleware::class,
            \App\Middlewares\LogMiddleware::class
        ]
    ],
    'httpRouter' => [
        'ignoreLastSlash' => false,
        'tmpCacheNumber' => 1000,
        'matchAll' => '',
    ],
    'requestParser' => [
        'parsers' => [

        ],
    ],
    'view' => [
        'viewsPath' => '@resources/views/',
        'suffixes' => ['php', 'html']
    ],
    'cache' => [
        'driver' => 'redis',
    ],
    'demoRedis' => [
        'class' => \Swoft\Redis\Redis::class,
        'poolName' => 'demoRedis'
    ],
    'providerSelector' => [
        'class' => \Swoft\Sg\ProviderSelector::class,
        'provider' => 'consul',
        'providers' => [
            'consul' => \Swoft\Sg\Provider\ConsulProvider::class
        ]
    ],
];
