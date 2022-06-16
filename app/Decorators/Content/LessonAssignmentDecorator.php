<?php

namespace App\Decorators\Content;

use App\Maps\ContentTypes;
use Railroad\Railcontent\Support\Collection;

class LessonAssignmentDecorator extends TypeDecoratorBase
{
    public static $skip = false;

    public function decorate(Collection $contents)
    {
        if (self::$decorationMode !== self::DECORATION_MODE_MAXIMUM || self::$skip) {
            return $contents;
        }

        $contentsOfTypes = $contents->whereIn(
            'type',
            ContentTypes::singularContentTypes()
        );

        $childHierarchyRows = $this->contentHierarchyService->getByParentIds(
            $contentsOfTypes->pluck('id')
                ->toArray()
        );

        if (empty($childHierarchyRows)) {
            return $contents;
        }

        $assignmentContents =
            $this->contentService->getByIds(array_column($childHierarchyRows, 'child_id'))
                ->keyBy('id');

        foreach ($contentsOfTypes as $contentIndex => $content) {

            foreach ($childHierarchyRows as $childHierarchyRow) {
                if ($childHierarchyRow['parent_id'] == $content['id'] &&
                    !empty($assignmentContents[$childHierarchyRow['child_id']])) {

                    $contentsOfTypes[$contentIndex]['assignments'][] =
                        $assignmentContents[$childHierarchyRow['child_id']];
                }
            }

            $contentsOfTypes[$contentIndex]['assignments'] = $contentsOfTypes[$contentIndex]['assignments'] ?? [];
        }

        return $this->mergeDecorated($contents, $contentsOfTypes);
    }
}
