<?php

namespace Railroad\Railcontent\Services;

use Doctrine\Common\Inflector\Inflector;
use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\DBAL\DBALException;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Railroad\DoctrineArrayHydrator\JsonApiHydrator;
use Railroad\Railcontent\Contracts\UserProviderInterface;
use Railroad\Railcontent\Entities\Comment;
use Railroad\Railcontent\Entities\Content;
use Railroad\Railcontent\Entities\ContentData;
use Railroad\Railcontent\Entities\ContentFilterResultsEntity;
use Railroad\Railcontent\Entities\ContentHierarchy;
use Railroad\Railcontent\Entities\ContentPermission;
use Railroad\Railcontent\Entities\UserContentProgress;
use Railroad\Railcontent\Events\ContentCreated;
use Railroad\Railcontent\Events\ContentDeleted;
use Railroad\Railcontent\Events\ContentSoftDeleted;
use Railroad\Railcontent\Events\ContentUpdated;
use Railroad\Railcontent\Managers\RailcontentEntityManager;
use ReflectionException;

class ContentService
{
    /**
     * @var RailcontentEntityManager
     */
    public $entityManager;

    /**
     * @var ObjectRepository|EntityRepository
     */
    private $contentRepository;

    /**
     * @var ObjectRepository|EntityRepository
     */
    private $datumRepository;

    /**
     * @var ObjectRepository|EntityRepository
     */
    private $commentRepository;

    /**
     * @var ObjectRepository|EntityRepository
     */
    private $contentPermissionRepository;

    /**
     * @var JsonApiHydrator
     */
    private $jsonApiHydrator;

    /**
     * @var UserProviderInterface
     */
    private $userProvider;

    // all possible content statuses
    const STATUS_DRAFT = 'draft';
    const STATUS_PUBLISHED = 'published';
    const STATUS_SCHEDULED = 'scheduled';
    const STATUS_ARCHIVED = 'archived';
    const STATUS_DELETED = 'deleted';

    /**
     * ContentService constructor.
     *
     * @param RailcontentEntityManager $entityManager
     * @param JsonApiHydrator $jsonApiHydrator
     * @param UserProviderInterface $userProvider
     */
    public function __construct(
        RailcontentEntityManager $entityManager,
        JsonApiHydrator $jsonApiHydrator,
        UserProviderInterface $userProvider
    ) {
        $this->entityManager = $entityManager;
        $this->userProvider = $userProvider;

        $this->contentRepository = $this->entityManager->getRepository(Content::class);
        $this->datumRepository = $this->entityManager->getRepository(ContentData::class);
        $this->contentPermissionRepository = $this->entityManager->getRepository(ContentPermission::class);
        $this->commentRepository = $this->entityManager->getRepository(Comment::class);

        $this->jsonApiHydrator = $jsonApiHydrator;
    }

    /** Call the get by id method from repository and return the content
     *
     * @param $id
     * @return mixed
     * @throws NonUniqueResultException
     */
    public function getById($id)
    {
        $results =
            $this->contentRepository->build()
                ->restrictByUserAccess()
                ->andWhere(config('railcontent.table_prefix') . 'content' . '.id = :id')
                ->setParameter('id', $id)
                ->getQuery()
                ->setCacheable(true)
                ->setCacheRegion('pull')
                ->getOneOrNullResult('Railcontent');

        return $results;
    }

    /** Call the get by ids method from repository
     *
     * @param $ids
     * @return array
     */
    public function getByIds($ids)
    {
        $unorderedContentRows =
            $this->contentRepository->build()
                ->restrictByUserAccess()
                ->andWhere(config('railcontent.table_prefix') . 'content' . '.id IN (:ids)')
                ->setParameter('ids', $ids)
                ->getQuery()
                ->setCacheable(true)
                ->setCacheRegion('pull')
                ->getResult('Railcontent');

        // restore order of ids passed in
        $contentRows = [];
        foreach ($ids as $id) {
            foreach ($unorderedContentRows as $index => $unorderedContentRow) {
                if ($id == $unorderedContentRow->getId()) {
                    $contentRows[] = $unorderedContentRow;
                }
            }
        }

        return $contentRows;
    }

    /** Get all contents with specified type.
     *
     * @param $type
     * @return mixed
     */
    public function getAllByType($type)
    {
        $results =
            $this->contentRepository->build()
                ->restrictByUserAccess()
                ->andWhere(config('railcontent.table_prefix') . 'content' . '.type = :type')
                ->setParameter('type', $type)
                ->getQuery()
                ->setCacheable(true)
                ->setCacheRegion('pull')
                ->getResult('Railcontent');

        return $results;
    }

    /** Get all contents with specified status, field and type.
     *
     * @param array $types
     * @param $status
     * @param $fieldKey
     * @param $fieldValue
     * @param string $fieldType
     * @param string $fieldComparisonOperator
     * @return mixed
     */
    public function getWhereTypeInAndStatusAndField(
        array $types,
        $status,
        $fieldKey,
        $fieldValue,
        $fieldType = '',
        $fieldComparisonOperator = '='
    ) {

        $qb =
            $this->contentRepository->build()
                ->restrictByUserAccess()
                ->whereIn(config('railcontent.table_prefix') . 'content' . '.type', $types)
                ->andWhere(config('railcontent.table_prefix') . 'content' . '.status = :status')
                ->setParameter('status', $status);
        if (in_array(
            $fieldKey,
            $this->entityManager->getClassMetadata(Content::class)
                ->getFieldNames()
        )) {
            $qb->andWhere(
                config('railcontent.table_prefix') .
                'content' .
                '.' .
                $fieldKey .
                ' ' .
                $fieldComparisonOperator .
                ' (:value)'
            )
                ->setParameter('value', $fieldValue);
        } else {
            if (in_array(
                $fieldKey,
                $this->entityManager->getClassMetadata(Content::class)
                    ->getAssociationNames()
            )) {
                $qb->join(
                    config('railcontent.table_prefix') .
                    'content' .
                    '.' .
                    $this->entityManager->getClassMetadata(Content::class)
                        ->getFieldName($fieldKey),
                    'p'
                )
                    ->andWhere('p ' . $fieldComparisonOperator . ' (:value)')
                    ->setParameter('value', $fieldValue);
            }
        }

        $results =
            $qb->getQuery()
                ->setCacheable(true)
                ->setCacheRegion('pull')
                ->getResult('Railcontent');

        return $results;
    }

    /** Get ordered contents by type, status and published_on date.
     *
     * @param array $types
     * @param $status
     * @param $publishedOnValue
     * @param string $publishedOnComparisonOperator
     * @param string $orderByColumn
     * @param string $orderByDirection
     * @return mixed
     */
    public function getWhereTypeInAndStatusAndPublishedOnOrdered(
        array $types,
        $status,
        $publishedOnValue,
        $publishedOnComparisonOperator = '=',
        $orderByColumn = 'publishedOn',
        $orderByDirection = 'desc'
    ) {
        $alias = config('railcontent.table_prefix') . 'content';
        return $this->contentRepository->build()
            ->restrictByUserAccess()
            ->andWhere($alias . '.type IN (:types)')
            ->andWhere($alias . '.status = :status')
            ->andWhere(
                $alias . '.publishedOn ' . $publishedOnComparisonOperator . ' :publishedOn'
            )
            ->orderByColumn($alias, $orderByColumn, $orderByDirection)
            ->setParameter('status', $status)
            ->setParameter('publishedOn', $publishedOnValue)
            ->setParameter('types', $types)
            ->getQuery()
            ->setCacheable(true)
            ->setCacheRegion('pull')
            ->getResult('Railcontent');
    }

    /** Get contents by slug and title.
     *
     * @param $slug
     * @param $type
     * @return mixed
     */
    public function getBySlugAndType($slug, $type)
    {
        $results =
            $this->contentRepository->build()
                ->restrictByUserAccess()
                ->andWhere(config('railcontent.table_prefix') . 'content' . '.slug = :slug')
                ->andWhere(config('railcontent.table_prefix') . 'content' . '.type = :type')
                ->setParameter('slug', $slug)
                ->setParameter('type', $type)
                ->getQuery()
                ->setCacheable(true)
                ->setCacheRegion('pull')
                ->getResult('Railcontent');

        return $results;
    }

    /** Get contents by userId, type and slug.
     *
     * @param $userId
     * @param $type
     * @param $slug
     * @return mixed
     */
    public function getByUserIdTypeSlug($userId, $type, $slug)
    {
        $results =
            $this->contentRepository->build()
                ->restrictByUserAccess()
                ->andWhere(config('railcontent.table_prefix') . 'content' . '.slug = :slug')
                ->andWhere(config('railcontent.table_prefix') . 'content' . '.type = :type')
                ->andWhere(config('railcontent.table_prefix') . 'content' . '.user = :user')
                ->setParameter('slug', $slug)
                ->setParameter('type', $type)
                ->setParameter('user', $userId)
                ->getQuery()
                ->setCacheable(true)
                ->setCacheRegion('pull')
                ->getResult('Railcontent');

        return $results;
    }

    /** Get contents based on parent id.
     *
     * @param $parentId
     * @param string $orderBy
     * @param string $orderByDirection
     * @return mixed
     */
    public function getByParentId($parentId, $orderBy = 'childPosition', $orderByDirection = 'asc')
    {
        $results =
            $this->contentRepository->build()
                ->restrictByUserAccess()
                ->join(config('railcontent.table_prefix') . 'content' . '.parent', 'p')
                ->andWhere('p.parent = :parentId')
                ->setParameter('parentId', $parentId)
                ->orderByColumn('p', $orderBy, $orderByDirection)
                ->getQuery()
                ->setCacheable(true)
                ->setCacheRegion('pull')
                ->getResult('Railcontent');

        return $results;
    }

    /** Get paginated contents by parent id.
     *
     * @param $parentId
     * @param int $limit
     * @param int $skip
     * @param string $orderBy
     * @param string $orderByDirection
     * @return mixed
     */
    public function getByParentIdPaginated(
        $parentId,
        $limit = 10,
        $skip = 1,
        $orderBy = 'childPosition',
        $orderByDirection = 'asc'
    ) {
        $results =
            $this->contentRepository->build()
                ->restrictByUserAccess()
                ->join(config('railcontent.table_prefix') . 'content' . '.parent', 'p')
                ->andWhere('p.parent = :parentId')
                ->setParameter('parentId', $parentId)
                ->orderByColumn('p', $orderBy, $orderByDirection)
                ->paginate($limit, $skip)
                ->getQuery()
                ->setCacheable(true)
                ->setCacheRegion('pull')
                ->getResult('Railcontent');

        return $results;
    }

    /** Get ordered contents by parent id with specified type.
     *
     * @param $parentId
     * @param $types
     * @param string $orderBy
     * @param string $orderByDirection
     * @return mixed
     */
    public function getByParentIdWhereTypeIn(
        $parentId,
        $types,
        $orderBy = 'childPosition',
        $orderByDirection = 'asc'
    ) {

        $results =
            $this->contentRepository->build()
                ->restrictByUserAccess()
                ->join(config('railcontent.table_prefix') . 'content' . '.parent', 'p')
                ->whereIn(config('railcontent.table_prefix') . 'content' . '.type', $types)
                ->andWhere('p.parent = :parentId')
                ->setParameter('parentId', $parentId)
                ->orderByColumn('p', $orderBy, $orderByDirection)
                ->getQuery()
                ->setCacheable(true)
                ->setCacheRegion('pull')
                ->getResult('Railcontent');

        return $results;
    }

    /** Get ordered contents by parent id and type.
     *
     * @param $parentId
     * @param $types
     * @param int $limit
     * @param int $skip
     * @param string $orderBy
     * @param string $orderByDirection
     * @return mixed
     */
    public function getByParentIdWhereTypeInPaginated(
        $parentId,
        $types,
        $limit = 10,
        $skip = 0,
        $orderBy = 'childPosition',
        $orderByDirection = 'asc'
    ) {

        $results =
            $this->contentRepository->build()
                ->restrictByUserAccess()
                ->join(config('railcontent.table_prefix') . 'content' . '.parent', 'p')
                ->whereIn(config('railcontent.table_prefix') . 'content' . '.type', $types)
                ->andWhere('p.parent = :parentId')
                ->setParameter('parentId', $parentId)
                ->orderByColumn('p', $orderBy, $orderByDirection)
                ->paginate($limit, $skip)
                ->getQuery()
                ->setCacheable(true)
                ->setCacheRegion('pull')
                ->getResult('Railcontent');

        return $results;
    }

    /** Count contents with specified type and parent id.
     *
     * @param $parentId
     * @param $types
     * @return mixed
     * @throws NonUniqueResultException
     */
    public function countByParentIdWhereTypeIn(
        $parentId,
        $types
    ) {
        $qb = $this->contentRepository->build();

        return $qb->select(
            $qb->expr()
                ->count(config('railcontent.table_prefix') . 'content')
        )
            ->restrictByUserAccess()
            ->join(config('railcontent.table_prefix') . 'content' . '.parent', 'p')
            ->whereIn(config('railcontent.table_prefix') . 'content' . '.type', $types)
            ->andWhere('p.parent = :parentId')
            ->setParameter('parentId', $parentId)
            ->getQuery()
            ->getSingleScalarResult();
    }

    /** Get ordered contents based on parent ids.
     *
     * @param array $parentIds
     * @param string $orderBy
     * @param string $orderByDirection
     * @return mixed
     */
    public function getByParentIds(array $parentIds, $orderBy = 'childPosition', $orderByDirection = 'asc')
    {
        $results =
            $this->contentRepository->build()
                ->restrictByUserAccess()
                ->join(config('railcontent.table_prefix') . 'content' . '.parent', 'p')
                ->whereIn('p.parent', $parentIds)
                ->orderByColumn('p', $orderBy, $orderByDirection)
                ->getQuery()
                ->setCacheable(true)
                ->setCacheRegion('pull')
                ->getResult('Railcontent');

        return $results;
    }

    /** Get contents by child and type.
     *
     * @param $childId
     * @param $type
     * @return mixed
     */
    public function getByChildIdWhereType($childId, $type)
    {
        $results =
            $this->contentRepository->build()
                ->restrictByUserAccess()
                ->join(config('railcontent.table_prefix') . 'content' . '.child', 'c')
                ->andWhere('c.child = :childId')
                ->andWhere(config('railcontent.table_prefix') . 'content' . '.type = :type')
                ->setParameter('type', $type)
                ->setParameter('childId', $childId)
                ->getQuery()
                ->setCacheable(true)
                ->setCacheRegion('pull')
                ->getResult('Railcontent');

        return $results;
    }

    /** Get contents by child ids with specified type.
     *
     * @param array $childIds
     * @param $type
     * @return mixed
     */
    public function getByChildIdsWhereType(array $childIds, $type)
    {
        $results =
            $this->contentRepository->build()
                ->restrictByUserAccess()
                ->join(config('railcontent.table_prefix') . 'content' . '.child', 'c')
                ->whereIn('c.child', $childIds)
                ->andWhere(config('railcontent.table_prefix') . 'content' . '.type = :type')
                ->setParameter('type', $type)
                ->getQuery()
                ->setCacheable(true)
                ->setCacheRegion('pull')
                ->getResult('Railcontent');

        return $results;
    }

    /** Get contents by child id where parent type met the criteria.
     *
     * @param $childId
     * @param array $types
     * @return mixed
     */
    public function getByChildIdWhereParentTypeIn($childId, array $types)
    {
        $results =
            $this->contentRepository->build()
                ->restrictByUserAccess()
                ->join(config('railcontent.table_prefix') . 'content' . '.child', 'c')
                ->whereIn('c.child', [$childId])
                ->andWhere(config('railcontent.table_prefix') . 'content' . '.type IN (:type)')
                ->setParameter('type', $types)
                ->getQuery()
                ->setCacheable(true)
                ->setCacheRegion('pull')
                ->getResult('Railcontent');

        return $results;
    }

    /** Get paginated contents by type and user progress state.
     *
     * @param $type
     * @param $userId
     * @param $state
     * @param int $limit
     * @param int $skip
     * @return mixed
     */
    public function getPaginatedByTypeUserProgressState($type, $userId, $state, $limit = 25, $skip = 0)
    {
        $alias = 'up';

        $qb =
            $this->entityManager->getRepository(UserContentProgress::class)
                ->createQueryBuilder($alias);

        $qb
            ->join(
                $alias . '.content',
                config('railcontent.table_prefix') . 'content'
            );

        $qb->where($alias . '.user = :userId')
            ->andWhere($alias . '.state = :state')
            ->andWhere(config('railcontent.table_prefix') . 'content' . '.type IN (:types)')
            ->setParameter('userId', $userId)
            ->setParameter('state', $state)
            ->setParameter('types', $type);

        $qb->paginate($limit, $skip);

        $results =
            $qb->getQuery()
                ->setCacheable(true)
                ->setCacheRegion('pull')
                ->getResult('Railcontent');

        return $results;
    }

    /** Get paginated contents by types and user progress state.
     *
     * @param array $types
     * @param $userId
     * @param $state
     * @param int $limit
     * @param int $skip
     * @return mixed
     */
    public function getPaginatedByTypesUserProgressState(
        array $types,
        $userId,
        $state,
        $limit = 25,
        $skip = 0
    ) {
        $alias = 'up';

        $qb =
            $this->entityManager->getRepository(UserContentProgress::class)
                ->createQueryBuilder($alias);
        $qb->paginate($limit, $skip)
            ->join(
                $alias . '.content',
                config('railcontent.table_prefix') . 'content'
            );
        $qb->where($alias . '.user = :userId')
            ->andWhere($alias . '.state = :state')
            ->andWhere(config('railcontent.table_prefix') . 'content' . '.type IN (:types)')
            ->setParameter('userId', $userId)
            ->setParameter('state', $state)
            ->setParameter('types', $types);

        $results =
            $qb->getQuery()
                ->setCacheable(true)
                ->setCacheRegion('pull')
                ->getResult('Railcontent');

        return $results;
    }

    /** Get recent paginated contents by types and user progress state.
     *
     * @param array $types
     * @param $userId
     * @param $state
     * @param int $limit
     * @param int $skip
     * @param array $requiredFilters
     * @return ContentFilterResultsEntity
     */
    public function getPaginatedByTypesRecentUserProgressState(
        array $types,
        $userId,
        $state,
        $limit = 25,
        $skip = 0,
        $requiredFilters = []
    ) {
        //user
        $alias = 'up';

        $qb =
            $this->contentRepository->build()
                ->join(config('railcontent.table_prefix') . 'content' . '.userProgress', $alias)
                ->restrictByUserAccess()
                ->andWhere($alias . '.user = :userId')
                ->andWhere($alias . '.state = :state')
                ->andWhere(config('railcontent.table_prefix') . 'content' . '.type IN (:types)');

        if ($requiredFilters) {
            $qb->restrictByFields(
                $requiredFilters
            );
        }

        $qb->setParameter('userId', $userId)
            ->setParameter('types', $types)
            ->setParameter('state', $state)
            ->paginate($limit, $skip)
            ->orderByColumn($alias, 'updatedOn', 'desc');

        $this->contentRepository->requireUserStates($state, $userId);

        $results = new ContentFilterResultsEntity(
            [
                'qb' => $qb,
                'results' => $qb->getQuery()
                    ->setCacheable(true)
                    ->setCacheRegion('pull')
                    ->getResult('Railcontent'),
                'filter_options' => $this->contentRepository->getFilterFields(),
            ]
        );

        return $results;
    }

    /** Count recent contents with user progress state and type.
     *
     * @param array $types
     * @param $userId
     * @param $state
     * @return mixed
     * @throws NonUniqueResultException
     */
    public function countByTypesRecentUserProgressState(
        array $types,
        $userId,
        $state
    ) {
        $alias = 'up';

        $qb =
            $this->entityManager->getRepository(UserContentProgress::class)
                ->createQueryBuilder($alias);
        $qb->select('count(' . $alias . '.id)')
            ->join(
                $alias . '.content',
                config('railcontent.table_prefix') . 'content'
            );
        $qb->where($alias . '.user = :userId')
            ->andWhere($alias . '.state = :state')
            ->andWhere(config('railcontent.table_prefix') . 'content' . '.type IN (:types)')
            ->setParameter('userId', $userId)
            ->setParameter('state', $state)
            ->setParameter('types', $types);

        return $qb->getQuery()
            ->getSingleScalarResult();
    }

    /** Get neighbouring siblings by type.
     *
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
        $orderColumn = 'published_on',
        $orderDirection = 'desc'
    ) {

        return $this->contentRepository->getTypeNeighbouringSiblings(
            $type,
            $columnName,
            $columnValue,
            $siblingPairLimit,
            $orderColumn,
            $orderDirection
        );
    }

    /** Count contents by type and user progress state.
     *
     * @param array $types
     * @param $userId
     * @param $state
     * @return mixed
     * @throws NonUniqueResultException
     */
    public function countByTypesUserProgressState(array $types, $userId, $state)
    {
        $alias = 'up';

        $qb =
            $this->entityManager->getRepository(UserContentProgress::class)
                ->createQueryBuilder($alias);
        $qb->select('count(' . $alias . '.id)')
            ->join(
                $alias . '.content',
                config('railcontent.table_prefix') . 'content'
            );
        $qb->where($alias . '.user = :userId')
            ->andWhere($alias . '.state = :state')
            ->andWhere(config('railcontent.table_prefix') . 'content' . '.type IN (:types)')
            ->setParameter('userId', $userId)
            ->setParameter('state', $state)
            ->setParameter('types', $types);
        $res =
            $qb->getQuery()
                ->getSingleScalarResult();

        return $res;
    }

    /** Get contents by child ids with specified type.
     *
     * @param $userId
     * @param array $childContentIds
     * @param null $slug
     * @return mixed
     */
    public function getByUserIdWhereChildIdIn($userId, array $childContentIds, $slug = null)
    {
        $qb =
            $this->contentRepository->build()
                ->restrictByUserAccess()
                ->join(config('railcontent.table_prefix') . 'content' . '.child', 'c')
                ->whereIn('c.child', $childContentIds)
                ->andWhere(config('railcontent.table_prefix') . 'content' . '.user = :user')
                ->setParameter('user', $userId);

        if ($slug) {
            $qb->andWhere(config('railcontent.table_prefix') . 'content' . '.slug = :slug')
                ->setParameter('slug', $slug);
        }
        $results =
            $qb->getQuery()
                ->setCacheable(true)
                ->setCacheRegion('pull')
                ->getResult('Railcontent');

        return $results;
    }

    /** Get filtered contents.
     *
     * @param $page
     * @param $limit
     * @param string $orderByAndDirection
     * @param array $includedTypes
     * @param array $slugHierarchy
     * @param array $requiredParentIds
     * @param array $requiredFields
     * @param array $includedFields
     * @param array $requiredUserStates
     * @param array $includedUserStates
     * @param bool $pullFilterFields
     * @return ContentFilterResultsEntity|null
     */
    public function getFiltered(
        $page,
        $limit,
        $orderByAndDirection = '-published_on',
        array $includedTypes = [],
        array $slugHierarchy = [],
        array $requiredParentIds = [],
        array $requiredFields = [],
        array $includedFields = [],
        array $requiredUserStates = [],
        array $includedUserStates = [],
        $pullFilterFields = true
    ) {

        $results = null;

        if ($limit == 'null') {
            $limit = -1;
        }

        $orderByDirection = substr($orderByAndDirection, 0, 1) !== '-' ? 'asc' : 'desc';
        $orderByColumn = trim($orderByAndDirection, '-');

        $filter = $this->contentRepository->startFilter(
            $page,
            $limit,
            $orderByColumn,
            $orderByDirection,
            $includedTypes,
            $slugHierarchy,
            $requiredParentIds
        );

        foreach ($requiredFields as $requiredField) {
            $filter->requireField(
                ...
                (is_array($requiredField) ? $requiredField : explode(',', $requiredField))
            );
        }

        foreach ($includedFields as $includedField) {
            $filter->includeField(
                ...
                (is_array($includedField) ? $includedField : explode(',', $includedField))
            );
        }
        foreach ($requiredUserStates as $requiredUserState) {
            $filter->requireUserStates(
                ...
                is_array($requiredUserState) ? $requiredUserState : explode(',', $requiredUserState)
            );
        }
        foreach ($includedUserStates as $includedUserState) {
            $filter->includeUserStates(
                ...
                is_array($includedUserState) ? $includedUserState : explode(',', $includedUserState)
            );
        }

        $qb = $this->contentRepository->retrieveFilter();

        $results = new ContentFilterResultsEntity(
            [
                'qb' => $qb,
                'results' => $qb->getQuery()
                    ->setCacheable(true)
                    ->setCacheRegion('pull')
                    ->getResult('Railcontent'),
                'filter_options' => $pullFilterFields ? $this->contentRepository->getFilterFields() : [],
            ]
        );

        return $results;
    }

    /**
     * @param $data
     * @return Content
     * @throws DBALException
     * @throws ORMException
     * @throws OptimisticLockException
     * @throws ReflectionException
     */
    public function create(
        $data
    ) {
        $content = new Content();

        $this->jsonApiHydrator->hydrate($content, $data);

        $data = $this->saveContentFields($data, $content);

        if (!$content->getBrand()) {
            $content->setBrand(config('railcontent.brand'));
        }

        if (!$content->getLanguage()) {
            $content->setLanguage(config('railcontent.default_language'));
        }

        $content->setParent(null);

        $this->entityManager->persist($content);
        $this->entityManager->flush();

        if (array_key_exists('relationships', $data['data'])) {
            $parentId = $data['data']['relationships']['parent']['data']['id'] ?? null;
            if ($parentId) {
                $parent = $this->contentRepository->find($parentId);

                $hierarchy = new ContentHierarchy();
                $hierarchy->setParent($parent);
                $hierarchy->setChild($content);
                $this->entityManager->persist($hierarchy);
                $this->entityManager->flush();
            }
        }

        $this->entityManager->getCache('Railcontent')
            ->evictEntityRegion(Content::class);

        $this->entityManager->getCache('Railcontent')
            ->evictEntity(Content::class, 'pull');

        event(new ContentCreated($content));

        return $content;
    }

    /** Update and return the updated content.
     *
     * @param $id
     * @param array $data
     * @return object|null
     * @throws DBALException
     * @throws ORMException
     * @throws OptimisticLockException
     * @throws ReflectionException
     */
    public function update($id, array $data)
    {
        $content = $this->contentRepository->find($id);

        if (empty($content)) {
            return null;
        }

        $this->jsonApiHydrator->hydrate($content, $data);

        $this->saveContentFields($data, $content);

        $this->entityManager->persist($content);
        $this->entityManager->flush();

        event(new ContentUpdated($content));

        $this->entityManager->getCache()
            ->evictEntityRegion(Content::class);

        return $content;
    }

    /** Call the delete method from repository and returns true if the content was deleted
     *
     * @param $id
     * @return bool|null
     * @throws ORMException
     * @throws OptimisticLockException
     *
     */
    public function delete($id)
    {
        $content = $this->contentRepository->find($id);

        if (empty($content)) {
            return null;
        }

        event(new ContentDeleted($content));
      //  dd($content);
        $this->entityManager->remove($content);
        $this->entityManager->flush();

        $this->entityManager->getCache()
            ->evictEntity(Content::class, $id);

        return true;
    }

    /** Delete data related with the specified content.
     *
     * @param $content
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function deleteContentRelated($content)
    {
        $contentId = $content->getId();
        $contentPermissions = $this->contentPermissionRepository->findByContent($contentId);

        foreach ($contentPermissions as $contentPermission) {
            $this->entityManager->remove($contentPermission);
        }

        $comments = $this->commentRepository->findByContent($contentId);

        foreach ($comments as $comment) {
            $this->entityManager->remove($comment);
        }

        $userContentProgress =
            $this->entityManager->getRepository(UserContentProgress::class)
                ->findByContent($contentId);

        foreach ($userContentProgress as $contentProgress) {
            $this->entityManager->remove($contentProgress);
        }

        $this->entityManager->flush();
    }

    /**
     * @param $userId
     * @param $contents
     * @param null $singlePlaylistSlug
     * @return array|mixed
     */
    public function attachChildrenToContents($userId, $contents, $singlePlaylistSlug = null)
    {
        $isArray = !isset($contents['id']);

        if (!$isArray) {
            $contents = [$contents];
        }

        $userPlaylistContents =
            $this->contentRepository->build()
                ->restrictByUserAccess()
                ->join(
                    ContentHierarchy::class,
                    'hierarchy',
                    'WITH',
                    'railcontent_content.id = hierarchy.child'
                )
                ->andWhere(config('railcontent.table_prefix') . 'content' . '.userId = :userId')
                ->andWhere('hierarchy.child IN (:childIds)');

        if ($singlePlaylistSlug) {
            $userPlaylistContents->andWhere(config('railcontent.table_prefix') . 'content' . '.slug = :slug')
                ->setParameter('slug', $singlePlaylistSlug);
        }

        $userPlaylistContents->setParameter('childIds', array_column($contents, 'id'))
            ->setParameter('userId', $userId)
            ->getQuery()
            ->getResult('Railcontent');

        foreach ($contents as $index => $content) {
            $contents[$index]['user_playlists'][$userId] = [];
            foreach ($userPlaylistContents as $userPlaylistContent) {
                if ($userPlaylistContent['parent_id'] == $content['id']) {
                    $contents[$index]['user_playlists'][$userId][] = $userPlaylistContent;
                }
            }
        }

        if ($isArray) {
            return $contents;
        } else {
            return reset($contents);
        }
    }

    /** Call the update method from repository to mark the content as deleted and returns true if the content was updated
     *
     * @param $id
     * @return object|null
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function softDelete($id)
    {
        $content = $this->contentRepository->find($id);

        if (empty($content)) {
            return null;
        }

        $content->setStatus(ContentService::STATUS_DELETED);

        event(new ContentSoftDeleted($content));
       // dd($content);
        $this->entityManager->persist($content);

        $this->entityManager->flush();

        $this->entityManager->getCache()
            ->evictEntityRegion(Content::class);

        return $content;
    }

    /** Soft delete the children for specified content id.
     *
     * @param $id
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function softDeleteContentChildren($id)
    {
        $children =
            $this->entityManager->getRepository(ContentHierarchy::class)
                ->findByParent($id);

        //delete parent content cache
        $this->entityManager->getCache()
            ->evictEntityRegion(Content::class);

        foreach ($children as $child) {
            $child->getChild()
                ->setStatus(ContentService::STATUS_DELETED);
        }

        $this->entityManager->flush();
    }

    /** Get contents by field value and types.
     *
     * @param array $contentTypes
     * @param $contentFieldKey
     * @param array $contentFieldValues
     * @return mixed
     */
    public function getByContentFieldValuesForTypes(
        array $contentTypes,
        $contentFieldKey,
        array $contentFieldValues = []
    ) {
        $qb =
            $this->contentRepository->build()
                ->restrictByUserAccess()
                ->whereIn(config('railcontent.table_prefix') . 'content' . '.type', $contentTypes);
        if (in_array(
            $contentFieldKey,
            $this->entityManager->getClassMetadata(Content::class)
                ->getFieldNames()
        )) {
            $qb->andWhere(config('railcontent.table_prefix') . 'content' . '.' . $contentFieldKey . ' IN (:value)')
                ->setParameter('value', $contentFieldValues);
        } else {
            if (in_array(
                $contentFieldKey,
                $this->entityManager->getClassMetadata(Content::class)
                    ->getAssociationNames()
            )) {
                $qb->join(
                    config('railcontent.table_prefix') .
                    'content' .
                    '.' .
                    $this->entityManager->getClassMetadata(Content::class)
                        ->getFieldName($contentFieldKey),
                    'p'
                )
                    ->andWhere('p IN (:value)')
                    ->setParameter('value', $contentFieldValues);
            }
        }

        $results =
            $qb->getQuery()
                ->setCacheable(true)
                ->setCacheRegion('pull')
                ->getResult('Railcontent');

        return $results;
    }

    /**
     * @param $data
     * @param Content $content
     * @return mixed
     * @throws ORMException
     */
    private function saveContentFields($data, Content $content)
    {
        if (array_key_exists('fields', $data['data']['attributes'])) {

            $fields = $data['data']['attributes']['fields'];

            foreach ($fields as $field) {

                if (strpos($field['key'], '_') !== false || strpos($field['key'], '-') !== false) {
                    $field['key'] = camel_case($field['key']);
                }

                if ($this->isEntityAttribute($field, Content::class)) {

                    $setterName = Inflector::camelize('set' . ucwords($field['key']));

                    call_user_func([$content, $setterName], $field['value']);

                } elseif ($this->isEntityAssociation($field, Content::class)) {

                    $associationMappings = $this->getAssociationMappings(get_class($content), $field);

                    $entityName = $associationMappings['targetEntity'];

                    $fieldEntity = new $entityName();

                    if ($this->isEntityAttribute($field, $entityName)) {

                        $setterName = Inflector::camelize('set' . ucwords($associationMappings['fieldName']));

                        call_user_func([$fieldEntity, $setterName], $field['value']);

                    } elseif ($this->isEntityAssociation($field, $entityName)) {

                        $associationMappings = $this->getAssociationMappings($entityName, $field);

                        $associatedEntity =
                            $this->entityManager->getRepository($associationMappings['targetEntity'])
                                ->find($field['value']);

                        $addMethod = Inflector::camelize('add' . ucwords($field['key']));

                        $fieldEntity->setContent($content);

                        call_user_func([$fieldEntity, $addMethod], $associatedEntity);
                    }

                    $getterName = $getFields = Inflector::camelize('get' . ucwords($associationMappings['fieldName']));
                    $removeField = Inflector::camelize('remove' . ucwords($associationMappings['fieldName']));

                    $oldFields = call_user_func([$content, $getterName]);

                    if ($this->entityManager->contains($content)) {

                        foreach ($oldFields as $oldField) {

                            //check if field was deleted
                            $oldFieldValue = call_user_func([$oldField, $getterName]);

                            if (!in_array($oldFieldValue, array_column($fields, 'value'))) {

                                call_user_func([$content, $removeField], $oldField);

                                $this->entityManager->remove($oldField);
                            }
                        }
                    }

                    if (array_key_exists('position', $field)) {
                        $position = $field['position'];
                        if (!$field['position'] || ($field['position'] > count($oldFields))) {
                            $position = -1;
                        }

                        if ($field['position'] < -1) {
                            $position = 0;
                        }

                        $fieldEntity->setPosition($position);
                    }

                    $fieldEntity->setContent($content);

                    $addMethod = Inflector::camelize('add' . ucwords($associationMappings['fieldName']));

                    call_user_func([$content, $addMethod], $fieldEntity);
                }
            }
        }

        return $data;
    }

    /**
     * @param $field
     * @param $entityName
     * @return bool
     */
    private function isEntityAttribute($field, $entityName)
    : bool {
        return in_array(
            $field['key'],
            $this->entityManager->getClassMetadata($entityName)
                ->getFieldNames()
        );
    }

    /**
     * @param $field
     * @param $entityName
     * @return bool
     */
    private function isEntityAssociation($field, $entityName)
    : bool {
        return in_array(
            $field['key'],
            $this->entityManager->getClassMetadata($entityName)
                ->getAssociationNames()
        );
    }

    /**
     * @param $entity
     * @param $field
     * @return mixed
     */
    private function getAssociationMappings($entity, $field)
    {
        return $this->entityManager->getClassMetadata($entity)->associationMappings[$field['key']];
    }

    /**
     * @param $types
     * @return mixed
     */
    public function countByTypes($types)
    {
        $qb = $this->contentRepository->build();

        return $qb->select(
            $qb->expr()
                ->count(config('railcontent.table_prefix') . 'content')
        )
            ->restrictByUserAccess()
            ->whereIn(config('railcontent.table_prefix') . 'content' . '.type', $types)
            ->getQuery()
            ->getSingleScalarResult();
    }
}