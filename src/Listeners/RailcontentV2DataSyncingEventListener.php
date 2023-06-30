<?php

namespace Railroad\Railcontent\Listeners;

use Illuminate\Database\DatabaseManager;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Railroad\Railcontent\Events\ContentCreated;
use Railroad\Railcontent\Events\ContentDatumCreated;
use Railroad\Railcontent\Events\ContentDatumDeleted;
use Railroad\Railcontent\Events\ContentDatumUpdated;
use Railroad\Railcontent\Events\ContentDeleted;
use Railroad\Railcontent\Events\ContentFieldCreated;
use Railroad\Railcontent\Events\ContentFieldDeleted;
use Railroad\Railcontent\Events\ContentFieldUpdated;
use Railroad\Railcontent\Events\ContentSoftDeleted;
use Railroad\Railcontent\Events\ContentUpdated;
use Railroad\Railcontent\Events\HierarchyUpdated;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Repositories\RepositoryBase;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Services\RailcontentV2DataSyncingService;

class RailcontentV2DataSyncingEventListener
{
    /**
     * @var ContentService
     */
    private $contentService;

    /**
     * @var DatabaseManager
     */
    private $databaseManager;

    /**
     * @var RailcontentV2DataSyncingService
     */
    private $railcontentV2DataSyncingService;

    /**
     * @var ContentRepository
     */
    private $contentRepository;

    public function __construct(
        ContentService $contentService,
        DatabaseManager $databaseManager,
        RailcontentV2DataSyncingService $railcontentV2DataSyncingService,
        ContentRepository $contentRepository
    ) {
        $this->contentService = $contentService;
        $this->databaseManager = $databaseManager;
        $this->railcontentV2DataSyncingService = $railcontentV2DataSyncingService;
        $this->contentRepository = $contentRepository;
    }

    public function handleContentCreated(ContentCreated $contentCreated)
    {
        $this->railcontentV2DataSyncingService->syncContentId($contentCreated->contentId);
        $this->contentService->fillParentContentDataColumnForContentIds(Arr::wrap($contentCreated->contentId));
        $this->contentService->fillCompiledViewContentDataColumnForContentIds(Arr::wrap($contentCreated->contentId));
        $this->fillCompiledViewContentDataColumnForAllParentsAndChildren($contentCreated->contentId);
    }

    public function handleContentUpdated(ContentUpdated $contentUpdated)
    {
        $this->railcontentV2DataSyncingService->syncContentId($contentUpdated->contentId);
        $this->contentService->fillParentContentDataColumnForContentIds(Arr::wrap($contentUpdated->contentId));
        $this->contentService->fillCompiledViewContentDataColumnForContentIds(Arr::wrap($contentUpdated->contentId));
        $this->fillCompiledViewContentDataColumnForAllParentsAndChildren($contentUpdated->contentId);
    }

    public function handleContentDeleted(ContentDeleted $contentDeleted)
    {
        $this->railcontentV2DataSyncingService->syncContentId($contentDeleted->contentId);
        $this->contentService->fillParentContentDataColumnForContentIds(Arr::wrap($contentDeleted->contentId));
        $this->contentService->fillCompiledViewContentDataColumnForContentIds(Arr::wrap($contentDeleted->contentId));
        $this->fillCompiledViewContentDataColumnForAllParentsAndChildren($contentDeleted->contentId);
    }

    public function handleContentSoftDeleted(ContentSoftDeleted $contentSoftDeleted)
    {
        $this->railcontentV2DataSyncingService->syncContentId($contentSoftDeleted->contentId);
        $this->contentService->fillParentContentDataColumnForContentIds(Arr::wrap($contentSoftDeleted->contentId));
        $this->contentService->fillCompiledViewContentDataColumnForContentIds(
            Arr::wrap($contentSoftDeleted->contentId)
        );
        $this->fillCompiledViewContentDataColumnForAllParentsAndChildren($contentSoftDeleted->contentId);
    }

    public function handleContentFieldCreated(ContentFieldCreated $contentFieldCreated)
    {
        $this->railcontentV2DataSyncingService->syncContentId($contentFieldCreated->newField['content_id']);
        $this->contentService->fillParentContentDataColumnForContentIds(
            Arr::wrap($contentFieldCreated->newField['content_id'])
        );
        $this->contentService->fillCompiledViewContentDataColumnForContentIds(
            Arr::wrap($contentFieldCreated->newField['content_id'])
        );
        $this->fillCompiledViewContentDataColumnForAllParentsAndChildren($contentFieldCreated->newField['content_id']);
    }

    public function handleContentFieldUpdated(ContentFieldUpdated $contentFieldUpdated)
    {
        $this->railcontentV2DataSyncingService->syncContentId($contentFieldUpdated->newField['content_id']);
        $this->contentService->fillParentContentDataColumnForContentIds(
            Arr::wrap($contentFieldUpdated->newField['content_id'])
        );
        $this->contentService->fillCompiledViewContentDataColumnForContentIds(
            Arr::wrap($contentFieldUpdated->newField['content_id'])
        );
        $this->fillCompiledViewContentDataColumnForAllParentsAndChildren($contentFieldUpdated->newField['content_id']);
    }

    public function handleContentFieldDeleted(ContentFieldDeleted $contentFieldDeleted)
    {
        $this->railcontentV2DataSyncingService->syncContentId($contentFieldDeleted->deletedField['content_id']);
        $this->contentService->fillParentContentDataColumnForContentIds(
            Arr::wrap($contentFieldDeleted->deletedField['content_id'])
        );
        $this->contentService->fillCompiledViewContentDataColumnForContentIds(
            Arr::wrap($contentFieldDeleted->deletedField['content_id'])
        );
        $this->fillCompiledViewContentDataColumnForAllParentsAndChildren(
            $contentFieldDeleted->deletedField['content_id']
        );
    }

    public function handleContentDatumCreated(ContentDatumCreated $contentDatumCreated)
    {
        $this->railcontentV2DataSyncingService->syncContentId($contentDatumCreated->contentId);
        $this->contentService->fillParentContentDataColumnForContentIds(Arr::wrap($contentDatumCreated->contentId));
        $this->contentService->fillCompiledViewContentDataColumnForContentIds(
            Arr::wrap($contentDatumCreated->contentId)
        );
        $this->fillCompiledViewContentDataColumnForAllParentsAndChildren($contentDatumCreated->contentId);
    }

    public function handleContentDatumUpdated(ContentDatumUpdated $contentDatumUpdated)
    {
        $this->railcontentV2DataSyncingService->syncContentId($contentDatumUpdated->contentId);
        $this->contentService->fillParentContentDataColumnForContentIds(Arr::wrap($contentDatumUpdated->contentId));
        $this->contentService->fillCompiledViewContentDataColumnForContentIds(
            Arr::wrap($contentDatumUpdated->contentId)
        );
        $this->fillCompiledViewContentDataColumnForAllParentsAndChildren($contentDatumUpdated->contentId);
    }

    public function handleContentDatumDeleted(ContentDatumDeleted $contentDatumDeleted)
    {
        $this->railcontentV2DataSyncingService->syncContentId($contentDatumDeleted->contentId);
        $this->contentService->fillParentContentDataColumnForContentIds(Arr::wrap($contentDatumDeleted->contentId));
        $this->contentService->fillCompiledViewContentDataColumnForContentIds(
            Arr::wrap($contentDatumDeleted->contentId)
        );
        $this->fillCompiledViewContentDataColumnForAllParentsAndChildren($contentDatumDeleted->contentId);
    }

    public function handleHierarchyUpdated(HierarchyUpdated $hierarchyUpdated)
    {
        $this->railcontentV2DataSyncingService->syncContentId($hierarchyUpdated->parentId);
        $this->contentService->fillParentContentDataColumnForContentIds(Arr::wrap($hierarchyUpdated->parentId));
        $this->fillCompiledViewContentDataColumnForAllParentsAndChildren($hierarchyUpdated->parentId);
    }

    public function updateContentsThatLinkToContentViaField($contentId)
    {
        $this->contentRepository->connectionMask()
            ->table('railcontent_content_fields')
            ->whereIn('key', ['instructor', 'video'])
            ->where('value', $contentId)
            ->orderBy('id')
            ->chunk(250, function (Collection $rows) {
                $this->contentService->fillCompiledViewContentDataColumnForContentIds(
                    $rows->pluck('content_id')->unique()->toArray()
                );
            });
    }

    public function updateAllContentsChildrenParentDataColumns($contentId)
    {
        $hierarchyRows = $this->contentRepository->connectionMask()
            ->table(config('railcontent.table_prefix') . 'content_hierarchy as rch1')
            ->leftJoin(
                config('railcontent.table_prefix') . 'content as rcp1',
                'rcp1.id',
                '=',
                'rch1.child_id'
            )
            ->leftJoin(
                config('railcontent.table_prefix') . 'content_hierarchy as rch2',
                'rch2.parent_id',
                '=',
                'rch1.child_id'
            )
            ->leftJoin(
                config('railcontent.table_prefix') . 'content as rcp2',
                'rcp2.id',
                '=',
                'rch2.child_id'
            )
            ->leftJoin(
                config('railcontent.table_prefix') . 'content_hierarchy as rch3',
                'rch3.parent_id',
                '=',
                'rch2.child_id'
            )
            ->leftJoin(
                config('railcontent.table_prefix') . 'content as rcp3',
                'rcp3.id',
                '=',
                'rch3.child_id'
            )
            ->leftJoin(
                config('railcontent.table_prefix') . 'content_hierarchy as rch4',
                'rch4.parent_id',
                '=',
                'rch3.child_id'
            )
            ->leftJoin(
                config('railcontent.table_prefix') . 'content as rcp4',
                'rcp4.id',
                '=',
                'rch4.child_id'
            )
            ->select(
                [
                    'rch1.child_id as rch1_child_id',
                    'rch1.parent_id as rch1_parent_id',
                    'rch1.child_position as rch1_child_position',
                    'rcp1.id as rcp1_content_id',
                    'rcp1.slug as rcp1_content_slug',
                    'rcp1.type as rcp1_content_type',
                    'rch2.child_id as rch2_child_id',
                    'rch2.parent_id as rch2_parent_id',
                    'rch2.child_position as rch2_child_position',
                    'rcp2.id as rcp2_content_id',
                    'rcp2.slug as rcp2_content_slug',
                    'rcp2.type as rcp2_content_type',
                    'rch3.child_id as rch3_child_id',
                    'rch3.parent_id as rch3_parent_id',
                    'rch3.child_position as rch3_child_position',
                    'rcp3.id as rcp3_content_id',
                    'rcp3.slug as rcp3_content_slug',
                    'rcp3.type as rcp3_content_type',
                    'rch4.child_id as rch4_child_id',
                    'rch4.parent_id as rch4_parent_id',
                    'rch4.child_position as rch4_child_position',
                    'rcp4.id as rcp4_content_id',
                    'rcp4.slug as rcp4_content_slug',
                    'rcp4.type as rcp4_content_type',
                ]
            )
            ->where('rch1.parent_id', $contentId)
            ->get();

        $childIdsToProcess = [];

        foreach ($hierarchyRows as $hierarchyRow) {
            if (!empty($hierarchyRow['rch1_child_id'])) {
                $childIdsToProcess[] = $hierarchyRow['rch1_child_id'];
            }
            if (!empty($hierarchyRow['rch2_child_id'])) {
                $childIdsToProcess[] = $hierarchyRow['rch2_child_id'];
            }
            if (!empty($hierarchyRow['rch3_child_id'])) {
                $childIdsToProcess[] = $hierarchyRow['rch3_child_id'];
            }
            if (!empty($hierarchyRow['rch4_child_id'])) {
                $childIdsToProcess[] = $hierarchyRow['rch4_child_id'];
            }
        }

        $this->contentService->fillParentContentDataColumnForContentIds($childIdsToProcess);
    }

    public function fillCompiledViewContentDataColumnForAllParentsAndChildren($contentId)
    {
        $childHierarchyRows = $this->contentRepository->connectionMask()
            ->table(config('railcontent.table_prefix') . 'content_hierarchy as rch1')
            ->leftJoin(
                config('railcontent.table_prefix') . 'content as rcp1',
                'rcp1.id',
                '=',
                'rch1.child_id'
            )
            ->leftJoin(
                config('railcontent.table_prefix') . 'content_hierarchy as rch2',
                'rch2.parent_id',
                '=',
                'rch1.child_id'
            )
            ->leftJoin(
                config('railcontent.table_prefix') . 'content as rcp2',
                'rcp2.id',
                '=',
                'rch2.child_id'
            )
            ->leftJoin(
                config('railcontent.table_prefix') . 'content_hierarchy as rch3',
                'rch3.parent_id',
                '=',
                'rch2.child_id'
            )
            ->leftJoin(
                config('railcontent.table_prefix') . 'content as rcp3',
                'rcp3.id',
                '=',
                'rch3.child_id'
            )
            ->leftJoin(
                config('railcontent.table_prefix') . 'content_hierarchy as rch4',
                'rch4.parent_id',
                '=',
                'rch3.child_id'
            )
            ->leftJoin(
                config('railcontent.table_prefix') . 'content as rcp4',
                'rcp4.id',
                '=',
                'rch4.child_id'
            )
            ->select(
                [
                    'rch1.child_id as rch1_child_id',
                    'rch1.parent_id as rch1_parent_id',
                    'rch1.child_position as rch1_child_position',
                    'rcp1.id as rcp1_content_id',
                    'rcp1.slug as rcp1_content_slug',
                    'rcp1.type as rcp1_content_type',
                    'rch2.child_id as rch2_child_id',
                    'rch2.parent_id as rch2_parent_id',
                    'rch2.child_position as rch2_child_position',
                    'rcp2.id as rcp2_content_id',
                    'rcp2.slug as rcp2_content_slug',
                    'rcp2.type as rcp2_content_type',
                    'rch3.child_id as rch3_child_id',
                    'rch3.parent_id as rch3_parent_id',
                    'rch3.child_position as rch3_child_position',
                    'rcp3.id as rcp3_content_id',
                    'rcp3.slug as rcp3_content_slug',
                    'rcp3.type as rcp3_content_type',
                    'rch4.child_id as rch4_child_id',
                    'rch4.parent_id as rch4_parent_id',
                    'rch4.child_position as rch4_child_position',
                    'rcp4.id as rcp4_content_id',
                    'rcp4.slug as rcp4_content_slug',
                    'rcp4.type as rcp4_content_type',
                ]
            )
            ->where('rch1.parent_id', $contentId)
            ->get();

        $childIdsToProcess = [];

        foreach ($childHierarchyRows as $childHierarchyRow) {
            if (!empty($childHierarchyRow['rch1_child_id'])) {
                $childIdsToProcess[] = $childHierarchyRow['rch1_child_id'];
            }
            if (!empty($childHierarchyRow['rch2_child_id'])) {
                $childIdsToProcess[] = $childHierarchyRow['rch2_child_id'];
            }
            if (!empty($childHierarchyRow['rch3_child_id'])) {
                $childIdsToProcess[] = $childHierarchyRow['rch3_child_id'];
            }
            if (!empty($childHierarchyRow['rch4_child_id'])) {
                $childIdsToProcess[] = $childHierarchyRow['rch4_child_id'];
            }
        }

        $parentHierarchyRows = $this->contentRepository->connectionMask()
            ->table(config('railcontent.table_prefix') . 'content_hierarchy as rch1')
            ->leftJoin(
                config('railcontent.table_prefix') . 'content as rcp1',
                'rcp1.id',
                '=',
                'rch1.parent_id'
            )
            ->leftJoin(
                config('railcontent.table_prefix') . 'content_hierarchy as rch2',
                'rch2.child_id',
                '=',
                'rch1.parent_id'
            )
            ->leftJoin(
                config('railcontent.table_prefix') . 'content as rcp2',
                'rcp2.id',
                '=',
                'rch2.parent_id'
            )
            ->leftJoin(
                config('railcontent.table_prefix') . 'content_hierarchy as rch3',
                'rch3.child_id',
                '=',
                'rch2.parent_id'
            )
            ->leftJoin(
                config('railcontent.table_prefix') . 'content as rcp3',
                'rcp3.id',
                '=',
                'rch3.parent_id'
            )
            ->leftJoin(
                config('railcontent.table_prefix') . 'content_hierarchy as rch4',
                'rch4.child_id',
                '=',
                'rch3.parent_id'
            )
            ->leftJoin(
                config('railcontent.table_prefix') . 'content as rcp4',
                'rcp4.id',
                '=',
                'rch4.parent_id'
            )
            ->select([
                'rch1.child_id as rch1_child_id',
                'rch1.parent_id as rch1_parent_id',
                'rch1.child_position as rch1_child_position',
                'rcp1.id as rcp1_content_id',
                'rcp1.slug as rcp1_content_slug',
                'rcp1.type as rcp1_content_type',
                'rch2.child_id as rch2_child_id',
                'rch2.parent_id as rch2_parent_id',
                'rch2.child_position as rch2_child_position',
                'rcp2.id as rcp2_content_id',
                'rcp2.slug as rcp2_content_slug',
                'rcp2.type as rcp2_content_type',
                'rch3.child_id as rch3_child_id',
                'rch3.parent_id as rch3_parent_id',
                'rch3.child_position as rch3_child_position',
                'rcp3.id as rcp3_content_id',
                'rcp3.slug as rcp3_content_slug',
                'rcp3.type as rcp3_content_type',
                'rch4.child_id as rch4_child_id',
                'rch4.parent_id as rch4_parent_id',
                'rch4.child_position as rch4_child_position',
                'rcp4.id as rcp4_content_id',
                'rcp4.slug as rcp4_content_slug',
                'rcp4.type as rcp4_content_type',
            ])
            ->where('rch1.child_id', $contentId)
            ->get();

        $parentIdsToProcess = [];

        foreach ($parentHierarchyRows as $parentHierarchyRow) {
            if (!empty($parentHierarchyRow['rch1_parent_id'])) {
                $parentIdsToProcess[] = $parentHierarchyRow['rch1_parent_id'];
            }
            if (!empty($parentHierarchyRow['rch2_parent_id'])) {
                $parentIdsToProcess[] = $parentHierarchyRow['rch2_parent_id'];
            }
            if (!empty($parentHierarchyRow['rch3_parent_id'])) {
                $parentIdsToProcess[] = $parentHierarchyRow['rch3_parent_id'];
            }
            if (!empty($parentHierarchyRow['rch4_parent_id'])) {
                $parentIdsToProcess[] = $parentHierarchyRow['rch4_parent_id'];
            }
        }

        $contentIdsToProcess = array_unique(array_merge($childIdsToProcess ?? [], $parentIdsToProcess ?? []));

        $this->contentService->fillCompiledViewContentDataColumnForContentIds($contentIdsToProcess);

        return $contentIdsToProcess;
    }
}