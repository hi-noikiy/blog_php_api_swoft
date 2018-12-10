<?php
/**
 * This file is part of Swoft.
 *
 * @link https://swoft.org
 * @document https://doc.swoft.org
 * @contact group@swoft.org
 * @license https://github.com/swoft-cloud/swoft/blob/master/LICENSE
 */

class Swoft extends \Swoft\App
{
    /**
     *
     *
     * @access public
     * @param
     * @return \Swoft\Redis\Redis
     *
     */
    public static function redis()
    {
        return self::getBean(\Swoft\Redis\Redis::class);
    }


    public static function param($key = null, $default = null)
    {

        $jsonData = request()->json();
        $requestData = request()->input();

        if (is_array($jsonData)) {
            $param = $jsonData + $requestData;
        } else {
            $param = $requestData;
        }

        if (is_null($key)) {
            return $param;
        }
        return $param[$key] ?? $default;
    }

    public static function swoole_headers(): array
    {
        return request()->getSwooleRequest()->header;
    }

    public static function swoole_header($key = ''): string
    {
        $headers = self::swoole_headers();

        if (!isset($headers[$key])) {
            throw new \App\Exception\NotDefinedException("{$key}未定义");
        }
        return $headers[$key];
    }

    public static function ip()
    {
        return self::swoole_header('remote-host') ?? self::swoole_header('x-real-ip');
    }


    public static function github($redirect_uri = null)
    {
        $config = config('github');

        $github = new \League\OAuth2\Client\Provider\Github([
            'clientId' => $config['client_id'],
            'clientSecret' => $config['client_secret'],
            'redirectUri' => $redirect_uri ?? $config['redirect_uri']
        ]);

        return $github;
    }

    protected function getInputData($content)
    {
        if (false !== strpos(request()->getContentType(), 'application/json') || 0 === strpos($content, '{"')) {
            return (array)json_decode($content, true);
        } elseif (strpos($content, '=')) {
            parse_str($content, $data);
            return $data;
        }

        return [];
    }
}
