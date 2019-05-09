<?php

namespace Railroad\Railcontent\Decorators\Mobile;

use Railroad\Railcontent\Decorators\DecoratorInterface;
use Railroad\Railcontent\Services\ContentPermissionService;

class StripTagDecorator implements DecoratorInterface
{
    /**
     * @var ContentPermissionService
     *
     */
    private $contentPermissionService;

    /**
     * ContentPermissionsDecorator constructor.
     *
     * @param ContentPermissionService $contentPermissionService
     */
    public function __construct(ContentPermissionService $contentPermissionService)
    {
        $this->contentPermissionService = $contentPermissionService;
    }

    public function decorate(array $entities): array
    {
        $entityIds = [];

        foreach ($entities as $entity) {
            $entityIds[] = $entity->getId();
        }

        $contentPermissions = $this->contentPermissionService->getByContentTypeOrIds($entityIds, $entity->getType());

        foreach ($entities as $entity) {
            $permissionsForThisEntity = [];

            foreach ($contentPermissions as $contentPermission) {
                if ((!empty($contentPermission->getContent()) && $entity->getId() == $contentPermission->getContent()->getId())
                    || $entity->getType() == $contentPermission->getContentType()) {
                    $permissionsForThisEntity[] = $contentPermission;

                }
            }

            $entity->createProperty('permissions', $permissionsForThisEntity);
        }


        return $entities;
    }
}