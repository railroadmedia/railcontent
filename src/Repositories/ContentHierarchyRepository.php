<?php

namespace Railroad\Railcontent\Repositories;

use Carbon\Carbon;
use Illuminate\Database\Query\Builder;
use Railroad\Railcontent\Services\ConfigService;

class ContentHierarchyRepository extends RepositoryBase
{
    /**
     * @param $parentId
     * @param $childId
     * @return array|null
     */
    public function getByChildIdParentId($parentId, $childId)
    {
        return $this->query()
            ->where(['parent_id' => $parentId, 'child_id' => $childId])
            ->orderBy('child_position', 'asc')
            ->first();
    }

    /**
     * @param array $parentIds
     * @param $childId
     * @return array|null
     */
    public function getByParentIds(array $parentIds)
    {
        return $this->query()
            ->whereIn('parent_id', $parentIds)
            ->orderBy('child_position', 'asc')
            ->get()
            ->toArray();
    }

    /**
     * @param integer $parentId
     * @param array $childIds
     * @return array|null
     */
    public function getByParentIdWhereChildIdIn($parentId, $childIds)
    {
        return $this->query()
            ->where('parent_id', $parentId)
            ->whereIn('child_id', $childIds)
            ->orderBy('child_position', 'asc')
            ->get()
            ->toArray();
    }

    /**
     * @param array $parentIds
     * @return array
     */
    public function countParentsChildren(array $parentIds)
    {
        return $this->query()
            ->select(
                [
                    $this->databaseManager->raw(
                        'COUNT(' . ConfigService::$tableContentHierarchy . '.child_id) as count'
                    ),
                    'parent_id',
                ]
            )
            ->whereIn(ConfigService::$tableContentHierarchy . '.parent_id', $parentIds)
            ->groupBy(ConfigService::$tableContentHierarchy . '.parent_id')
            ->get()
            ->toArray();
    }

    /**
     * @param int $parentId
     * @param int $childId
     * @param int|null $position
     * @return bool
     */
    public function updateOrCreateChildToParentLink($parentId, $childId, $position = null)
    {
        $existingLink =
            $this->query()
                ->where(['parent_id' => $parentId, 'child_id' => $childId])
                ->first();

        $childCount =
            $this->query()
                ->where('parent_id', $parentId)
                ->count();

        if ($position === null || $position > $childCount) {
            if (empty($existingLink)) {
                $position = $childCount + 1;
            } else {
                $position = $childCount;
            }
        }

        if ($position < 1) {
            $position = 1;
        }

        if (empty($existingLink)) {

            $this->query()
                ->where('parent_id', $parentId)
                ->where('child_position', '>=', $position)
                ->increment('child_position');

            return $this->query()
                ->insert(
                    [
                        'parent_id' => $parentId,
                        'child_id' => $childId,
                        'child_position' => $position,
                        'created_on' => Carbon::now()
                            ->toDateTimeString(),
                    ]
                );

        } elseif ($position > $existingLink['child_position']) {

            $this->query()
                ->where(
                    [
                        'parent_id' => $parentId,
                        'child_id' => $childId,
                    ]
                )
                ->update(['child_position' => $position]);

            return $this->query()
                    ->where('parent_id', $parentId)
                    ->where('child_id', '!=', $childId)
                    ->where('child_position', '>', $existingLink['child_position'])
                    ->where('child_position', '<=', $position)
                    ->decrement('child_position') > 0;

        } elseif ($position < $existingLink['child_position']) {

            $this->query()
                ->where(
                    [
                        'parent_id' => $parentId,
                        'child_id' => $childId,
                    ]
                )
                ->update(['child_position' => $position]);

            return $this->query()
                    ->where('parent_id', $parentId)
                    ->where('child_id', '!=', $childId)
                    ->where('child_position', '<', $existingLink['child_position'])
                    ->where('child_position', '>=', $position)
                    ->increment('child_position') > 0;

        } else {
            return true;
        }
    }

    /**
     * @param int $childId
     * @return bool
     */
    public function deleteChildParentLinks($childId)
    {
        $existingLinks =
            $this->query()
                ->where(['child_id' => $childId])
                ->get()
                ->toArray();

        $totalRowsDeleted = 0;

        foreach ($existingLinks as $existingLink) {
            $totalRowsDeleted += $this->query()
                ->where(['parent_id' => $existingLink['parent_id'], 'child_id' => $childId])
                ->delete();

            $this->query()
                ->where('parent_id', $existingLink['parent_id'])
                ->where('child_position', '>=', $existingLink['child_position'])
                ->decrement('child_position');
        }

        return $totalRowsDeleted == count($existingLinks);
    }

    /**
     * @param $parentId
     * @param $childId
     * @return bool
     */
    public function deleteParentChildLink($parentId, $childId)
    {
        // delete parent child link and reposition other children
        return $this->deleteAndReposition(
            [
                'parent_id' => $parentId,
                'child_id' => $childId,
            ],
            'child_'
        );
    }

    /**
     * @param int $parentId
     * @return bool
     */
    public function deleteParentChildLinks($parentId)
    {
        return $this->query()
                ->where(['parent_id' => $parentId])
                ->delete() > 0;
    }

    /**
     * @return Builder
     */
    public function query()
    {
        return $this->connection()
            ->table(ConfigService::$tableContentHierarchy);
    }

    /** Get parent Id based on child Id
     *
     * @param integer $childId
     * @return array|null
     */
    public function getParentByChildId($childId)
    {
        return $this->query()
            ->where(ConfigService::$tableContentHierarchy . '.child_id', $childId)
            ->first();
    }

    public function decrementSiblings($parentId, $position)
    {
        return $this->query()
            ->where('parent_id', $parentId)
            ->where('child_position', '>', $position)
            ->decrement('child_position');
    }

}