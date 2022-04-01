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
     * If true all content will be returned regardless of user permissions.
     *
     * @var array|bool
     */
    public static $bypassPermissions = false;

    public $requiredFields = [];
    public $includedFields = [];

    private $requiredUserStates = [];
    private $includedUserStates = [];

    private $requiredUserPlaylistIds = [];

    public static $getFutureContentOnly = false;
    public static $getFollowedContentOnly = false;

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
        $alias = config('railcontent.table_prefix').'content';
        if (strpos($orderColumn, '_') !== false || strpos($orderColumn, '-') !== false) {
            $orderColumn = camel_case($orderColumn);
        }
        $orderColumn = $alias.'.'.$orderColumn;

        $beforeContents =
            $this->build()
                ->restrictByUserAccess()
                ->andWhere($alias.'.type = :type')
                ->andWhere($alias.'.'.$columnName.' < :columnValue')
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
                ->andWhere($alias.'.type = :type')
                ->andWhere($alias.'.'.$columnName.' > :columnValue')
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
     * @param $sort
     * @param array $typesToInclude
     * @param array $slugHierarchy
     * @param array $requiredParentIds
     * @param array $requiredUserPlaylistIds
     * @param bool $getFutureContentOnly
     * @return $this
     */
    public function startFilter(
        $page,
        $limit,
        $sort,
        array $typesToInclude,
        array $slugHierarchy,
        array $requiredParentIds,
        array $requiredUserPlaylistIds,
        $getFutureContentOnly = false,
        $getFollowedContentOnly = false
    ) {
        $this->page = $page;
        $this->limit = $limit;
        $this->orderBy = $sort;
        $this->typesToInclude = $typesToInclude;
        $this->slugHierarchy = $slugHierarchy;
        $this->requiredParentIds = $requiredParentIds;
        $this->requiredUserPlaylistIds = $requiredUserPlaylistIds;

        self::$getFutureContentOnly = $getFutureContentOnly;
        self::$getFollowedContentOnly = $getFollowedContentOnly;

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
        $orderByColumns = [config('railcontent.table_prefix').'content'.'.'.'createdOn'];
        $groupByColumns = [config('railcontent.table_prefix').'content'.'.'.'createdOn'];

        foreach ($orderByExploded as $orderByColumn) {
            if (strpos($orderByColumn, '_') !== false || strpos($orderByColumn, '-') !== false) {
                $orderByColumn = camel_case($orderByColumn);
            }
            array_unshift(
                $orderByColumns,
                config('railcontent.table_prefix').'content'.'.'.$orderByColumn.' '.$this->orderDirection
            );

            array_unshift($groupByColumns, config('railcontent.table_prefix').'content'.'.'.$orderByColumn);
        }

        $qb =
            $this->build()
                ->restrictByUserAccess()
                ->restrictByTypes($this->typesToInclude)
                ->includeByUserStates($this->includedUserStates)
                ->restrictByParentIds($this->requiredParentIds)
                ->restrictByUserStates($this->requiredUserStates)
                ->restrictBySlugHierarchy($this->slugHierarchy)
                ->restrictByPlaylistIds($this->requiredUserPlaylistIds)
                ->includeByFields($this->includedFields)
                ->restrictByFields($this->requiredFields)
                ->orderBy(implode(', ', $orderByColumns))
                ->paginate($this->limit, ($this->page - 1));

        if (self::$getFollowedContentOnly) {
            $qb->restrictFollowedContent();
        }

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
                ->groupBy(config('railcontent.table_prefix').'content.id');

        if (self::$getFollowedContentOnly) {
            $subQuery->restrictFollowedContent();
        }

        $results =
            $subQuery->getQuery()
                ->getResult();

        return count($results);
    }

    /**
     * @return array
     * @throws \Doctrine\ORM\Mapping\MappingException
     */
    public function getFilterFields()
    {
        $filteredContents = [];

        $query =
            $this->build()
                ->restrictByUserAccess()
                ->restrictByFields($this->requiredFields)
                ->includeByFields($this->includedFields)
                ->restrictByUserStates($this->requiredUserStates)
                ->includeByUserStates($this->includedUserStates)
                ->restrictByTypes($this->typesToInclude)
                ->restrictByParentIds($this->requiredParentIds)
                ->restrictByFilterOptions();

        if (self::$getFollowedContentOnly) {
            $query->restrictFollowedContent();
        }

        $contents =
            $query->getQuery()
                ->getResult();

        $ids = [];

        if (!empty($contents)) {
                        foreach ($contents as $content) {
                            $ids[] = $content->getId();
                            if (!in_array($content->getType(), $filteredContents['content_type'] ?? [])
//                                &&
//                                (!in_array($content->getType(), $this->typesToInclude))
                                )
                            {
                                $filteredContents['content_type'][] = $content->getType();
                            }
                        }

            $instructors = [];
            foreach (config('railcontent.field_option_list', []) as $requiredFieldData) {
                if ($requiredFieldData == 'instructor') {
                    $requiredFieldData = 'contentInstructors';
                }
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
                                $qb->addSelect($j['fieldName'].$index);
                                $qb->join($alias.'.'.$j['fieldName'], $j['fieldName'].$index);
                            }
                        }
                    }

                    $qb->where($alias.'.content IN (:ids)')
                        ->setParameter('ids', $ids);

                    $results =
                        $qb->getQuery()
                            ->getResult();

                    foreach ($results as $result) {
                        if ($requiredFieldData == 'styles') {
                            $getterName = 'getStyle';
                        } elseif ($requiredFieldData == 'contentInstructors') {
                            $getterName = 'getInstructor';
                        } else {
                            $getterName = Inflector::camelize('get'.ucwords(camel_case($requiredFieldData)));
                        }
                        $value = call_user_func([$result, $getterName]);

                        if ($requiredFieldData == 'contentInstructors') {
                            $instructor = $result->getInstructor();

                            if (!in_array($instructor->getId(), $instructors)) {
                                $instructors[] = $instructor->getId();
                                $filteredContents['instructor'][$instructor->getId()] = $instructor;
                            }
                        } else {
                            if (!in_array(
                                ucfirst(trim($value)),
                                array_map("ucfirst", $filteredContents[$requiredFieldData] ?? [])
                            )) {
                                $filteredContents[$requiredFieldData][] = ucfirst(trim($value));
                            }
                        }
                    }
                } else {
                    $getterName = Inflector::camelize('get'.ucwords(camel_case($requiredFieldData)));
                    if ($requiredFieldData == 'styles') {
                        $getterName = 'getStyle';
                    }

                    foreach ($contents as $content) {
                        $value = call_user_func([$content, $getterName]);
                        if ($value && is_string($value) && !in_array(
                                ucfirst(trim(($value))),
                                array_map("ucfirst", $filteredContents[$requiredFieldData] ?? [])
                            )) {
                            $filteredContents[$requiredFieldData][] = ucfirst(trim($value));
                        }
                    }
                }
            }



            foreach ($filteredContents as $availableFieldIndex => $availableField) {
                usort($filteredContents[$availableFieldIndex], function ($a, $b) use ($availableField) {
                    if ($a instanceof Content) {
                        return strncmp($a->getSlug(), $b->getSlug(), 15);
                    } elseif (is_numeric($a) && is_numeric($b)) {
                        return $a > $b;
                    }

                    return strncmp($a, $b, 15);
                });
            }

            // random use case, should be refactored at some point
            if (!empty($filteredContents['difficulty']) && count(
                    array_diff($filteredContents['difficulty'], [
                        'beginner',
                        'intermediate',
                        'advanced',
                        'all',
                    ])
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
        $isProperty = true;
        if (in_array(
            $name,
            $this->getEntityManager()
                ->getClassMetadata(Content::class)
                ->getAssociationNames()
        )) {
            $isProperty = false;
        }
        $this->requiredFields[] =
            ['name' => $name, 'value' => $value, 'type' => $type, 'operator' => $operator, 'property' => $isProperty];

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

                $getField = 'get'.ucwords($fieldOption);

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

        foreach ($availableFields as $availableFieldIndex => $availableField) {
            // if they are all numeric, sort by numbers, otherwise sort by string comparision
            if (is_numeric(reset($availableFields[$availableFieldIndex])) &&
                ctype_digit(implode('', $availableFields[$availableFieldIndex]))) {
                sort($availableFields[$availableFieldIndex]);
            } else {
                usort($availableFields[$availableFieldIndex], function ($a, $b) {
                    if (is_array($a)) {
                        return strncmp(strtolower($a->getSlug()), strtolower($b->getSlug()), 15);
                    }

                    return strncmp(strtolower($a), strtolower($b), 15);
                });
            }
        }

        // random use case, should be refactored at some point
        if (!empty($availableFields['difficulty']) && count(
                array_diff($availableFields['difficulty'], [
                    'beginner',
                    'intermediate',
                    'advanced',
                    'all',
                ])
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

        //        if (auth()->id()) {
        //            $userPermissionRepository =
        //                $this->getEntityManager()
        //                    ->getRepository(UserPermission::class);
        //
        //            $userPermission = $userPermissionRepository->getUserPermissions(auth()->id(), true);
        //
        //            if ($userPermission) {
        //                $lifetime =
        //                    Carbon::parse($userPermission[0]->getExpirationDate())
        //                        ->diffInSeconds(Carbon::now());
        //            }
        //        }

        //Doctrine ORM Second level cache disable
        //        $this->getEntityManager()
        //            ->getConfiguration()
        //            ->getSecondLevelCacheConfiguration()
        //            ->getRegionsConfiguration()
        //            ->setDefaultLifetime(
        //                $lifetime
        //            );

        return $qb->select(config('railcontent.table_prefix').'content')
            ->from($this->getEntityName(), config('railcontent.table_prefix').'content');
        //            ->leftJoin(
        //                config('railcontent.table_prefix') . 'content' . '.userProgress',
        //                'progress',
        //                'WITH',
        //                'progress.user = :userId'
        //            )
        //            ->leftJoin(config('railcontent.table_prefix') . 'content' . '.data', 'cd')
        //            ->setParameter('userId', auth()->id());
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
            ->join(config('railcontent.table_prefix').'content'.'.parent', 'p')
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
            ->andWhere(config('railcontent.table_prefix').'content'.'.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->setCacheable(true)
            ->setCacheRegion('pull')
            ->getOneOrNullResult();
    }

    /**
     * @return array
     */
    public function getActiveFilters()
    {
        $active = [];

        if (!empty($this->typesToInclude)) {
            $active['content_type'] = $this->typesToInclude;
        }

        $fields = array_merge($this->includedFields, $this->requiredFields);
        foreach ($fields as $filter) {
            $active[$filter['name']][] = $filter['value'];
        }

        $userStates = array_merge($this->requiredUserStates, $this->includedUserStates);
        if (!empty($userStates)) {
            foreach ($userStates as $state) {
                $active['user_states'][] = $state['state'];
            }
        }

        if (array_key_exists('instructor', $active)) {
            $instructors =
                $this->build()
                    ->andWhere(config('railcontent.table_prefix').'content'.'.id IN (:ids)')
                    ->setParameter('ids', $active['instructor'])
                    ->getQuery()
                    ->setCacheable(true)
                    ->setCacheRegion('pull')
                    ->getResult();

            $active['instructor'] = $instructors;
        }

        return $active;
    }
}
