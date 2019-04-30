<?php

namespace Railroad\Railcontent\Decorators\Mobile;

use Railroad\Railcontent\Decorators\DecoratorInterface;
use Railroad\Railcontent\Services\ContentHierarchyService;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Support\Collection;

class LessonAssignmentDecorator implements DecoratorInterface
{
    /**
     * @var ContentService
     */
    protected $contentService;

    /**
     * @var ContentHierarchyService
     */
    protected $contentHierarchyService;

    public function __construct(
        ContentService $contentService,
        ContentHierarchyService $contentHierarchyService
    ) {
        $this->contentService = $contentService;
        $this->contentHierarchyService = $contentHierarchyService;
    }

    public function decorate(Collection $contents)
    {
        $contentsOfTypes = $contents->whereIn(
            'type',
            array_merge(
                array_keys(config('railcontent.shows')),
                [
                    'pack-bundle-lesson',
                    'course-part',
                    'play-along',
                    'song',
                    'student-focus',
                    'rudiment',
                    'semester-pack-lesson',
                ]
            )
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
                    // xp
                    if (!isset($contentsOfTypes[$contentIndex]['xp'])) {
                        $contentsOfTypes[$contentIndex]['xp'] = 0;
                    }
                    $contentsOfTypes[$contentIndex]['xp'] += config(
                        'xp_ranks.assignment_content_completed'
                    );
                }
            }
            $contentsOfTypes[$contentIndex]['assignments'] = $contentsOfTypes[$contentIndex]['assignments'] ?? [];
        }

        foreach ($contents as $originalContentIndex => $originalContent) {
            foreach ($contentsOfTypes as $decoratedContent) {
                if ($decoratedContent['id'] == $originalContent['id']) {
                    $contents[$originalContentIndex] = $decoratedContent;
                }
            }
        }

        return $contents;
    }
}