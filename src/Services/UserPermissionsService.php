<?php

namespace Railroad\Railcontent\Services;

use Carbon\Carbon;
use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Railroad\Railcontent\Contracts\UserProviderInterface;
use Railroad\Railcontent\Entities\Content;
use Railroad\Railcontent\Entities\Permission;
use Railroad\Railcontent\Entities\UserPermission;
use Railroad\Railcontent\Managers\RailcontentEntityManager;

class UserPermissionsService
{
    /**
     * @var RailcontentEntityManager
     */
    private $entityManager;

    /**
     * @var ObjectRepository|EntityRepository
     */
    private $userPermissionsRepository;

    /**
     * @var UserProviderInterface
     */
    private $userProvider;

    /**
     * UserPermissionsService constructor.
     *
     * @param RailcontentEntityManager $entityManager
     * @param UserProviderInterface $userProvider
     */
    public function __construct(
        RailcontentEntityManager $entityManager,
        UserProviderInterface $userProvider
    ) {
        $this->entityManager = $entityManager;
        $this->userProvider = $userProvider;

        $this->userPermissionsRepository = $this->entityManager->getRepository(UserPermission::class);
    }

    /** Save/update user permission
     *
     * @param $attributes
     * @param $values
     * @return object|UserPermission|null
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function updateOrCeate($attributes, $values)
    {
        $user = $this->userProvider->getUserById($attributes['user_id']);

        if (array_key_exists('start_date', $values)) {
            $ttlEndDate = $values['start_date'];
            if (Carbon::parse($values['start_date'])
                ->lt(Carbon::now())

            ) {
                $ttlEndDate = $values['expiration_date'] ?? Carbon::now();
            }
            $this->setTTLOrDeleteUserCache($attributes['user_id'], $ttlEndDate);
        }

        $permission =
            $this->entityManager->getRepository(Permission::class)
                ->find($attributes['permission_id']);

        $userPermission = $this->userPermissionsRepository->findOneBy(
            [
                'user' => $user,
                'permission' => $permission,

            ]
        );

        if (!$userPermission) {
            $userPermission = new UserPermission();
            $userPermission->setUser($user);
            $userPermission->setPermission($permission);
        }

        $userPermission->setStartDate(Carbon::parse($values['start_date']));
        $userPermission->setExpirationDate(
            $values['expiration_date'] ? Carbon::parse($values['expiration_date']) : null
        );
        $this->entityManager->persist($userPermission);
        $this->entityManager->flush();

        $this->entityManager->getCache()
            ->evictEntityRegion(Content::class);

        return $userPermission;
    }

    /** Call the method that delete the user permission, if the user permission exists
     *
     * @param $id
     * @return bool|object|null
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function delete($id)
    {
        $userPermission = $this->userPermissionsRepository->find($id);
        if (is_null($userPermission)) {
            return $userPermission;
        }

        $this->entityManager->remove($userPermission);
        $this->entityManager->flush();

        $this->entityManager->getCache()
            ->evictEntityRegion(Content::class);

        $this->entityManager->getCache()
            ->evictEntity(UserPermission::class, 'permission');

        return true;
    }

    /** Call the method from repository that pull user permissions and return an array with the results
     *
     * @param null $userId
     * @param bool $onlyActive
     * @return array
     */
    public function getUserPermissions($userId = null, $onlyActive = true)
    {
        return $this->userPermissionsRepository->getUserPermissions($userId, $onlyActive);
    }

    /**
     * @param $userId
     * @param $permissionId
     * @return object|null
     */
    public function getUserPermissionIdByPermissionAndUser($userId, $permissionId)
    {
        $userPermission = $this->userPermissionsRepository->findOneBy(
            [
                'userId' => $userId,
                'permission' => $this->entityManager->getRepository(Permission::class)
                    ->find($permissionId),
            ]
        );
        return $userPermission;
    }

    /**
     * @param $userId
     * @param $permissionName
     * @return bool
     */
    public function userHasPermissionName($userId, $permissionName)
    {
        $userPermission = $this->userPermissionsRepository->findOneBy(
            [
                'userId' => $userId,
                'permission' => $this->entityManager->getRepository(Permission::class)
                    ->findOneBy(['name' => $permissionName]),
            ]
        );

        return $userPermission ? true : false;
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
        $regionConfig =
            $this->entityManager->getConfiguration()
                ->getSecondLevelCacheConfiguration();

        if ($startDate ==
            Carbon::now()
                ->toDateTimeString()) {

            //should delete the cache for user
            $this->entityManager->getCache()
                ->evictEntityRegion(Content::class);
        } else {

            $existingTTL =
                $regionConfig->getRegionsConfiguration()
                    ->getDefaultLifetime();

            if ((Carbon::parse($startDate)
                    ->gte(Carbon::now()) &&
                (($existingTTL == -2) ||
                    ($existingTTL >
                        Carbon::parse($startDate)
                            ->diffInSeconds(Carbon::now()))))) {
                $regionConfig->getRegionsConfiguration()
                    ->setDefaultLifetime(
                        Carbon::parse($startDate)
                            ->diffInSeconds(Carbon::now())
                    );
            }
        }

        $this->entityManager->getCache()
            ->evictEntity(UserPermission::class, 'permission');
    }
}