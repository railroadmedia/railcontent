<?php

namespace Railroad\Railcontent\Services;

use Doctrine\ORM\EntityManager;
use Railroad\Railcontent\Entities\Content;
use Railroad\Railcontent\Entities\ContentPermission;
use Railroad\Railcontent\Entities\Permission;
use Railroad\Railcontent\Repositories\ContentPermissionRepository;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Repositories\PermissionRepository;

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
     * @var PermissionRepository
     */
    private $permissionRepository;

    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * PermissionService constructor.
     *
     * @param ContentPermissionRepository $contentPermissionRepository
     */
    public function __construct(
        EntityManager $entityManager
    ) {
        $this->entityManager = $entityManager;

        $this->contentPermissionRepository = $this->entityManager->getRepository(ContentPermission::class);
        $this->contentRepository = $this->entityManager->getRepository(Content::class);
        $this->permissionRepository = $this->entityManager->getRepository(Permission::class);
    }

    /**
     * @param integer $id
     * @return mixed
     */
    public function _get($id)
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
        $q = $this->entityManager->createQuery(
            'delete from ' .
            ContentPermission::class .
            ' cp where cp.permission = :permissionId and (cp.content = :contentId or cp.contentType = :contentType)'
        )
            ->setParameters(
                ['permissionId' => $permissionId, 'contentId' => $contentId, 'contentType' => $contentType]
            );

        $q->execute();

        $this->entityManager->getCache()
            ->evictEntityRegion(Content::class);

        return true;
    }

    /**
     * @param int|null $contentId
     * @param string|null $contentType
     * @param int $permissionId
     * @return mixed
     */
    public function create($contentId = null, $contentType = null, $permissionId, $brand = null)
    {
        $content = null;
        if ($contentId) {
            $content = $this->contentRepository->find($contentId);
        }

        $permission = $this->permissionRepository->find($permissionId);

        $contentPermission = new ContentPermission();
        $contentPermission->setBrand($brand ?? ConfigService::$brand);
        $contentPermission->setContentType($contentType);
        $contentPermission->setContent($content);
        $contentPermission->setPermission($permission);

        $this->entityManager->persist($contentPermission);
        $this->entityManager->flush();

        $this->entityManager->getCache()
            ->evictEntityRegion(Content::class);

        return $contentPermission;
    }
}