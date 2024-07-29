<?php

namespace Railroad\Railcontent\Decorators\Entity;

use App\Decorators\Content\TypeDecoratorBase;
use Railroad\Railcontent\Entities\ContentEntity;
use Railroad\Railcontent\Services\PermissionService;
use Railroad\Railcontent\Support\Collection;

class ContentEntityDecorator extends TypeDecoratorBase
{
    public function decorate(Collection $contentResults)
    {
        if (isset($contentResults['id'])) {

            // convert field linked contents to entities as well
            foreach ($contentResults['fields'] as $fieldIndex => $field) {
                if (isset($field['value']['slug'])) {
                    $contentResults['fields'][$fieldIndex]['value'] = new ContentEntity($field['value']);
                }
            }

            return new ContentEntity($contentResults);
        }

        $entities = [];

        foreach ($contentResults as $resultsIndex => $result) {
            $entities[$resultsIndex] = new ContentEntity($result);

            // convert field linked contents to entities as well
            foreach ($result['fields'] ?? [] as $fieldIndex => $field) {
                if (isset($field['value']['slug'])) {
                    if ($field['value'] instanceof ContentEntity) {
                        $entities[$resultsIndex]['fields'][$fieldIndex]['value'] = $field['value'];
                    } else {
                        $entities[$resultsIndex]['fields'][$fieldIndex]['value'] = new ContentEntity($field['value']);
                    }
                }
            }
            foreach ($result['lessons'] ?? [] as $index => $field) {
                if (isset($field['slug'])) {
                    $entities[$resultsIndex]['lessons'][$index] = new ContentEntity($field);
                }
            }
        }

        return new Collection($entities);
    }

    private function setUserHasAccess($contentIds) : void
    {

        $contentPermissionRows = collect(
            $this->contentPermissionRepository->getByContentIdsOrTypes(
                $contentIds,
                [])
        );
        $groupedPermissions = $contentPermissionRows->groupBy('content_id');
        $userPermissions = $this->userPermissionsRepository->getUserPermissions(user()->id, true);
        $userPermissionIds = \Arr::pluck($userPermissions, 'permission_id');
        $membershipPermissionIds = [1, 52, 73, 77,];
        if (!empty(array_intersect($userPermissionIds, $membershipPermissionIds))) {
            $userPermissionIds = array_merge($userPermissionIds, $membershipPermissionIds);
        }



    }
}
