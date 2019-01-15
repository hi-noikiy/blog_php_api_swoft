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

    public static function swoole_header($key = '', $default = null): ?string
    {
        $headers = self::swoole_headers();
        return $headers[$key] ?? $default;
    }

    public static function ip()
    {
        return self::swoole_header('remote-host') ?? self::swoole_header('x-real-ip');
    }

    public static function accessToken()
    {
        return self::swoole_header('access-token');
    }

    public static function agentTransferEnum(): int
    {

        $source = self::swoole_header('source');
        $agent = self::swoole_header('user-agent');
        if(isset($source) && $source == 'losingbattle_miniprogram'){
            return \App\Common\Enums\SourceEnums::MINIPROGRAM;
        }

        return \App\Common\Enums\SourceEnums::UNKNOWN;
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

    public static function miniProgram()
    {
        $miniProgram = \EasyWeChat\Factory::miniProgram(config('wechat.miniprogram'));
        return $miniProgram;
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
