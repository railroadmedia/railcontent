<?php

namespace App\Decorators\Content;

use App\Maps\ContentTypes;
use Railroad\Railcontent\Decorators\Decorator;
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

        $initialDecorationMode = \Railroad\Railcontent\Decorators\ModeDecoratorBase::$decorationMode;
        \Railroad\Railcontent\Decorators\ModeDecoratorBase::$decorationMode =
            \Railroad\Railcontent\Decorators\ModeDecoratorBase::DECORATION_MODE_MINIMUM;
        Decorator::$typeDecoratorsEnabled = false;

        $childHierarchyRows = $this->contentHierarchyService->getByParentIds(
            $contentsOfTypes->pluck('id')
                ->toArray()
        );
        \Railroad\Railcontent\Decorators\ModeDecoratorBase::$decorationMode = $initialDecorationMode;
        Decorator::$typeDecoratorsEnabled = true;

        if (empty($childHierarchyRows)) {
            return $contents;
        }

        $assignmentContents =
            $this->contentService->getByIds(array_column($childHierarchyRows, 'child_id'))
                ->keyBy('id');

        foreach ($contentsOfTypes as $contentIndex => $content) {
            $duration = 0;
            foreach ($childHierarchyRows as $childHierarchyRow) {
                if ($childHierarchyRow['parent_id'] == $content['id'] &&
                    !empty($assignmentContents[$childHierarchyRow['child_id']])) {
                    $duration += $assignmentContents[$childHierarchyRow['child_id']]->fetch('fields.length_in_seconds', 0);
                    $contentsOfTypes[$contentIndex]['assignments'][] =
                        $assignmentContents[$childHierarchyRow['child_id']];
                }
            }

            $contentsOfTypes[$contentIndex]['assignments'] = $contentsOfTypes[$contentIndex]['assignments'] ?? [];
            $contentsOfTypes[$contentIndex]['assignments_duration'] = $duration;
        }

        return $this->mergeDecorated($contents, $contentsOfTypes);
    }
}
