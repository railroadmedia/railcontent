<?php
/**
 * Created by PhpStorm.
 * User: roxana
 * Date: 9/7/2017
 * Time: 10:13 AM
 */

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
     * Call the create method from PermissionRepository and return the new permission
     *
     * @param string $name
     * @return mixed
     */
    public function store($name)
    {
        $permissionId = $this->permissionRepository->create($name);

        return $this->getById($permissionId);
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
        $this->permissionRepository->update($id, $name);

        return $this->getById($id);
    }

    /**
     * Call delete method from PermissionRepository and return true if the permission was deleted
     *
     * @param integer $id
     * @return bool
     */
    public function delete($id)
    {
        return $this->permissionRepository->delete($id) > 0;
    }

    /**
     * Call getById method from PermissionRepository and return the permission
     *
     * @param integer $id
     * @return mixed
     */
    public function getById($id)
    {
        return $this->permissionRepository->getById($id);
    }

    /**
     * Call the method that check if the permission it's linked with content ids or content types from PermissionRepository
     * and return the content ids, content types that are linked
     *
     * @param integer $id
     * @return mixed
     */
    public function linkedWithContent($id)
    {
        return $this->permissionRepository->linkedWithContent($id);
    }

    /**
     * Attach permission to a specific content($contentId) or to all content of a certain type($contentType)
     * @param integer $permissionId
     * @param integer|null $contentId
     * @param string|null $contentType
     * @return mixed
     */
    public function assign($permissionId, $contentId, $contentType)
    {
        return $this->permissionRepository->assign($permissionId, $contentId, $contentType) > 0;
    }
}