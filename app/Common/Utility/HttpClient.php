<?php


namespace App\Common\Utility;


use Swoft\HttpClient\Client;

class HttpClient extends Client
{
    public function __construct(array $config = [])
    {
        parent::__construct($config);
    }
}