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


    public static function param($key = "", $default = "")
    {
        $param = array_merge(request()->post(), request()->json());
        if (is_null($key)) {
            return $param;
        }
        return $param[$key] ?? $default;
    }
}
