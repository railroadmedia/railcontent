<?php

namespace Railroad\Railcontent\Repositories;

use Carbon\Carbon;
use Doctrine\Common\Util\Inflector;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\PersistentCollection;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\ORM\QueryBuilder;
use Railroad\Railcontent\Contracts\UserProviderInterface;
use Railroad\Railcontent\Entities\Content;
use Railroad\Railcontent\Entities\UserPermission;
use Railroad\Railcontent\Repositories\QueryBuilders\ContentQueryBuilder;
use Railroad\Railcontent\Repositories\Traits\RailcontentCustomQueryBuilder;

class ContentRepository extends EntityRepository
{
    use RailcontentCustomQueryBuilder;

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

    private $requiredUserPlaylistIds = [];

    public static $getFutureContentOnly = false;

    private $page;
    private $limit;
    private $orderBy;
    private $orderDirection;
    private $typesToInclude = [];
    private $slugHierarchy = [];
    private $requiredParentIds = [];

    /**
     * @param $type
     * @param $columnName
     * @param $columnValue
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
        $orderColumn = 'publishedOn',
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
                ->setCacheable(true)
                ->setCacheRegion('pull')
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
                ->setCacheable(true)
                ->setCacheRegion('pull')
                ->getResult('Railcontent');

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
     * @param $page
     * @param $limit
     * @param $orderBy
     * @param $orderDirection
     * @param array $typesToInclude
     * @param array $slugHierarchy
     * @param array $requiredParentIds
     * @param bool $getFutureContentOnly
     * @return $this
     */
    public function startFilter(
        $page,
        $limit,
        $orderBy,
        $orderDirection,
        array $typesToInclude,
        array $slugHierarchy,
        array $requiredParentIds,
        array $requiredUserPlaylistIds,
        $getFutureContentOnly = false
    ) {
        $this->page = $page;
        $this->limit = $limit;
        $this->orderBy = $orderBy;
        $this->orderDirection = $orderDirection;
        $this->typesToInclude = $typesToInclude;
        $this->slugHierarchy = $slugHierarchy;
        $this->requiredParentIds = $requiredParentIds;
        $this->requiredUserPlaylistIds = $requiredUserPlaylistIds;

        self::$getFutureContentOnly = $getFutureContentOnly;

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

        $orderByColumns = [config('railcontent.table_prefix') . 'content' . '.' . 'createdOn'];
        $groupByColumns = [config('railcontent.table_prefix') . 'content' . '.' . 'createdOn'];

        foreach ($orderByExploded as $orderByColumn) {
            if (strpos($orderByColumn, '_') !== false || strpos($orderByColumn, '-') !== false) {
                $orderByColumn = camel_case($orderByColumn);
            }
            array_unshift(
                $orderByColumns,
                config('railcontent.table_prefix') . 'content' . '.' . $orderByColumn . ' ' . $this->orderDirection
            );

            array_unshift($groupByColumns, config('railcontent.table_prefix') . 'content' . '.' . $orderByColumn);
        }
        $sortBy = 'newest';
        $qb =
            $this->build()
                ->paginate($this->limit, $this->page - 1)
                ->restrictByUserAccess()
                ->restrictByTypes($this->typesToInclude)
                ->includeByUserStates($this->includedUserStates)
                ->restrictByParentIds($this->requiredParentIds)
                ->restrictByUserStates($this->requiredUserStates)
                ->restrictBySlugHierarchy($this->slugHierarchy)
                ->restrictByPlaylistIds($this->requiredUserPlaylistIds)
                ->restrictByFields($this->requiredFields)
                ->sortResults($sortBy)
                ->setCacheable(true)
                ->setCacheRegion('pull');

        return $qb;
    }

    /**
     * @return int
     */
    public function countFilter()
    {
        $subQuery =
            $this->build()
                ->restrictByUserAccess()
                ->restrictByFields($this->requiredFields)
                ->includeByFields($this->includedFields)
                ->restrictByUserStates($this->requiredUserStates)
                ->includeByUserStates($this->includedUserStates)
                ->restrictByTypes($this->typesToInclude)
                ->restrictBySlugHierarchy($this->slugHierarchy)
                ->restrictByParentIds($this->requiredParentIds)
                ->groupBy(config('railcontent.table_prefix') . 'content.id')
                ->getQuery()->getResult();

        return count($subQuery);
    }

    /**
     * @return array
     * @throws \Doctrine\ORM\Mapping\MappingException
     */
    public function getFilterFields()
    {
        $filteredContents = [];
        $contents =
            $this->build()
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

        $ids = [];
        if ($contents) {
            foreach ($contents as $content) {
                $ids[] = $content->getId();
                if(!in_array($content->getType(), $filteredContents['content_type']??[] )) {
                    $filteredContents['content_type'][] = $content->getType();
                }
            }
        }

        if (!empty($contents)) {
            $instructors = [];
            foreach (config('railcontent.field_option_list', []) as $requiredFieldData) {

                if (in_array(
                    $requiredFieldData,
                    $this->getEntityManager()
                        ->getClassMetadata(Content::class)
                        ->getAssociationNames()
                )) {
                    $alias = $requiredFieldData;
                    $targetEntity =
                        $this->getEntityManager()
                            ->getClassMetadata(Content::class)
                            ->getAssociationMapping($requiredFieldData)['targetEntity'];

                    $qb =
                        $this->getEntityManager()
                            ->createQueryBuilder();

                    $qb->select($alias)
                        ->from(
                            $targetEntity,
                            $alias
                        );

                    $assoc =
                        $this->getEntityManager()
                            ->getClassMetadata($targetEntity)
                            ->getAssociationMappings();

                    if ($assoc > 1) {
                        foreach ($assoc as $index => $j) {
                            if ($index != 'content') {
                                $qb->addSelect($j['fieldName'] . $index);
                                $qb->join($alias . '.' . $j['fieldName'], $j['fieldName'] . $index);
                            }
                        }
                    }

                    $qb->where($alias . '.content IN (:ids)')
                        ->setParameter('ids', $ids);

                    $results =
                        $qb->getQuery()
                            ->getResult();

                    foreach ($results as $result) {

                        $getterName = Inflector::camelize('get' . ucwords(camel_case($requiredFieldData)));

                        $value = call_user_func([$result, $getterName]);

                        if ($requiredFieldData == 'instructor') {

                            $instructor = $result->getInstructor();

                            if (!in_array($instructor->getId(), $instructors)) {
                                $instructors[] = $instructor->getId();
                                $filteredContents[$requiredFieldData][] = $instructor;
                            }

                        } else {
                            if (!in_array(strtolower($value), array_map("strtolower", $filteredContents[$requiredFieldData]??[]))) {

                                $filteredContents[$requiredFieldData][] = $value;
                            }
                        }
                    }

                } else {

                    $getterName = Inflector::camelize('get' . ucwords(camel_case($requiredFieldData)));

                    foreach ($contents as $content) {

                        $value = call_user_func([$content, $getterName]);
                        if ($value && !in_array(strtolower($value), array_map("strtolower", $filteredContents[$requiredFieldData]??[]))) {
                            $filteredContents[$requiredFieldData][] = $value;
                        }
                    }
                }
            }

            foreach ($filteredContents as $availableFieldIndex => $availableField) {
                usort(
                    $filteredContents[$availableFieldIndex],
                    function ($a, $b) {
                        if ($a instanceof Content) {
                            return strncmp($a->getSlug(), $b->getSlug(), 15);
                        }
                        return strncmp($a, $b, 15);
                    }
                );
            }

            // random use case, should be refactored at some point
            if (!empty($filteredContents['difficulty']) && count(
                    array_diff(
                        $filteredContents['difficulty'],
                        [
                            'beginner',
                            'intermediate',
                            'advanced',
                            'all',
                        ]
                    )
                ) == 0) {

                $filteredContents['difficulty'] = [
                    'beginner',
                    'intermediate',
                    'advanced',
                    'all',
                ];
            }
        }

        return $filteredContents;
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
        $this->requiredUserStates[] = [
            'state' => $state,
            'user' => app()
                ->make(UserProviderInterface::class)
                ->getUserById($userId ?? auth()->id()),
        ];

        return $this;
    }

    /**
     * @param $userId
     * @param $state
     * @return $this
     */
    public function includeUserStates($state, $userId = null)
    {
        $this->includedUserStates[] = [
            'state' => $state,
            'user' => app()
                ->make(UserProviderInterface::class)
                ->getUserById($userId ?? auth()->id()),
        ];

        return $this;
    }

    /**
     * @param $rows
     * @return array
     */
    private function parseAvailableFields($rows)
    {
        $availableFields = [];

        foreach ($rows as $row) {
            foreach (config('railcontent.field_option_list', []) as $fieldOption) {

                if (strpos($fieldOption, '_') !== false || strpos($fieldOption, '-') !== false) {
                    $fieldOption = camel_case($fieldOption);
                }

                $getField = 'get' . ucwords($fieldOption);

                if ($row->$getField() && (count($row->$getField()) > 0)) {
                    if (in_array(
                        $fieldOption,
                        $this->getEntityManager()
                            ->getClassMetadata(Content::class)
                            ->getAssociationNames()
                    )) {

                        if ($row->$getField() instanceof PersistentCollection) {
                            foreach ($row->$getField() as $field) {
                                if (!in_array(
                                    $field->$getField(),
                                    $availableFields[$fieldOption] ?? []
                                )) {
                                    $availableFields[$fieldOption][] = $field->$getField();
                                }
                            }
                        } elseif (!in_array(
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

    /**
     * @return QueryBuilder|ContentQueryBuilder
     */
    public function build()
    {
        $qb = new ContentQueryBuilder($this->getEntityManager());
        $lifetime = config('railcontent.cache_duration');

        if (auth()->id()) {
            $userPermissionRepository =
                $this->getEntityManager()
                    ->getRepository(UserPermission::class);

            $userPermission = $userPermissionRepository->getUserPermissions(auth()->id(), true);

            if ($userPermission) {
                $lifetime =
                    Carbon::parse($userPermission[0]->getExpirationDate())
                        ->diffInSeconds(Carbon::now());
            }
        }

        $this->getEntityManager()
            ->getConfiguration()
            ->getSecondLevelCacheConfiguration()
            ->getRegionsConfiguration()
            ->setDefaultLifetime(
                $lifetime
            );

        return $qb->select(config('railcontent.table_prefix') . 'content', 'progress')
            ->from($this->getEntityName(), config('railcontent.table_prefix') . 'content')
            ->leftJoin(
                config('railcontent.table_prefix') . 'content' . '.userProgress',
                'progress',
                'WITH',
                'progress.user = :userId'
            )
            ->setParameter('userId', auth()->id());
    }

    /**
     * @param $parentId
     * @param string $orderBy
     * @param string $orderByDirection
     * @return mixed
     */
    public function getByParentId($parentId, $orderBy = 'childPosition', $orderByDirection = 'asc')
    {
        return $this->build()
            ->restrictByUserAccess()
            ->join(config('railcontent.table_prefix') . 'content' . '.parent', 'p')
            ->andWhere('p.parent = :parentId')
            ->setParameter('parentId', $parentId)
            ->orderByColumn('p', $orderBy, $orderByDirection)
            ->getQuery()
            ->setCacheable(true)
            ->setCacheRegion('pull')
            ->getResult();
    }

    /**
     * @param $id
     * @return mixed
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getById($id)
    {
        return $this->build()
            ->restrictByUserAccess()
            ->andWhere(config('railcontent.table_prefix') . 'content' . '.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->setCacheable(true)
            ->setCacheRegion('pull')
            ->getOneOrNullResult();
    }
}