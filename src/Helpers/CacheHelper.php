<?php

namespace Railroad\Railcontent\Helpers;


use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Repositories\PermissionRepository;
use Railroad\Railcontent\Services\ConfigService;

class CacheHelper
{

    public static function setPrefix()
    {
        return Cache::store('redis')->setPrefix(ConfigService::$redisPrefix);
    }
    /**
     * Return a string with the user's settings, that it's used when we calculate the cache key
     * @return string
     */
    public static function getSettings()
    {
        self::setPrefix();
        $settings = ' '.ContentRepository::$pullFutureContent . ' ' .
            ConfigService::$brand.' ';
        if (ContentRepository::$availableContentStatues) {
            $settings .= implode(' ', array_values(ContentRepository::$availableContentStatues)).' ';
        }
        if (PermissionRepository::$availableContentPermissionIds) {
            $settings .= implode(' ', array_values(PermissionRepository::$availableContentPermissionIds)). ' ';
        }

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
        foreach($args as $arg){
            if(!is_array($arg))
            {
                $key .= $arg.' ';
            } else{
                $key.= implode(' ', array_values($arg));
            }
        }

        return md5($key.self::getSettings());
    }

    /**
     * Insert all the specified value (content search key) at the tail of the list stored at key(content id).
     * If not exist a list for content id, it is created as empty list before performing the push operation.
     * e.g.: musora:content_list_contentId => "contents_results_4a3d0072f14c76449c5acb13a04b4bfe"
     *
     * @param string $key
     * @param array $elements
     */
    public static function addLists($key, array $elements)
    {
        self::setPrefix();
        foreach ($elements as $element) {
           // Redis::rpush(Cache::store('redis')->getPrefix() . 'content_list_' . $element, $key);
             //use sets to store the mapping between content and cached methods keys
             Cache::store('redis')->connection()->sadd(Cache::store('redis')->getPrefix() . 'content_list_' . $element, $key);
        }
    }

    /**
     * Return all the elements of the list stored at key(content id).
     * e.g.:
    1) "contents_results_4a3d0072f14c76449c5acb13a04b4bfe"
    2) "contents_results_4a3d0072f14c76449c5acb13a04b4bfe"
    3) "contents_results_4a3d0072f14c76449c5acb13a04b4bfe"
     * @param string $key
     * @return mixed
     */
    public static function getListElement($key)
    {
        self::setPrefix();
        return Cache::store('redis')->connection()->smembers(Cache::store('redis')->getPrefix() . $key);
        //return Redis::lrange(Cache::store('redis')->getPrefix() . $key, 0, -1);
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

        foreach ($keys as $key1) {
            Redis::del(Cache::store('redis')->getPrefix().$key1);
        }

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

        foreach ($keys as $key) {
            Redis::del($key);
        }
        return true;
    }

    /**
     * Delete all the cache with specified keys
     * @param array $keys
     */
    public static function deleteCacheKeys(array $keys)
    {
        Redis::del(implode(' ', $keys));
    }
}