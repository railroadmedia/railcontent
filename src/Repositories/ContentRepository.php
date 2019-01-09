<?php

namespace Railroad\Railcontent\Repositories;

use Carbon\Carbon;
use Doctrine\ORM\EntityRepository;
use Illuminate\Database\DatabaseManager;
use Illuminate\Database\Query\JoinClause;
use Railroad\Railcontent\Helpers\ContentHelper;
use Railroad\Railcontent\Repositories\QueryBuilders\ContentQueryBuilder;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Resora\Decorators\Decorator;
use Railroad\Resora\Queries\CachedQuery;

class ContentRepository extends EntityRepository
{
    /**
     * If this is false content with any status will be pulled. If its an array, only content with those
     * statuses will be pulled.
     *
     * @var array|bool
     */
    public static $availableContentStatues = false;

    /**
     * If this is false content with any language will be pulled. If its an array, only content with those
     * languages will be pulled.
     *
     * @var array|bool
     */
    public static $includedLanguages = false;

    /**
     * Determines whether content with a published_on date in the future will be pulled or not.
     *
     * @var array|bool
     */
    public static $pullFutureContent = true;

    /**
     * If true all content will be returned regarless of user permissions.
     *
     * @var array|bool
     */
    public static $bypassPermissions = true;

    private $requiredFields = [];
    private $includedFields = [];

    private $requiredUserStates = [];
    private $includedUserStates = [];

    private $page;
    private $limit;
    private $orderBy;
    private $orderDirection;
    private $typesToInclude = [];
    private $slugHierarchy = [];
    private $requiredParentIds = [];

    /**
     * @return CachedQuery|$this
     */
    protected function newQuery()
    {
        return (new ContentQueryBuilder(
            $this->connection(),
            $this->connection()
                ->getQueryGrammar(),
            $this->connection()
                ->getPostProcessor()
        ))->from(ConfigService::$tableContent);
    }

    protected function decorate($results)
    {
        return Decorator::decorate($results, 'content');
    }

    /**
     * @param integer $id
     * @return array|null
     */
    public function getById($id)
    {
        return $this->query()
            ->selectPrimaryColumns()
            ->restrictByUserAccess()
            ->where(ConfigService::$tableContent . '.id', $id)
            ->first();
    }

    /**
     * @param array $ids
     * @return array
     */
    public function getByIds(array $ids)
    {
        $unorderedContentRows =
            $this->query()
                ->selectPrimaryColumns()
                ->restrictByUserAccess()
                ->whereIn(ConfigService::$tableContent . '.id', $ids)
                ->get();

        // restore order of ids passed in
        $contentRows = [];

        foreach ($ids as $id) {
            foreach ($unorderedContentRows as $index => $unorderedContentRow) {
                if ($id == $unorderedContentRow['id']) {
                    $contentRows[] = $unorderedContentRow;
                }
            }
        }

        return $contentRows;

    }

    /**
     * @param int $id
     * @param string $type
     * @param string $columnName
     * @param string $columnValue
     * @param int $siblingPairLimit
     * @param string $orderColumn
     * @param string $orderDirection
     * @return array
     */
    public function getTypeNeighbouringSiblings(
        $type,
        $columnName,
        $columnValue,
        $siblingPairLimit = 1,
        $orderColumn = 'published_on',
        $orderDirection = 'desc'
    ) {
        $beforeContents =
            $this->query()
                ->selectPrimaryColumns()
                ->restrictByUserAccess()
                ->where(ConfigService::$tableContent . '.type', $type)
                ->where(ConfigService::$tableContent . '.' . $columnName, '<', $columnValue)
                ->orderBy($orderColumn, 'desc')
                ->limit($siblingPairLimit)
                ->get()
                ->toArray();

        $afterContents =
            $this->query()
                ->selectPrimaryColumns()
                ->restrictByUserAccess()
                ->where(ConfigService::$tableContent . '.type', $type)
                ->where(ConfigService::$tableContent . '.' . $columnName, '>', $columnValue)
                ->orderBy($orderColumn, 'asc')
                ->limit($siblingPairLimit)
                ->get()
                ->toArray();

        $processedContents = array_merge($beforeContents, $afterContents);

        foreach ($afterContents as $afterContentIndex => $afterContent) {
            foreach ($processedContents as $processedContentIndex => $processedContent) {
                if ($processedContent['id'] == $afterContent['id']) {
                    $afterContents[$afterContentIndex] = $processedContents[$processedContentIndex];
                }
            }
        }

        foreach ($beforeContents as $beforeContentIndex => $beforeContent) {
            foreach ($processedContents as $processedContentIndex => $processedContent) {
                if ($processedContent['id'] == $beforeContent['id']) {
                    $beforeContents[$beforeContentIndex] = $processedContents[$processedContentIndex];
                }
            }
        }

        if ($orderDirection == 'desc') {
            return [
                'before' => array_reverse($afterContents),
                'after' => array_reverse($beforeContents),
            ];
        }

        return [
            'before' => $beforeContents,
            'after' => $afterContents,
        ];
    }

    /**
     * @param array $types
     * @param $userId
     * @param $state
     * @return integer
     */
    public function countByTypesUserProgressState(array $types, $userId, $state)
    {
        return $this->query()
            ->selectPrimaryColumns()
            ->restrictByUserAccess()
            ->leftJoin(
                ConfigService::$tableUserContentProgress,
                ConfigService::$tableUserContentProgress . '.content_id',
                '=',
                ConfigService::$tableContent . '.id'
            )
            ->whereIn(ConfigService::$tableContent . '.type', $types)
            ->where(ConfigService::$tableUserContentProgress . '.user_id', $userId)
            ->where(ConfigService::$tableUserContentProgress . '.state', $state)
            ->orderBy('published_on', 'desc')
            ->count();
    }

    /**
     * @param $userId
     * @param $childContentIds
     * @param null $slug
     * @return array
     */
    public function getByUserIdWhereChildIdIn($userId, $childContentIds, $slug = null)
    {
        $query =
            $this->query()
                ->selectPrimaryColumns()
                ->selectInheritenceColumns()
                ->restrictByUserAccess()
                ->leftJoin(
                    ConfigService::$tableContentHierarchy,
                    function (JoinClause $joinClause) use ($childContentIds) {
                        $joinClause->on(
                            ConfigService::$tableContentHierarchy . '.parent_id',
                            '=',
                            ConfigService::$tableContent . '.id'
                        )
                            ->whereIn(ConfigService::$tableContentHierarchy . '.child_id', $childContentIds);
                    }
                )
                ->where(ConfigService::$tableContent . '.user_id', $userId);

        if (!empty($slug)) {
            $query->where('slug', $slug);
        }

        return $query->get();
    }

    /**
     * @param $page
     * @param $limit
     * @param $orderBy
     * @param $orderDirection
     * @param array $typesToInclude
     * @param array $slugHierarchy
     * @param array $requiredParentIds
     * @return $this
     * @internal param array $requiredParentIds
     */
    public function startFilter(
        $page,
        $limit,
        $orderBy,
        $orderDirection,
        array $typesToInclude,
        array $slugHierarchy,
        array $requiredParentIds
    ) {
        $this->page = $page;
        $this->limit = $limit;
        $this->orderBy = $orderBy;
        $this->orderDirection = $orderDirection;
        $this->typesToInclude = $typesToInclude;
        $this->slugHierarchy = $slugHierarchy;
        $this->requiredParentIds = $requiredParentIds;

        // reset all the filters for the new query
        $this->requiredFields = [];
        $this->includedFields = [];
        $this->requiredUserStates = [];
        $this->includedUserStates = [];

        return $this;
    }

    /**
     * @return array
     */
    public function retrieveFilter()
    {
        $orderByExploded = explode(' ', $this->orderBy);

        $orderByColumns = [ConfigService::$tableContent . '.' . 'created_on'];
        $groupByColumns = [ConfigService::$tableContent . '.' . 'created_on'];

        foreach ($orderByExploded as $orderByColumn) {
            array_unshift(
                $orderByColumns,
                ConfigService::$tableContent . '.' . $orderByColumn . ' ' . $this->orderDirection
            );

            array_unshift($groupByColumns, ConfigService::$tableContent . '.' . $orderByColumn);
        }

        $subQuery =
            $this->newQuery()
                ->selectCountColumns()
                ->orderByRaw(
                    implode(', ', $orderByColumns) . ' ' . $this->orderDirection
                )
                ->restrictByUserAccess()
                ->directPaginate($this->page, $this->limit)
                ->restrictByFields($this->requiredFields)
                ->includeByFields($this->includedFields)
                ->restrictByUserStates($this->requiredUserStates)
                ->includeByUserStates($this->includedUserStates)
                ->restrictByTypes($this->typesToInclude)
                ->restrictBySlugHierarchy($this->slugHierarchy)
                ->restrictByParentIds($this->requiredParentIds)
                ->groupBy(
                    array_merge(
                        [
                            ConfigService::$tableContent . '.id',
                            ConfigService::$tableContent . '.' . 'created_on',
                        ],
                        $groupByColumns
                    )
                );

        $query =
            $this->query()
                ->orderByRaw(
                    implode(', ', $orderByColumns) . ' ' . $this->orderDirection
                )
                ->addSubJoinToQuery($subQuery)
                ->get();

        return $query;
    }

    /**
     * @return int
     */
    public function countFilter()
    {
        $subQuery =
            $this->newQuery()
                ->selectCountColumns()
                ->restrictByUserAccess()
                ->restrictByFields($this->requiredFields)
                ->includeByFields($this->includedFields)
                ->restrictByUserStates($this->requiredUserStates)
                ->includeByUserStates($this->includedUserStates)
                ->restrictByTypes($this->typesToInclude)
                ->restrictBySlugHierarchy($this->slugHierarchy)
                ->restrictByParentIds($this->requiredParentIds)
                ->groupBy(ConfigService::$tableContent . '.id');

        return $this->connection()
            ->table(
                $this->connection()
                    ->raw('(' . $subQuery->toSql() . ') as rows')
            )
            ->addBinding($subQuery->getBindings())
            ->count();
    }

    /**
     * @return array
     */
    public function getFilterFields()
    {
        $possibleContentFields =
            $this->query()
                ->selectFilterOptionColumns()
                ->restrictByUserAccess()
                ->restrictByFields($this->requiredFields)
                ->includeByFields($this->includedFields)
                ->restrictByUserStates($this->requiredUserStates)
                ->includeByUserStates($this->includedUserStates)
                ->restrictByTypes($this->typesToInclude)
                ->restrictByParentIds($this->requiredParentIds)
                ->leftJoin(
                    ConfigService::$tableContentFields,
                    ConfigService::$tableContentFields . '.content_id',
                    '=',
                    ConfigService::$tableContent . '.id'
                )
                ->whereIn(
                    ConfigService::$tableContentFields . '.key',
                    ConfigService::$fieldOptionList
                )
                ->get();

        return $this->parseAvailableFields($possibleContentFields);
    }

    /**
     * @param $name
     * @param $value
     * @param $type
     * @param $operator
     * @return $this
     */
    public function requireField($name, $value, $type = '', $operator = '=')
    {
        $this->requiredFields[] = ['name' => $name, 'value' => $value, 'type' => $type, 'operator' => $operator];

        return $this;
    }

    /**
     * Including a single field is basically the same as requiring it. Only after
     * including a second field does it start to behave inclusively.
     *
     * @param $name
     * @param $value
     * @param $type
     * @param $operator
     * @return $this
     */
    public function includeField($name, $value, $type = '', $operator = '=')
    {
        $this->includedFields[] = ['name' => $name, 'value' => $value, 'type' => $type, 'operator' => $operator];

        return $this;
    }

    /**
     * @param $state
     * @param $userId null
     * @return $this
     */
    public function requireUserStates($state, $userId = null)
    {
        $this->requiredUserStates[] = ['state' => $state, 'user_id' => $userId ?? auth()->id()];

        return $this;
    }

    /**
     * @param $userId
     * @param $state
     * @return $this
     */
    public function includeUserStates($state, $userId = null)
    {
        $this->includedUserStates[] = ['state' => $state, 'user_id' => $userId ?? auth()->id()];

        return $this;
    }

    private function parseAvailableFields($rows)
    {
        $rows = array_map("unserialize", array_unique(array_map("serialize", $rows->toArray())));

        $availableFields = [];
        $subContentIds = [];

        foreach ($rows as $row) {
            if ($row['type'] == 'content_id') {
                $subContentIds[] = $row['value'];
            } else {
                $availableFields[$row['key']][] = trim(strtolower($row['value']));

                // only uniques
                $availableFields[$row['key']] = array_values(array_unique($availableFields[$row['key']]));

                usort(
                    $availableFields[$row['key']],
                    function ($a, $b) {
                        return strcmp($a, $b);
                    }
                );
            }
        }

        $subContents = $this->getByIds($subContentIds);

        $subContents = array_combine(array_pluck($subContents, 'id'), $subContents);

        foreach ($rows as $row) {
            if ($row['type'] == 'content_id' && !empty($subContents[$row['value']])) {
                $availableFields[$row['key']][] = $subContents[strtolower($row['value'])];

                // only uniques (this is a multidimensional array_unique equivalent)
                $availableFields[$row['key']] =
                    array_map("unserialize", array_unique(array_map("serialize", $availableFields[$row['key']])));

                usort(
                    $availableFields[$row['key']],
                    function ($a, $b) {
                        return strcmp($a['slug'], $b['slug']);
                    }
                );

                $availableFields[$row['key']] = array_values($availableFields[$row['key']]);
            }
        }

        // random use case, should be refactored at some point
        if (!empty($availableFields['difficulty']) && count(
                array_diff(
                    $availableFields['difficulty'],
                    [
                        'beginner',
                        'intermediate',
                        'advanced',
                        'all',
                    ]
                )
            ) == 0) {

            $availableFields['difficulty'] = [
                'beginner',
                'intermediate',
                'advanced',
                'all',
            ];
        }

        return $availableFields;
    }

    public function softDelete(array $contentIds)
    {
        return $this->query()
            ->whereIn('id', $contentIds)
            ->update(
                ['status' => ContentService::STATUS_DELETED]
            );
    }

    /**
     * @param $contentTypes
     * @param $contentFieldKey
     * @param array $contentFieldValues
     * @return array
     *
     * can get all for content_field key by not passing content_field values, or can filter by values.
     *
     */
    public function getByContentFieldValuesForTypes($contentTypes, $contentFieldKey, $contentFieldValues = [])
    {
        $query =
            $this->query()
                ->addSelect(
                    [
                        ConfigService::$tableContent . '.id as id',
                    ]
                );

        $rows =
            $query->restrictByUserAccess()
                ->join(
                    ConfigService::$tableContentFields,
                    function (JoinClause $joinClause) use (
                        $contentFieldKey,
                        $contentFieldValues
                    ) {
                        $joinClause->on(
                            ConfigService::$tableContentFields . '.content_id',
                            '=',
                            ConfigService::$tableContent . '.id'
                        )
                            ->where(
                                ConfigService::$tableContentFields . '.key',
                                '=',
                                $contentFieldKey
                            );
                        if (!empty($contentFieldValues)) {
                            $joinClause->whereIn(
                                ConfigService::$tableContentFields . '.value',
                                $contentFieldValues
                            );
                        }
                    }
                )
                ->whereIn(ConfigService::$tableContent . '.type', $contentTypes)
                ->getToArray();

        $ids = [];

        foreach ($rows as $row) {
            $ids[] = $row['id'];
        }

        return $rows;
    }

    /** Get from the database the contents that have been published starting with a date.
     *
     * @param string $startDate
     * @return array
     */
    public function getRecentPublishedContents($startDate)
    {
        $contentRows =
            $this->query()
                ->selectPrimaryColumns()
                ->whereBetween(
                    ConfigService::$tableContent . '.published_on',
                    [
                        $startDate,
                        Carbon::now()
                            ->toDateTimeString(),
                    ]
                )
                ->whereNull('user_id')
                ->getToArray();

        return $contentRows;
    }

    public function build()
    {
        $qb = new ContentQueryBuilder($this->getEntityManager());

        return $qb
            ->select(ConfigService::$tableContent)
            ->from($this->getEntityName(),ConfigService::$tableContent);
    }
}