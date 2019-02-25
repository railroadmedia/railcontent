<?php

namespace Railroad\Railcontent\Repositories;

use Carbon\Carbon;
use Doctrine\ORM\EntityRepository;
use Illuminate\Database\DatabaseManager;
use Illuminate\Database\Query\JoinClause;
use Railroad\Railcontent\Entities\Content;
use Railroad\Railcontent\Helpers\ContentHelper;
use Railroad\Railcontent\Repositories\QueryBuilders\ContentQueryBuilder;
use Railroad\Railcontent\Repositories\Traits\ByContentIdTrait;
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
    public static $bypassPermissions = false;

    public $requiredFields = [];
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

    protected function decorate($results)
    {
        return Decorator::decorate($results, 'content');
    }

    /**
     * @param integer $id
     * @return array|null
     */
    public function _getById($id)
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
    public function _getByIds(array $ids)
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
        $alias = config('railcontent.table_prefix') . 'content';
        if (strpos($orderColumn, '_') !== false || strpos($orderColumn, '-') !== false) {
            $orderColumn = camel_case($orderColumn);
        }
        $orderColumn = $alias . '.' . $orderColumn;

        $beforeContents =
            $this->build()
                ->restrictByUserAccess()
                ->andWhere($alias . '.type = :type')
                ->andWhere($alias . '.' . $columnName . ' < :columnValue')
                ->setParameter('type', $type)
                ->setParameter('columnValue', $columnValue)
                ->orderBy($orderColumn, 'desc')
                ->setMaxResults($siblingPairLimit)
                ->getQuery()
                ->getResult();

        $afterContents =
            $this->build()
                ->restrictByUserAccess()
                ->andWhere($alias . '.type = :type')
                ->andWhere($alias . '.' . $columnName . ' > :columnValue')
                ->setParameter('type', $type)
                ->setParameter('columnValue', $columnValue)
                ->orderBy($orderColumn, 'desc')
                ->setMaxResults($siblingPairLimit)
                ->getQuery()
                ->getResult();

        $processedContents = array_merge($beforeContents, $afterContents);

        foreach ($afterContents as $afterContentIndex => $afterContent) {
            foreach ($processedContents as $processedContentIndex => $processedContent) {
                if ($processedContent->getId() == $afterContent->getId()) {
                    $afterContents[$afterContentIndex] = $processedContents[$processedContentIndex];
                }
            }
        }

        foreach ($beforeContents as $beforeContentIndex => $beforeContent) {
            foreach ($processedContents as $processedContentIndex => $processedContent) {
                if ($processedContent->getId() == $beforeContent->getId()) {
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
    public function _countByTypesUserProgressState(array $types, $userId, $state)
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
    public function _getByUserIdWhereChildIdIn($userId, $childContentIds, $slug = null)
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

        $orderByColumns = [ConfigService::$tableContent . '.' . 'createdOn'];
        $groupByColumns = [ConfigService::$tableContent . '.' . 'createdOn'];

        foreach ($orderByExploded as $orderByColumn) {
            if (strpos($orderByColumn, '_') !== false || strpos($orderByColumn, '-') !== false) {
                $orderByColumn = camel_case($orderByColumn);
            }
            array_unshift(
                $orderByColumns,
                ConfigService::$tableContent . '.' . $orderByColumn . ' ' . $this->orderDirection
            );

            array_unshift($groupByColumns, ConfigService::$tableContent . '.' . $orderByColumn);
        }

        $first = ($this->page - 1) * $this->limit;

        $qb =
            $this->build()
                ->setMaxResults($this->limit)
                ->setFirstResult($first)
                ->restrictByUserAccess()
                ->restrictByTypes($this->typesToInclude)
                ->includeByUserStates($this->includedUserStates)
                ->restrictByParentIds($this->requiredParentIds)
                ->restrictByUserStates($this->requiredUserStates)
                ->restrictBySlugHierarchy($this->slugHierarchy)
                ->orderBy(implode(', ', $orderByColumns))
                ->restrictByFields($this->requiredFields);
        return $qb;

        //        $subQuery =
        //            $this->newQuery()
        //                ->selectCountColumns()
        //                ->orderByRaw(
        //                    implode(', ', $orderByColumns) . ' ' . $this->orderDirection
        //                )
        //                ->restrictByUserAccess()
        //                ->directPaginate($this->page, $this->limit)
        //                ->restrictByFields($this->requiredFields)
        //                ->includeByFields($this->includedFields)
        //                ->restrictByUserStates($this->requiredUserStates)
        //                ->includeByUserStates($this->includedUserStates)
        //                ->restrictByTypes($this->typesToInclude)
        //                ->restrictBySlugHierarchy($this->slugHierarchy)
        //                ->restrictByParentIds($this->requiredParentIds)
        //                ->groupBy(
        //                    array_merge(
        //                        [
        //                            ConfigService::$tableContent . '.id',
        //                            ConfigService::$tableContent . '.' . 'created_on',
        //                        ],
        //                        $groupByColumns
        //                    )
        //                );
        //
        //        $query =
        //            $this->query()
        //                ->orderByRaw(
        //                    implode(', ', $orderByColumns) . ' ' . $this->orderDirection
        //                )
        //                ->addSubJoinToQuery($subQuery)
        //                ->get();
        //
        //        return $query;
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
        $possibleContentFields = $this->build()
        ->restrictByUserAccess()
            ->restrictByFields($this->requiredFields)
            ->includeByFields($this->includedFields)
            ->restrictByUserStates($this->requiredUserStates)
            ->includeByUserStates($this->includedUserStates)
            ->restrictByTypes($this->typesToInclude)
            ->restrictByParentIds($this->requiredParentIds)
            ->restrictByFilterOptions()
            ->getQuery()
            ->getResult();

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
        $availableFields = [];

        foreach ($rows as $row) {
            foreach (ConfigService::$fieldOptionList as $fieldOption) {
                $getField = 'get' . ucwords($fieldOption);
                if ($row->$getField() && (count($row->$getField()) > 0)) {
                    if (in_array(
                        $fieldOption,
                        $this->getEntityManager()
                            ->getClassMetadata(Content::class)
                            ->getAssociationNames()
                    )) {
                        if (!in_array(
                            $row->$getField()
                                ->$getField(),
                            $availableFields[$fieldOption] ?? []
                        )) {
                            $availableFields[$fieldOption][] =
                                $row->$getField()
                                    ->$getField();
                        }
                    } else {
                        if (!in_array($row->$getField(), $availableFields[$fieldOption] ?? [])) {
                            $availableFields[$fieldOption][] = $row->$getField();
                        }
                    }
                }
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

    public function _softDelete(array $contentIds)
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
    public function _getByContentFieldValuesForTypes($contentTypes, $contentFieldKey, $contentFieldValues = [])
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
    public function _getRecentPublishedContents($startDate)
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

        return $qb->select(config('railcontent.table_prefix') . 'content')
            ->from($this->getEntityName(), config('railcontent.table_prefix') . 'content');
    }
}