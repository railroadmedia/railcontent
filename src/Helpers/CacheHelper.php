<?php

namespace Railroad\Railcontent\Helpers;


use Illuminate\Support\Facades\Redis;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Repositories\PermissionRepository;
use Railroad\Railcontent\Services\ConfigService;

class CacheHelper
{
    public static $hash;
    public static function getSettings()
    {
        return ContentRepository::$pullFutureContent . ' ' .
            ConfigService::$brand . ' ' .
            implode(' ',array_values(PermissionRepository::$availableContentPermissionIds));
    }

    public static function getCache($key)
    {
        return Redis::get('results_' . $key);
    }

    public static function getKey()
    {
        $args = func_get_args();
        $key = $args[0] . self::getSettings();
        self::$hash = md5($key);
        return  self::$hash;
    }

    public static function setCache($key, $value)
    {
        return Redis::set($key, $value);
    }

    public static function addLists($key, array $elements)
    {
        foreach ($elements as $element)
        {
            Redis::rpush('content_' . $element, 'results_' . $key);
        }
    }

    public static function getListElement($key)
    {
        return Redis::lrange($key,0,100000);
    }

    public static function deleteCache($key)
    {
        $keys = self::getListElement($key);
        foreach ($keys as $cacheKey){
            Redis::del($cacheKey);
        }
        Redis::del($key);

        return true;

    }
}