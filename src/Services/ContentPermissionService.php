<?php

namespace Railroad\Railcontent\Services;

use Railroad\Railcontent\Repositories\ContentPermissionRepository;

/**
 * Class PermissionService
 *
 * @package Railroad\Railcontent\Services
 */
class ContentPermissionService
{
    /**
     * @var ContentPermissionRepository
     */
    private $contentPermissionRepository;

    /**
     * PermissionService constructor.
     *
     * @param ContentPermissionRepository $contentPermissionRepository
     */
    public function __construct(ContentPermissionRepository $contentPermissionRepository)
    {
        $this->contentPermissionRepository = $contentPermissionRepository;
    }

    /**
     * @param integer $id
     * @return mixed
     */
    public function get($id)
    {
        return $this->contentPermissionRepository->getById($id);
    }

    /**
     * @param null $contentId
     * @param null $contentType
     * @param $permissionId
     * @return array
     */
    public function getByContentTypeOrIdAndByPermissionId($contentId = null, $contentType = null, $permissionId)
    {
        $contentPermissions = $this->contentPermissionRepository->getByContentIdsOrTypes([$contentId], [$contentType]);

        $contentPermissionsMatchingPermissionId = [];

        foreach($contentPermissions as $contentPermission){
            if($contentPermission['permission_id'] === $permissionId){
                $contentPermissionsMatchingPermissionId[] = $contentPermission;
            }
        }

        return $contentPermissionsMatchingPermissionId;
    }


    /**
     * @param null $contentId
     * @param null $contentType
     * @param $permissionId
     * @return array
     */
    public function dissociate($contentId = null, $contentType = null, $permissionId)
    {
        return $this->contentPermissionRepository->dissociate($contentId, $contentType, $permissionId);
    }

    /**
     * @param int|null $contentId
     * @param string|null $contentType
     * @param int $permissionId
     * @return mixed
     */
    public function create($contentId = null, $contentType = null, $permissionId)
    {
        $id = $this->contentPermissionRepository->create(
            [
                'content_id' => $contentId,
                'content_type' => $contentType,
                'permission_id' => $permissionId,
            ]
        );

        return $this->get($id);
    }

    /**
     * @param integer $id
     * @param array $data
     * @return mixed
     */
    public function update($id, array $data)
    {
        $this->contentPermissionRepository->update($id, $data);

        return $this->get($id);
    }

    /**
     * @param integer $id
     * @return bool
     */
    public function delete($id)
    {
        return $this->contentPermissionRepository->delete($id) > 0;
    }
}