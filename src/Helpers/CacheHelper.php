<?php

namespace Railroad\Railcontent\Helpers;

use Carbon\Carbon;
use Illuminate\Cache\RedisStore;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;
use Predis\Collection\Iterator\Keyspace;
use Predis\Transaction\AbortedMultiExecException;
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
    public static function addLists($key, $elements)
    {
        self::setPrefix();
        if (!is_array($elements)) {
            $elements = [$elements];
        }
        $start = microtime(true);
        if (Cache::store(ConfigService::$cacheDriver)
                ->getStore() instanceof RedisStore) {
            foreach ($elements as $element) {
                Cache::store(ConfigService::$cacheDriver)
                    ->connection()
                    ->sadd(
                        Cache::store(ConfigService::$cacheDriver)
                            ->getPrefix() . 'content_' . $element,
                        $key
                    );
            }
        }
        $tEnd = microtime(true) - $start;
        Log::info('for key::' . $key . ' add members to content set in ' . $tEnd);
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

        //Delete members from the set and the cache records in batches of 100
        $cursor = 0;
        do {
            list(
                $cursor, $keys
                ) = Redis::sscan(
                Cache::store(ConfigService::$cacheDriver)
                    ->getPrefix() . $key,
                $cursor,
                'COUNT',
                1000
            );
            if (count($keys) > 0) {
                self::deleteCacheKeys($keys);
            }
        } while ($cursor);

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
            $start = microtime(true);
            if (!empty($keys) && is_array($keys)) {
                foreach ($keys as $key) {
                    Cache::store(ConfigService::$cacheDriver)
                        ->connection()
                        ->executeRaw(array_merge(['UNLINK'], explode(' ', $key)));
                }
            }
            $tEnd = microtime(true) - $start;
            Log::info('delete cache keys ' . $tEnd);
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
                $date = Carbon::parse(min(array_filter(array_column($permissions, 'expiration_date'), 'strlen')));
                if ($date->diffInMinutes() < ConfigService::$cacheTime) {
                    return $date->diffInMinutes();
                }
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
            $cacheTime =
                Carbon::now()
                    ->addMinutes(self::getExpirationCacheTime())
                    ->getTimestamp();

            $existingTTl = Redis::ttl($keys);

            if (($existingTTl > 0) && ($existingTTl < $cacheTime)) {
                $cacheTime = $existingTTl;
            }
            Redis::expire(
                $cacheTime,
                $timeToLive
            );
        }

        return true;
    }

    public static function getUserSpecificHashedKey()
    {
        $key =
            Cache::store(ConfigService::$cacheDriver)
                ->getPrefix() . 'userId_';

        if (auth()->check()) {
            $key .= auth()->user()->id;
        }

        return $key;
    }

    public static function getCachedResultsForKey($hash)
    {
        $results = null;
        if (Cache::store(ConfigService::$cacheDriver)
                ->getStore() instanceof RedisStore) {
            $results = json_decode(
                Cache::store(ConfigService::$cacheDriver)
                    ->connection()
                    ->hget(self::getUserSpecificHashedKey(), $hash),
                true
            );
        }

        return $results;
    }

    public static function saveUserCache($hash, $data, $contentIds = [])
    {
        $start = microtime(true);
        if (Cache::store(ConfigService::$cacheDriver)
                ->getStore() instanceof RedisStore) {
            $userKey = self::getUserSpecificHashedKey();
            if (!is_null($contentIds)) {
                if (empty($contentIds)) {
                    $contentIds = array_pluck($data, 'id');
                }
                self::addLists($userKey . ' ' . $hash, $contentIds);
            }
            $cacheTime =
                Carbon::now()
                    ->addMinutes(self::getExpirationCacheTime())
                    ->getTimestamp();
            $existingTTl = Redis::ttl($userKey);

            if (($existingTTl > 0) && ($existingTTl < $cacheTime)) {
                $cacheTime = $existingTTl;
            }
            try {
                $results =
                    Cache::store(ConfigService::$cacheDriver)
                        ->connection()
                        ->transaction(
                            ['watch' => $userKey],
                            function ($t) use ($userKey, $hash, $data, $cacheTime) {
                                $t->hset(
                                    $userKey,
                                    $hash,
                                    json_encode($data)
                                );
                                $t->multi();
                                $t->expire(self::getUserSpecificHashedKey(), $cacheTime);
                                $t->hget(self::getUserSpecificHashedKey(), $hash);
                            }
                        );
                return (json_decode($results[2], true));
            } catch (AbortedMultiExecException $e) {

            }
        }
        $tEnd = microtime(true) - $start;
        Log::info(' save  user cache with content sets in ' . $tEnd);
        return $data;
    }

    /**
     * @param null|array $userKeys
     * @param string $fieldKey
     */
    public static function deleteUserFields($userKeys = null, $fieldKey = 'content')
    {
        if (Cache::store(ConfigService::$cacheDriver)
                ->getStore() instanceof RedisStore) {
            $start = microtime(true);
            if (!$userKeys) {
                $userKeys = iterator_to_array(
                    new \Predis\Collection\Iterator\Keyspace(
                        Cache::store(ConfigService::$cacheDriver)
                            ->connection()
                            ->client(), '*userId*'
                    )
                );
            }
            foreach ($userKeys as $userKey) {
                $fields = iterator_to_array(
                    new \Predis\Collection\Iterator\HashKey(
                        Cache::store(ConfigService::$cacheDriver)
                            ->connection()
                            ->client(), $userKey, '*' . $fieldKey . '*'
                    )
                );
                $myNewArray = array_combine(
                    array_map(
                        function ($key) use ($userKey) {
                            return ' ' . $userKey . ' ' . $key;
                        },
                        array_keys($fields)
                    ),
                    $fields
                );
                if (!empty($myNewArray)) {
                    Cache::store(ConfigService::$cacheDriver)
                        ->connection()
                        ->executeRaw(array_merge(['UNLINK'], explode(' ', implode(array_keys($myNewArray)))));
                }
            }
            $tEnd = microtime(true) - $start;
            Log::info(' delete cache specific user fields in ' . $tEnd);
            Log::info($userKeys);
        }
    }

}