<?php

namespace Railroad\Railcontent\Services;

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
     * PermissionService constructor.
     *
     * @param PermissionRepository $permissionRepository
     */
    public function __construct(PermissionRepository $permissionRepository)
    {
        $this->permissionRepository = $permissionRepository;
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
     * Call the create method from PermissionRepository and return the new permission
     *
     * @param string $name
     * @return mixed
     */
    public function create($name)
    {
        $permissionId = $this->permissionRepository->create(['name' => $name]);

        return $this->get($permissionId);
    }

    /**
     * Call update method from PermissionRepository and return the updated permission
     *
     * @param integer $id
     * @param string $name
     * @return mixed
     */
    public function update($id, $name)
    {
        //check if permission exist in the database
        $permission = $this->get($id);

        if(is_null($permission)){
            return $permission;
        }

        $this->permissionRepository->update($id, ['name' => $name]);

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

        if(is_null($permission)){
            return $permission;
        }

        return $this->permissionRepository->delete($id) > 0;
    }
}