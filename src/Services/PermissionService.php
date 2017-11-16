<?php

namespace Railroad\Railcontent\Services;

use Railroad\Railcontent\Repositories\ContentPermissionRepository;
use Railroad\Railcontent\Repositories\PermissionRepository;

/**
 * Class PermissionService
 *
 * @package Railroad\Railcontent\Services
 */
class PermissionService
{
    /**
     * @var PermissionRepository
     */
    public $permissionRepository;

    /**
     * @var ContentPermissionRepository
     */
    protected $contentPermissionRepository;

    /**
     * PermissionService constructor.
     *
     * @param PermissionRepository $permissionRepository
     * @param ContentPermissionRepository $contentPermissionRepository
     */
    public function __construct(
        PermissionRepository $permissionRepository,
        ContentPermissionRepository $contentPermissionRepository
    ) {
        $this->permissionRepository = $permissionRepository;
        $this->contentPermissionRepository = $contentPermissionRepository;
    }

    /**
     * Call getById method from PermissionRepository and return the permission
     *
     * @param integer $id
     * @return mixed
     */
    public function get($id)
    {
        return $this->permissionRepository->getById($id);
    }

    /**
     * @return array
     */
    public function getAll()
    {
        return $this->permissionRepository->getAll();
    }

    /**
     * Call the create method from PermissionRepository and return the new permission
     *
     * @param string $name
     * @param null $brand
     * @return mixed
     */
    public function create($name, $brand = null)
    {
        $permissionId = $this->permissionRepository->create(
            [
                'name' => $name,
                'brand' => $brand ?? ConfigService::$brand
            ]
        );

        return $this->get($permissionId);
    }

    /**
     * Call update method from PermissionRepository and return the updated permission
     *
     * @param integer $id
     * @param string $name
     * @param null $brand
     * @return mixed
     */
    public function update($id, $name, $brand = null)
    {
        //check if permission exist in the database
        $permission = $this->get($id);

        if (is_null($permission)) {
            return $permission;
        }

        $this->permissionRepository->update(
            $id,
            ['name' => $name, 'brand' => $brand ?? ConfigService::$brand]
        );

        return $this->get($id);
    }

    /**
     * Call delete method from PermissionRepository and return true if the permission was deleted
     *
     * @param integer $id
     * @return bool
     */
    public function delete($id)
    {
        //check if permission exist in the database
        $permission = $this->get($id);

        if (is_null($permission)) {
            return $permission;
        }
        $this->contentPermissionRepository->unlinkPermission($id);

        return $this->permissionRepository->delete($id) > 0;
    }
}