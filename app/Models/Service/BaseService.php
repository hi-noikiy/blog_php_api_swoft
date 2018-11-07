<?php

namespace App\Models\Service;


class BaseService
{
    private static $_services = [];
    private static $name;

    /**
     * 单例容器
     * @param null $params
     * @return static
     */
    public static function service($params = null)
    {
        $name = get_called_class();
        self::$name = $name;
        if (!isset(self::$_services[$name]) || !is_object(self::$_services[$name])) {
            $instance = self::$_services[$name] = new static($params);
            return $instance;
        }
        return self::$_services[$name];
    }

    /**
     * 防止克隆
     */
    private function __clone()
    {
    }
}