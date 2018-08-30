<?php

namespace Railroad\Railcontent\Services;

use Carbon\Carbon;
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

    /** Save user permission record in database
     *
     * @param integer $userId
     * @param integer $permissionId
     * @param date $startDate
     * @param date|null $expirationDate
     * @return array
     */
    public function create($userId, $permissionId, $startDate, $expirationDate = null)
    {
        $userPermission = $this->userPermissionsRepository->create(
            [
                'user_id' => $userId,
                'permission_id' => $permissionId,
                'start_date' => $startDate,
                'expiration_date' => $expirationDate,
                'created_on' => Carbon::now()
                    ->toDateTimeString(),
            ]
        );
        if ($startDate ==
            Carbon::now()
                ->toDateTimeString()) {
            //should delete the cache for user
            CacheHelper::deleteCache('keys_for_userId_' . $userId);
        } else {

            //should set expiration date for user cache key to user permission start date
            CacheHelper::setTimeToLiveForKeys(
                CacheHelper::getListElement('keys_for_userId_' . $userId),
                Carbon::parse($startDate)->timestamp
            );
        }

        return $this->userPermissionsRepository->getById($userPermission);
    }

    /** Save user permission record in database
     *
     * @param integer $userId
     * @param integer $permissionId
     * @param date $startDate
     * @param date|null $expirationDate
     * @return array
     */
    public function updateOrCeate($attributes, $values)
    {
        $userPermission = $this->userPermissionsRepository->updateOrCreate($attributes, $values);

        return $this->userPermissionsRepository->getById($userPermission);
    }

    /** Call the method that update the user permissions and return an array with the updated data
     *
     * @param  int $id
     * @param array $data
     * @return array
     */
    public function update($id, array $data)
    {
        $this->userPermissionsRepository->update(
            $id,
            array_merge(
                $data,
                [
                    'updated_on' => Carbon::now()
                        ->toDateTimeString(),
                ]
            )
        );

        return $this->userPermissionsRepository->getById($id);
    }

    /** Call the method that delete the user permission, if the user permission exists in the database
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

        //should delete the cache for user
        CacheHelper::deleteCache('keys_for_userId_' . $userPermission['user_id']);

        return $this->userPermissionsRepository->delete($id);
    }

    /** Call the method from repository that pull user permissions and return an array with the results
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
}