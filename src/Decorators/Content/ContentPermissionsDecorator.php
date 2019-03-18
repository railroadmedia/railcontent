<?php

namespace Railroad\Railcontent\Decorators\Content;

use Railroad\Railcontent\Services\ContentPermissionService;
use Railroad\Resora\Decorators\DecoratorInterface;

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

    public function decorate($contents)
    {
        $permissions = $this->contentPermissionService->getByContentTypeOrId($contents->getId(), $contents->getType());

        $contents->createProperty('permissions', $permissions);

        return $contents;
    }
}