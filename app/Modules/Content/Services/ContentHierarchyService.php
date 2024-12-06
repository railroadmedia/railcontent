<?php

namespace App\Modules\Content\Services;

use App\Modules\Brand\Enums\Status;
use App\Modules\Content\Enums\ProgressState;
use App\Modules\Content\Models\Content;
use App\Modules\Content\Models\ContentHierarchy;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Modules\UserManagementSystem\Models\User;

class ContentHierarchyService
{
    public const string CONTENT_HIERARCHY_ALIAS = 'ch';
    public const string USER_CONTENT_PROGRESS_ALIAS = 'ucp';

    protected ?string $contentHierarchyTableName = null;

    /**
     * Get the next Content for the given user, under the parent content
     * @throws Exception
     */
    public function getNextContentForParentContentForUser(Content $parentContent, User $user, int $depth = 4): ?Content
    {
        $this->contentHierarchyTableName = ContentHierarchy::getTableName();
        if (!$this->contentHierarchyTableName) {
            throw new Exception("Content hierarchy table name not set");
        }

        $isParentComplete = $user->progress()
            ->where('content_id', $parentContent->id)
            ->complete()
            ->exists();

        // TODO NOTE: this is replicating a bug in railcontent. It fails to properly find if the parent is complete and
        //  so it ends up returning null because it tries to find the next incomplete lesson
        //  It's not entirely clear right now if this is the desired behaviour or not, so both this and the check later
        //  on are in place. If the null response is desired, remove the unnecessary check lower. If the first element
        //  is desired, remove this check and return
        if ($isParentComplete) {
            return null;
        }

        // build up the query
        $level = 1;
        $query = ContentHierarchy::query()->from(
            sprintf(
                '%s AS %s',
                $this->contentHierarchyTableName,
                sprintf('%s_%d', self::CONTENT_HIERARCHY_ALIAS, $level)
            )
        );
        // join the level 1 content
        $query = $this->joinContent($query, $level, ['assignment']);

        // go through each level and join the hierarchy (and content through that)
        for ($level = 2; $level <= $depth; $level++) {
            $query = $this->joinHierarchy($query, $level);
        }

        // build up the select statement for each level
        $selects = [];
        for ($level = 1; $level <= $depth; $level++) {
            $hierarchyLevelAlias = sprintf('%s_%s', self::CONTENT_HIERARCHY_ALIAS, $level);
            $progressLevelAlias = sprintf('%s_%s', self::USER_CONTENT_PROGRESS_ALIAS, $level);
            $selects[] = sprintf('%s.parent_id AS %s_parent_id', $hierarchyLevelAlias, $hierarchyLevelAlias);
            $selects[] = sprintf('%s.child_id AS %s_child_id', $hierarchyLevelAlias, $hierarchyLevelAlias);
            $selects[] = sprintf('%s.child_position AS %s_child_position', $hierarchyLevelAlias, $hierarchyLevelAlias);
            $selects[] = sprintf('%s_child.slug AS %s_child_slug', $hierarchyLevelAlias, $hierarchyLevelAlias);
            $selects[] = sprintf('%s.state AS %s_state', $progressLevelAlias, $progressLevelAlias);
        }
        $query->select($selects);

        // join the user progress for each level
        for ($level = 1; $level <= $depth; $level++) {
            $query = $this->joinUserProgress($query, $level, $user->id);
        }

        // set the where clause
        $query->where(sprintf('%s_1.parent_id', self::CONTENT_HIERARCHY_ALIAS), $parentContent->id);

        // set the ordering based on the child positions, going down the levels
        for ($level = 1; $level <= $depth; $level++) {
            $query->orderBy(sprintf('%s_%d.child_position', self::CONTENT_HIERARCHY_ALIAS, $level));
        }

        // if the parent is incomplete, get the next incomplete lesson
        if (!$isParentComplete) {
            for ($level = 1; $level <= $depth; $level++) {
                $field = sprintf('%s_%d.state', self::USER_CONTENT_PROGRESS_ALIAS, $level);
                $query = $query->whereRaw("IFNULL($field, '') != ?", ProgressState::Completed->value);
            }
        }

        // get only the first result
        $query->limit(1);
        $hierarchyData = $query->first();

        // work backwards through the children to find the first entry that has a slug to find the content ID we'll use
        $contentId = null;
        if (!empty($hierarchyData)) {
            for ($level = $depth; $level >= 1; $level--) {
                $checkField = sprintf('%s_%d_child_slug', self::CONTENT_HIERARCHY_ALIAS, $level);
                $idField = sprintf('%s_%d_child_id', self::CONTENT_HIERARCHY_ALIAS, $level);
                if (!empty($hierarchyData[$checkField])) {
                    $contentId = $hierarchyData[$idField];
                    break;
                }
            }
        }

        return Content::find($contentId);
    }

    /**
     * Join the content to the given alias
     */
    protected function joinContent(Builder $query, int $level, array $excludedChildTypes): Builder
    {
        $alias = sprintf('%s_%d', self::CONTENT_HIERARCHY_ALIAS, $level);
        return $query->leftJoin(
            "railcontent_content AS {$alias}_child",
            function ($join) use ($alias, $excludedChildTypes) {
                $join->on("{$alias}_child.id", '=', "{$alias}.child_id")
                    ->when(!empty($excludedChildTypes), function ($query) use ($alias, $excludedChildTypes) {
                        $query->whereNotIn("{$alias}_child.type", $excludedChildTypes);
                    })
                    ->where("{$alias}_child.status", Status::STATUS_PUBLISHED->value)
                    ->where("{$alias}_child.published_on", '<', now());
            }
        );
    }

    /**
     * Join the Content Hierarchy for a child alias connected to the parent alias,
     * optionally joining in the content as well
     */
    protected function joinHierarchy(
        Builder $query,
        int $level,
        bool $withContent = true,
        array $excludedChildTypes = ['assignment']
    ): Builder {
        $alias = sprintf('%s_%d', self::CONTENT_HIERARCHY_ALIAS, $level);
        $parentAlias = sprintf('%s_%d', self::CONTENT_HIERARCHY_ALIAS, $level - 1);
        return $query
            ->leftJoin(
                sprintf('%s AS %s', $this->contentHierarchyTableName, $alias),
                "{$alias}.parent_id",
                '=',
                "{$parentAlias}.child_id"
            )->when($withContent, function (Builder $query) use ($level, $excludedChildTypes) {
                return $this->joinContent($query, $level, $excludedChildTypes);
            });
    }

    /**
     * Join the user's content progress on the hierarchy's child
     */
    protected function joinUserProgress(Builder $query, int $level, int $userId): Builder
    {
        $alias = sprintf('%s_%d', self::USER_CONTENT_PROGRESS_ALIAS, $level);
        $hierarchyAlias = sprintf('%s_%d', self::CONTENT_HIERARCHY_ALIAS, $level);
        return $query
            ->leftJoin(
                "railcontent_user_content_progress AS {$alias}",
                function ($join) use ($alias, $hierarchyAlias, $userId) {
                    $join->on("{$alias}.content_id", '=', "{$hierarchyAlias}.child_id")
                        ->where("{$alias}.user_id", $userId);
                }
            );
    }
}
