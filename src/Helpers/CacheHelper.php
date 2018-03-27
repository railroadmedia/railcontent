<?php

namespace Railroad\Railcontent\Helpers;


use Illuminate\Cache\RedisStore;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Repositories\PermissionRepository;
use Railroad\Railcontent\Services\ConfigService;

class CacheHelper
{

    public static function setPrefix()
    {
        if (method_exists(Cache::store(ConfigService::$cacheDriver)->getStore(), 'setPrefix')) {
            return Cache::store(ConfigService::$cacheDriver)->setPrefix(ConfigService::$redisPrefix);
        }
        return Cache::store(ConfigService::$cacheDriver)->getPrefix();

    }

    /**
     * Return a string with the user's settings, that it's used when we calculate the cache key
     * @return string
     */
    public static function getSettings()
    {
        self::setPrefix();
        $settings = ' ' . ContentRepository::$pullFutureContent
            . ' ' . ConfigService::$brand
            . ' ' . implode(' ', array_values(array_wrap(ConfigService::$availableBrands)))
            . ' ' . implode(' ', array_values(array_wrap(ContentRepository::$availableContentStatues)))
            . ' ' . implode(' ', array_values(array_wrap(PermissionRepository::$availableContentPermissionIds)));

        return $settings;
    }

    /**
     * Generate a md5 key based on function arguments and user settings
     * @return string
     */
    public static function getKey()
    {
        $args = func_get_args();
        $key = '';
        foreach ($args as $arg) {
            $key .= implode(' ', array_values(array_wrap($arg)));
        }

        return md5($key . self::getSettings());
    }

    /**
     * Insert all the specified value (content search key) at the tail of the set stored at key(content id).
     * If not exist a set for content id, it is created as empty set before performing the push operation.
     * e.g.: musora:content_list_contentId => "contents_results_4a3d0072f14c76449c5acb13a04b4bfe"
     *
     * @param string $key
     * @param array $elements
     */
    public static function addLists($key, array $elements)
    {
        self::setPrefix();
        if (Cache::store(ConfigService::$cacheDriver)->getStore() instanceof RedisStore) {
            foreach ($elements as $element) {
                Cache::store(ConfigService::$cacheDriver)->connection()->sadd(
                    Cache::store(ConfigService::$cacheDriver)->getPrefix() . 'content_list_' . $element,
                    Cache::store(ConfigService::$cacheDriver)->getPrefix() . $key
                );
            }
        }
    }

    /**
     * Return all the elements of the set stored at key(content id).
     * e.g.:
     * 1) "contents_results_4a3d0072f14c76449c5acb13a04b4bfe"
     * 2) "contents_results_4a3d0072f14c76449c5acb13a04b4bfe"
     * 3) "contents_results_4a3d0072f14c76449c5acb13a04b4bfe"
     * @param string $key
     * @return mixed
     */
    public static function getListElement($key)
    {
        self::setPrefix();

        if (Cache::store(ConfigService::$cacheDriver)->getStore() instanceof RedisStore) {
            $keys = Cache::store(ConfigService::$cacheDriver)
                ->connection()
                ->smembers(Cache::store(ConfigService::$cacheDriver)->getPrefix() . $key);

            return $keys;
        }

        return null;
    }

    /**
     * Delete the cache for the key and the related cached results saved in the list
     * @param string $key
     * @return bool
     */
    public static function deleteCache($key)
    {
        self::setPrefix();

        $keys = self::getListElement($key);

        self::deleteCacheKeys($keys);

        return true;
    }

    /**
     * Delete all the cache with key like specified key
     * @param string $key
     * @return bool
     */
    public static function deleteAllCachedSearchResults($key)
    {
        $keys = Redis::keys("*$key*");

        self::deleteCacheKeys($keys);

        return true;
    }

    /**
     * Delete all the cache with specified keys
     * @param array $keys
     * @return bool
     */
    public static function deleteCacheKeys($keys)
    {
        if (Cache::store(ConfigService::$cacheDriver)->getStore() instanceof RedisStore) {
            if (!empty($keys) && is_array($keys)) {
                foreach ($keys as $key) {
                    Cache::store(ConfigService::$cacheDriver)->connection()->del($key);
                }
            }
        }

        return true;
    }
}