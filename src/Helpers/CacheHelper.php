<?php

namespace Railroad\Railcontent\Helpers;


use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Repositories\PermissionRepository;
use Railroad\Railcontent\Services\ConfigService;

class CacheHelper
{
    public static $hash;

    public static function getSettings()
    {
        $settings = ContentRepository::$pullFutureContent . ' ' .
            ConfigService::$brand;
        if(ContentRepository::$availableContentStatues)
        {
            $settings .= implode(' ', array_values(ContentRepository::$availableContentStatues));
        }
        if (PermissionRepository::$availableContentPermissionIds) {
            $settings .= implode(' ', array_values(PermissionRepository::$availableContentPermissionIds));
        }

        return $settings;
    }

    public static function getCache($key)
    {
        return Redis::get('results_' . $key);
    }

    public static function  getKey()
    {
        $args = func_get_args();

        $key = implode(' ', $args) . self::getSettings();
        $generatedHas = md5($key);
        self::$hash = $generatedHas;
        return  $generatedHas;
    }

    public static function setCache($key, $value)
    {
        return Redis::set($key, $value);
    }

    public static function addLists($key, array $elements)
    {
        foreach ($elements as $element) {
            Redis::rpush(Cache::store('redis')->getPrefix().'content_list_' . $element, $key);
        }
    }

    public static function getListElement($key)
    {
        return Redis::lrange(Cache::store('redis')->getPrefix().$key, 0, -1);
    }

    public static function deleteCache($key)
    {

        $keys = self::getListElement($key);

        foreach ($keys as $cacheKey) {
            // delete all the cached search results where the content was returned
            Redis::del(Cache::store('redis')->getPrefix().$cacheKey);
        }

        //delete the list element (mapping between content and search hashes)
        Cache::store('redis')->forget($key);


        return true;

    }
}