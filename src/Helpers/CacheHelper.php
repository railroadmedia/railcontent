<?php

namespace Railroad\Railcontent\Helpers;

use Carbon\Carbon;
use Illuminate\Cache\RedisStore;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;
use Predis\Transaction\AbortedMultiExecException;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\UserPermissionsService;

class CacheHelper
{
    /**
     * Set redis cache prefix.
     *
     * @return mixed
     */
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
     * Return a string with the user's settings, that it's used when we calculate the cache key.
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

        return $settings;
    }

    /**
     * Generate a md5 key based on function arguments and user settings.
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
            $key .= auth()->id();
        }

        return md5($key . self::getSettings());
    }

    /**
     * Insert all the specified value (content search key) at the tail of the set stored at key(content id).
     * If not exist a set for content id, it is created as empty set before performing the push operation.
     * e.g.: musora_railcontent_:content_contentId => "musora_railcontent_:userId_149628
     * contents_by_parent_ids_83fdfbb67340550446c69c6a05184c02"
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
     * Delete all the cache with specified keys.
     *
     * @param array $keys
     * @return bool
     */
    public static function deleteCacheKeys($keys)
    {
        if (Cache::store(ConfigService::$cacheDriver)
                ->getStore() instanceof RedisStore) {
            if (!empty($keys) && is_array($keys)) {
                foreach ($keys as $key) {
                    Cache::store(ConfigService::$cacheDriver)
                        ->connection()
                        ->executeRaw(array_merge(['UNLINK'], explode(' ', $key)));
                }
            }
        }

        return true;
    }

    /**
     * Check user permission expiration date and return first expiration date from the future.
     * If the expiration time it's null(user have not permissions or the user's permissions never expire) => return
     * default cache time
     *
     * @return int - ttl in minutes
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

    /**
     * Set time to live to the specified cache key. The key will expire at the given time.
     *
     * @param $keys
     * @param ttl in seconds $timeToLive
     * @return bool
     */
    public static function setTimeToLiveForKey($key, $timeToLive)
    {
        if (Cache::store(ConfigService::$cacheDriver)
                ->getStore() instanceof RedisStore) {
            $cacheTime = $timeToLive;
            $existingTTl = Redis::ttl($key);
            if (($existingTTl > 0) && ($existingTTl < $cacheTime)) {
                $cacheTime = $existingTTl;
            }
            Redis::expire(
                $key,
                $cacheTime
            );
        }
        return true;
    }

    /**
     * Get user specific hash key created with cache prefix, userId string and user id value if the user it's
     * authenticated.
     *
     * @return string
     */
    public static function getUserSpecificHashedKey()
    {
        self::setPrefix();
        $key =
            Cache::store(ConfigService::$cacheDriver)
                ->getPrefix() . 'userId_';

        if (auth()->check()) {
            $key .= auth()->id();
        }

        return $key;
    }

    /**
     * Get hash key fields for selected user key.
     *
     * @param string $hash
     * @return array|mixed|null|object
     */
    public static function getCachedResultsForKey($hash)
    {

        //var_dump('getCachedResultsForKey.......................................'.$hash);
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

    /**
     * Save hash key for user and return user cache
     *
     * @param string $hash
     * @param string $data
     * @param array $contentIds
     * @return array|mixed|object
     */
    public static function saveUserCache($hash, $data, $contentIds = [])
    {
        $cacheTime = self::getExpirationCacheTime() * 60;


        $userKey = self::getUserSpecificHashedKey();

        if (Cache::store(ConfigService::$cacheDriver)
                ->getStore() instanceof RedisStore) {
//            if (!is_null($contentIds)) {
//                if (empty($contentIds)) {
//                    $contentIds = array_pluck($data, 'id');
//                }
//
//                self::addLists($userKey . ' ' . $hash, $contentIds);
//            }

            //cache time in seconds
            $cacheTime = self::getExpirationCacheTime() * 60;

            //get key ttl in seconds
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
                                    serialize($data)
                                );
                                $t->multi();
                                $t->hget(self::getUserSpecificHashedKey(), $hash);
                                $t->expire(self::getUserSpecificHashedKey(), $cacheTime);
                            }
                        );
               return (unserialize($results[1]));
            } catch (AbortedMultiExecException $e) {

            }
        }

        return $data;
    }

    /**
     * Delete user field from cache.
     *
     * @param null|array $userKeys
     * @param string $fieldKey
     */
    public static function deleteUserFields($userKeys = null, $fieldKey = 'content')
    {

        // dd($fieldKey);

//        $userKeys = iterator_to_array(
//            new \Predis\Collection\Iterator\Keyspace(
//                Cache::store(ConfigService::$cacheDriver)
//                    ->connection()
//                    ->client(), '*userId*'
//            )
//        );

        if (Cache::store(ConfigService::$cacheDriver)
                ->getStore() instanceof RedisStore) {
            if (!$userKeys) {
                $userKeys = iterator_to_array(
                    new \Predis\Collection\Iterator\Keyspace(
                        Cache::store(ConfigService::$cacheDriver)
                            ->connection()
                            ->client(), '*railcontent:userId*'
                    )
                );
            }

//TODO: delete user cache
//            foreach ($userKeys as $userKey) {
//                $fields = iterator_to_array(
//                    new \Predis\Collection\Iterator\HashKey(
//                        Cache::store(ConfigService::$cacheDriver)
//                            ->connection()
//                            ->client(), $userKey, '*' . $fieldKey . '*'
//                    )
//                );
//
////                $myNewArray = array_combine(
////                    array_map(
////                        function ($key) use ($userKey) {
////                            return ' ' . $userKey . ' ' . $key;
////                        },
////                        array_keys($fields)
////                    ),
////                    $fields
////                );
////                if (!empty($myNewArray)) {
////                    Cache::store(ConfigService::$cacheDriver)
////                        ->connection()
////                        ->executeRaw(array_merge(['UNLINK'], explode(' ', implode(array_keys($myNewArray)))));
////                }
//            }
        }
    }
}