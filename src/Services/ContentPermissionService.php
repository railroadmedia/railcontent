<?php

namespace Railroad\Railcontent\Services;

use Railroad\Railcontent\Helpers\CacheHelper;
use Railroad\Railcontent\Repositories\ContentPermissionRepository;
use Railroad\Railcontent\Repositories\ContentRepository;

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
     * @var ContentRepository
     */
    private $contentRepository;

    /**
     * PermissionService constructor.
     *
     * @param ContentPermissionRepository $contentPermissionRepository
     */
    public function __construct(ContentPermissionRepository $contentPermissionRepository, ContentRepository $contentRepository)
    {
        $this->contentPermissionRepository = $contentPermissionRepository;
        $this->contentRepository = $contentRepository;
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

        foreach ($contentPermissions as $contentPermission) {
            if ($contentPermission['permission_id'] === $permissionId) {
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
        $results = $this->contentPermissionRepository->dissociate($contentId, $contentType, $permissionId);

        $this->clearAssociatedContentCache([$contentId], [$contentType]);

        return $results;
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

        $this->clearAssociatedContentCache([$contentId], [$contentType]);

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

    /** Clear the cache records associated with the content or the cache records associated with the contents that have the specified content type
     * @param int $contentId
     * @param string $contentType
     */
    private function clearAssociatedContentCache(array $contentIds, array $contentTypes)
    {
        foreach ($contentIds as $contentId) {
            CacheHelper::deleteCache('content_list_' . $contentId);
        }
        foreach ($contentTypes as $contentType) {
            $contents = $this->contentRepository->getByType($contentType);
            foreach ($contents as $content) {
                CacheHelper::deleteCache('content_list_' . $content['id']);
            }
        }
    }

}