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