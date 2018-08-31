<?php

namespace Railroad\Railcontent\Helpers;

use Carbon\Carbon;
use Illuminate\Cache\RedisStore;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\UserPermissionsService;

class CacheHelper
{
    public static $currentUserPermissions;

    public static function setPrefix()
    {
        if (method_exists(
            Cache::store(ConfigService::$cacheDriver)
                ->getStore(),
            'setPrefix'
        )) {
            return Cache::store(ConfigService::$cacheDriver)
                ->setPrefix(ConfigService::$redisPrefix);
        }

        return Cache::store(ConfigService::$cacheDriver)
            ->getPrefix();
    }

    /**
     * Return a string with the user's settings, that it's used when we calculate the cache key
     *
     * @return string
     */
    public static function getSettings()
    {
        self::setPrefix();

        $settings =
            ' ' .
            ContentRepository::$pullFutureContent .
            ' ' .
            ConfigService::$brand .
            ' ' .
            implode(' ', array_values(array_wrap(ConfigService::$availableBrands))) .
            ' ' .
            implode(' ', array_values(array_wrap(ContentRepository::$availableContentStatues)));

        /**
         * @var $service UserPermissionsService
         */

//        if (auth()->check()) {
//
//            if (empty(self::$currentUserPermissions)) {
//                $service = app()->make(UserPermissionsService::class);
//                self::$currentUserPermissions = $service->getUserPermissions(auth()->id());
//            }
//
//            if (!empty(self::$currentUserPermissions)) {
//                $settings .= implode(' ', array_column(self::$currentUserPermissions, 'permission_id'));
//            }
//        }

        return $settings;
    }

    /**
     * Generate a md5 key based on function arguments and user settings
     *
     * @return string
     */
    public static function getKey()
    {
        $args = func_get_args();
        $key = '';
        foreach ($args as $arg) {
            $key .= implode(' ', array_values(array_wrap($arg)));
        }
        if (auth()->check()) {
            $key .= auth()->user()->id;
        }

        return md5($key . self::getSettings());
    }

    /**
     * Insert all the specified value (content search key) at the tail of the set stored at key(content id).
     * If not exist a set for content id, it is created as empty set before performing the push operation.
     * e.g.: musora:content_list_contentId => "contents_results_4a3d0072f14c76449c5acb13a04b4bfe"
     * If we have a authenticated user we save a set with the user cached keys. This set will be used when the user's
     * permission change.
     *
     * @param string $key
     * @param array $elements
     */
    public static function addLists($key, array $elements)
    {
        self::setPrefix();
        if (Cache::store(ConfigService::$cacheDriver)
                ->getStore() instanceof RedisStore) {
            foreach ($elements as $element) {
                Cache::store(ConfigService::$cacheDriver)
                    ->connection()
                    ->sadd(
                        Cache::store(ConfigService::$cacheDriver)
                            ->getPrefix() . 'content_list_' . $element,
                        Cache::store(ConfigService::$cacheDriver)
                            ->getPrefix() . $key
                    );
            }
            if (auth()->check()) {
                Cache::store(ConfigService::$cacheDriver)
                    ->connection()
                    ->sadd(
                        Cache::store(ConfigService::$cacheDriver)
                            ->getPrefix() . 'keys_for_userId_' . auth()->id(),
                        Cache::store(ConfigService::$cacheDriver)
                            ->getPrefix() . $key
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
     *
     * @param string $key
     * @return mixed
     */
    public static function getListElement($key)
    {
        self::setPrefix();

        if (Cache::store(ConfigService::$cacheDriver)
                ->getStore() instanceof RedisStore) {
            $keys =
                Cache::store(ConfigService::$cacheDriver)
                    ->connection()
                    ->smembers(
                        Cache::store(ConfigService::$cacheDriver)
                            ->getPrefix() . $key
                    );

            return $keys;
        }

        return null;
    }

    /**
     * Delete the cache for the key and the related cached results saved in the list
     *
     * @param string $key
     * @return bool
     */
    public static function deleteCache($key)
    {
        self::setPrefix();

        //Rename the key to a new key so that the set appears “deleted” to other Redis clients immediately.
        if (Redis::exists(
            Cache::store(ConfigService::$cacheDriver)
                ->getPrefix() . $key
        )) {
            Redis::rename(
                Cache::store(ConfigService::$cacheDriver)
                    ->getPrefix() . $key,
                Cache::store(ConfigService::$cacheDriver)
                    ->getPrefix() . $key . '_deleted'
            );
        }

        //Delete members from the set and the cache records in batches of 100
        $cursor = 0;
        do {
            list(
                $cursor, $keys
                ) = Redis::sscan(
                Cache::store(ConfigService::$cacheDriver)
                    ->getPrefix() . $key . '_deleted',
                $cursor,
                'COUNT',
                100
            );
            if (count($keys) > 0) {
                Redis::srem(
                    Cache::store(ConfigService::$cacheDriver)
                        ->getPrefix() . $key,
                    $keys
                );
                self::deleteCacheKeys($keys);
            }
        } while ($cursor);

        //delete set cache record
        self::deleteCacheKeys(
            [
                Cache::store(ConfigService::$cacheDriver)
                    ->getPrefix() . $key . '_deleted',
            ]
        );

        return true;
    }

    /**
     * Delete all the cache with key like specified key
     *
     * @param string $key
     * @return bool
     */
    public static function deleteAllCachedSearchResults($key)
    {
        $cursor = 0;
        do {
            list($cursor, $keys) = Redis::scan($cursor, 'match', "*$key*", 'count', 1000);
            self::deleteCacheKeys($keys);
        } while ($cursor);

        return true;
    }

    /**
     * Delete all the cache with specified keys
     *
     * @param array $keys
     * @return bool
     */
    public static function deleteCacheKeys($keys)
    {
        if (Cache::store(ConfigService::$cacheDriver)
                ->getStore() instanceof RedisStore) {
            if (!empty($keys) && is_array($keys)) {
                Cache::store(ConfigService::$cacheDriver)
                    ->connection()
                    ->executeRaw(array_merge(['UNLINK'], $keys));
            }
        }

        return true;
    }

    /** Check user permission expiration date and return first expiration date from the future.
     *  If the expiration time it's null(user have not permissions or the user's permissions never expire) => return
     * default cache time
     *
     * @return Carbon|int
     */
    public static function getExpirationCacheTime()
    {
        if (auth()->check()) {
            $service = app()->make(UserPermissionsService::class);
            $permissions = $service->getUserPermissions(auth()->id(), true);
            if (!empty(array_filter(array_column($permissions, 'expiration_date'), 'strlen'))) {
                return Carbon::parse(min(array_filter(array_column($permissions, 'expiration_date'), 'strlen')));
            }
        }

        return ConfigService::$cacheTime;
    }

    /** Set time to live to the specified cache keys. The keys will expire at the given time.
     *
     * @param array $keys
     * @param timestamp $timeToLive
     * @return bool
     */
    public static function setTimeToLiveForKeys(array $keys, $timeToLive)
    {
        if (Cache::store(ConfigService::$cacheDriver)
                ->getStore() instanceof RedisStore) {
            foreach ($keys as $key) {
                Redis::expireat(
                    $key,
                    $timeToLive
                );
            }
        }

        return true;
    }
}