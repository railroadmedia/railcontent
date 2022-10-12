<?php

namespace Railroad\Railcontent\Services;


use Illuminate\Database\DatabaseManager;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\ValueObjects\NextPreviousContentVO;

class MethodService
{
    /**
     * @var DatabaseManager
     */
    private $databaseManager;
    /**
     * @var ContentService
     */
    private $contentService;

    public function __construct(DatabaseManager $databaseManager, ContentService $contentService)
    {
        $this->databaseManager = $databaseManager;
        $this->contentService = $contentService;
    }

    /**
     * @param $lessonId
     * @param $methodLearningPathId
     * @return NextPreviousContentVO
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getNextAndPreviousLessons($lessonId, $methodLearningPathId)
    {
        $levelHierarchyData =
            $this->databaseManager->connection(config('railcontent.database_connection_name'))
                ->table('railcontent_content_hierarchy')
                ->where('railcontent_content_hierarchy.parent_id', $methodLearningPathId)
                ->orderBy('child_position', 'asc')
                ->get(['parent_id', 'child_id', 'child_position']);

        $courseHierarchyData =
            $this->databaseManager->connection(config('railcontent.database_connection_name'))
                ->table('railcontent_content_hierarchy')
                ->whereIn(
                    'railcontent_content_hierarchy.parent_id',
                    $levelHierarchyData->pluck('child_id')
                        ->toArray()
                )
                ->orderBy('child_position', 'asc')
                ->get(['parent_id', 'child_id', 'child_position']);

        $courseHierarchyDataGrouped = $courseHierarchyData->groupBy('parent_id');

        $lessonHierarchyData =
            $this->databaseManager->connection(config('railcontent.database_connection_name'))
                ->table('railcontent_content_hierarchy')
                ->leftJoin(
                    'railcontent_content',
                    'railcontent_content_hierarchy.child_id',
                    '=',
                    'railcontent_content.id'
                )
                ->whereIn(
                    'railcontent_content_hierarchy.parent_id',
                    $courseHierarchyData->pluck('child_id')
                        ->toArray()
                )
                ->where('railcontent_content.type', '=', 'learning-path-lesson')
                ->orderBy('child_position', 'asc')
                ->get(['parent_id', 'child_id', 'child_position'])
                ->groupBy('parent_id');

        // make array of all the lessons in the order of hierarchy
        $lessonIds = [];

        foreach ($levelHierarchyData as $levelHierarchy) {
            foreach ($courseHierarchyDataGrouped[$levelHierarchy->child_id] ?? [] as $courseHierarchy) {
                if ($lessonHierarchyData->isNotEmpty()) {
                    foreach ($lessonHierarchyData[$courseHierarchy->child_id] ?? [] as $lessonHierarchy) {
                        $lessonIds[] = $lessonHierarchy->child_id;
                    }
                } else {
                    $lessonIds[] = $courseHierarchy->child_id;
                }
            }
        }

        $previousLesson = null;
        $nextLesson = null;

        foreach ($lessonIds as $lessonIdIndex => $allLessonId) {
            if ($allLessonId == $lessonId) {
                if (isset($lessonIds[$lessonIdIndex - 1])) {
                    $previousLesson = $this->contentService->getById($lessonIds[$lessonIdIndex - 1]);
                }
                if (isset($lessonIds[$lessonIdIndex + 1])) {
                    $nextLesson = $this->contentService->getById($lessonIds[$lessonIdIndex + 1]);
                }
            }
        }

        return new NextPreviousContentVO($nextLesson, $previousLesson);
    }
}
