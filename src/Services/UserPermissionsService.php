<?php

namespace Railroad\Railcontent\Services;

use Carbon\Carbon;
use Illuminate\Cache\RedisStore;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;
use Railroad\Railcontent\Helpers\CacheHelper;
use Railroad\Railcontent\Repositories\UserPermissionsRepository;

class UserPermissionsService
{
    /**
     * @var \Railroad\Railcontent\Repositories\UserPermissionsRepository
     */
    private $userPermissionsRepository;

    /**
     * UserPermissionsService constructor.
     *
     * @param \Railroad\Railcontent\Repositories\UserPermissionsRepository $userPermissionsRepository
     */
    public function __construct(
        UserPermissionsRepository $userPermissionsRepository
    ) {
        $this->userPermissionsRepository = $userPermissionsRepository;
    }

    /**
     * Save user permission record in database
     *
     * @param integer $userId
     * @param integer $permissionId
     * @param date $startDate
     * @param date|null $expirationDate
     * @return array
     */
    public function updateOrCeate($attributes, $values)
    {
        if (array_key_exists('start_date', $values)) {
            $this->setTTLOrDeleteUserCache($attributes['user_id'], $values['start_date']);
        }

        $userPermission = $this->userPermissionsRepository->updateOrCreate($attributes, $values);

        return $this->userPermissionsRepository->getById($userPermission);
    }

    /**
     * Call the method that delete the user permission, if the user permission exists in the database
     *
     * @param int $id
     * @return array|bool
     */
    public function delete($id)
    {
        $userPermission = $this->userPermissionsRepository->getById($id);
        if (is_null($userPermission)) {
            return $userPermission;
        }

        //delete the cache for user
        CacheHelper::deleteCacheKeys([
                                         Cache::store(ConfigService::$cacheDriver)
                                             ->getPrefix().'userId_'.$userPermission['user_id'],
                                     ]);

        return $this->userPermissionsRepository->delete($id);
    }

    /**
     * Call the method from repository that pull user permissions and return an array with the results
     *
     * @param null|int $userId
     * @param bool $onlyActive
     * @return array
     */
    public function getUserPermissions($userId = null, $onlyActive = true)
    {
        return $this->userPermissionsRepository->getUserPermissions($userId, $onlyActive);
    }

    /**
     * @param int $userId
     * @param int $permissionId
     * @return array
     */
    public function getUserPermissionIdByPermissionAndUser($userId, $permissionId)
    {
        return $this->userPermissionsRepository->getIdByPermissionAndUser($userId, $permissionId);
    }

    /**
     * @param int $userId
     * @param int $permissionName
     * @return array
     */
    public function userHasPermissionName($userId, $permissionName)
    {
        return $this->userPermissionsRepository->userHasPermissionName($userId, $permissionName);
    }

    /**
     * Delete user cache or set time to live based on user permission start date.
     * If the user permission should be active from current datetime we delete user cache keys
     * If the user permission should be active from a future datetime we set time to live for all user cache keys to
     * the activation datetime
     *
     * @param int $userId
     * @param string $startDate
     */
    private function setTTLOrDeleteUserCache($userId, $startDate)
    {
        if (Cache::store(ConfigService::$cacheDriver)
                ->getStore() instanceof RedisStore) {
            if ($startDate ==
                Carbon::now()
                    ->toDateTimeString()) {
                //should delete the cache for user
                CacheHelper::deleteCacheKeys([
                                                 Cache::store(ConfigService::$cacheDriver)
                                                     ->getPrefix().'userId_'.$userId,
                                             ]);
            } else {
                $existingTTL = Redis::ttl(
                    Cache::store(ConfigService::$cacheDriver)
                        ->getPrefix().'userId_'.$userId
                );
                if ((Carbon::parse($startDate)
                        ->gt(Carbon::now())) &&
                    (($existingTTL == -2) ||
                        ($existingTTL >
                            Carbon::parse($startDate)
                                ->diffInSeconds(Carbon::now())))) {
                    CacheHelper::setTimeToLiveForKey(
                        Cache::store(ConfigService::$cacheDriver)
                            ->getPrefix().'userId_'.$userId,
                        Carbon::parse($startDate)
                            ->diffInSeconds(Carbon::now())
                    );
                }
            }
        }
    }
}