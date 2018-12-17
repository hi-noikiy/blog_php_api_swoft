<?php

/*
 * This file is part of Swoft.
 * (c) Swoft <group@swoft.org>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

return [
    'env' => env('APP_ENV', 'test'),
    'debug' => env('APP_DEBUG', true),
    'version' => '1.0',
    'autoInitBean' => true,
    'bootScan' => [
        'App\Commands',
        'App\Boot',
    ],
    'beanScan' => [
        'App\Controllers',
        'App\Models',
        'App\Middlewares',
        'App\Tasks',
        'App\Services',
        'App\Breaker',
        'App\Pool',
        'App\Exception',
        'App\Listener',
        'App\Process',
        'App\Fallback',
        'App\WebSocket',
    ],
    'I18n' => [
        'sourceLanguage' => '@root/resources/messages/',
    ],
    'devtool' => require __DIR__ . DS . 'devtool.php',
    'db' => require __DIR__ . DS . 'db.php',
    'cache' => require __DIR__ . DS . 'cache.php',
    'service' => require __DIR__ . DS . 'service.php',
    'breaker' => require __DIR__ . DS . 'breaker.php',
    'provider' => require __DIR__ . DS . 'provider.php',
    'jwt' => require __DIR__ . DS . 'jwt.php',
    'github' => require __DIR__ . DS . 'github.php',
    'mail' => require __DIR__ . DS . 'mail.php',
    'sms' => require __DIR__ . DS . 'sms.php',
    'opendota' => require __DIR__ . DS . 'opendota.php',
    'wechat' => require __DIR__ . DS . 'wechat.php',
    'auth' => [
        'jwt' => [
            'algorithm' => 'HS256',
            'secret' => '1231231'
        ],
    ],
];
