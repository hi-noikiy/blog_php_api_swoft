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
