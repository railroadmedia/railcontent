<?php

namespace Railroad\Railcontent\Decorators\Content;

use Railroad\Railcontent\Decorators\DecoratorInterface;
use Railroad\Railcontent\Services\ContentPermissionService;

class ContentPermissionsDecorator implements DecoratorInterface
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

    public function decorate(array $entities)
    : array {
        foreach ($entities as $entity) {
            $permissions = $this->contentPermissionService->getByContentTypeOrId($entity->getId(), $entity->getType());

            $entity->createProperty('permissions', $permissions);
        }

        return $entities;
    }
}