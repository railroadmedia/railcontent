<?php

namespace Railroad\Railcontent\Decorators\Content;

use Railroad\Railcontent\Helpers\ContentHelper;
use Railroad\Railcontent\Repositories\ContentPermissionRepository;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Resora\Decorators\DecoratorInterface;

class ContentPermissionsDecorator implements DecoratorInterface
{
    /**
     * @var ContentPermissionRepository
     */
    private $contentPermissionsRepository;

    public function __construct(ContentPermissionRepository $contentPermissionsRepository)
    {
        $this->contentPermissionsRepository = $contentPermissionsRepository;
    }

    public function decorate($contents)
    {
        $contentPermissions =
            $this->contentPermissionsRepository->query()
                ->select([config('railcontent.table_prefix'). 'content_permissions' . '.*', config('railcontent.table_prefix'). 'permissions' . '.name'])
                ->join(
                    config('railcontent.table_prefix'). 'permissions',
                    config('railcontent.table_prefix'). 'permissions' . '.id',
                    '=',
                    config('railcontent.table_prefix'). 'content_permissions' . '.permission_id'
                )
                ->whereIn('content_id', $contents->pluck('id'))
                ->orWhereIn('content_type', $contents->pluck('type'))
                ->get()
                ->toArray();

        $permissionRowsGroupedById = ContentHelper::groupArrayBy($contentPermissions, 'content_id');
        $permissionRowsGroupedByType = ContentHelper::groupArrayBy($contentPermissions, 'content_type');

        foreach ($contents as $index => $content) {
            if (empty($contentPermissions)) {
                $contents[$index]['permissions'] = [];
            } else {
                $contents[$index]['permissions'] = array_merge(
                    $permissionRowsGroupedById[$content['id']] ?? [],
                    (array_key_exists('type', $content) &&
                        array_key_exists($content['type'], $permissionRowsGroupedByType)) ?
                        $permissionRowsGroupedByType[$content['type']] : []
                );
            }
        }

        return $contents;
    }
}