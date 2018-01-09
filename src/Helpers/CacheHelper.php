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
        $contentPermissionIds = PermissionRepository::$availableContentPermissionIds ?? [];
        $settings = ContentRepository::$pullFutureContent . ' ' .
            ConfigService::$brand . ' ';
        if ($contentPermissionIds) {
            $settings .= implode(' ', array_values($contentPermissionIds));
        }

        return $settings;
    }

    public static function getCache($key)
    {
        return Redis::get('results_' . $key);
    }

    public static function getKey()
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
            Redis::rpush('content_' . $element, 'results_' . $key);
        }
    }

    public static function getListElement($key)
    {
        return Redis::lrange($key, 0, -1);
    }

    public static function deleteCache($key)
    {
        $keys = self::getListElement($key);
        foreach ($keys as $cacheKey) {
            // delete all the cached search results where the content was returned
            Cache::forget($cacheKey);
        }

        //delete the list element (mapping between content and search hashes)
        Cache::forget($key);

        //delete the cache for the content
        Cache::forget('content_' . self::$hash);

        return true;

    }
}