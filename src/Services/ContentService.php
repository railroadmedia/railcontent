<?php

namespace Railroad\Railcontent\Services;

use Railroad\DoctrineArrayHydrator\JsonApiHydrator;
use Railroad\Railcontent\Contracts\UserProviderInterface;
use Railroad\Railcontent\Entities\Comment;
use Railroad\Railcontent\Entities\Content;
use Railroad\Railcontent\Entities\ContentData;
use Railroad\Railcontent\Entities\ContentEntity;
use Railroad\Railcontent\Entities\ContentFilterResultsEntity;
use Railroad\Railcontent\Entities\ContentHierarchy;
use Railroad\Railcontent\Entities\ContentPermission;
use Railroad\Railcontent\Entities\UserContentProgress;
use Railroad\Railcontent\Events\ContentCreated;
use Railroad\Railcontent\Events\ContentDeleted;
use Railroad\Railcontent\Events\ContentSoftDeleted;
use Railroad\Railcontent\Events\ContentUpdated;
use Railroad\Railcontent\Managers\RailcontentEntityManager;
use Railroad\Railcontent\Repositories\CommentRepository;
use Railroad\Railcontent\Repositories\ContentDatumRepository;
use Railroad\Railcontent\Repositories\ContentPermissionRepository;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Support\Collection;

class ContentService
{
    /**
     * @var RailcontentEntityManager
     */
    public $entityManager;

    /**
     * @var ContentRepository
     */
    private $contentRepository;

    /**
     * @var ContentDatumRepository
     */
    private $datumRepository;

    /**
     * @var CommentRepository
     */
    private $commentRepository;

    /**
     * @var ContentPermissionRepository
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

    /**
     * Call the get by id method from repository and return the content
     *
     * @param integer $id
     * @return ContentEntity|array|null
     */
    public function getById($id)
    {
        $query =
            $this->contentRepository->build()
                ->restrictByUserAccess()
                ->andWhere(config('railcontent.table_prefix') . 'content' . '.id = :id')
                ->setParameter('id', $id)
                ->getQuery();

        $results =
            $this->entityManager->createQuery($query->getDQL())
                ->setParameters($query->getParameters())
                ->setCacheable(true)
                ->setCacheRegion('pull')
                ->getOneOrNullResult('Railcontent');

        return $results;
    }

    /**
     * Call the get by ids method from repository
     *
     * @param integer[] $ids
     * @return array|Collection|ContentEntity[]
     */
    public function getByIds($ids)
    {
        $query =
            $this->contentRepository->build()
                ->restrictByUserAccess()
                ->andWhere(config('railcontent.table_prefix') . 'content' . '.id IN (:ids)')
                ->setParameter('ids', $ids)
                ->getQuery();

        $unorderedContentRows =
            $this->entityManager->createQuery($query->getDQL())
                ->setParameters($query->getParameters())
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

    /**
     * Get all contents with specified type.
     *
     * @param string $type
     * @return array|Collection|ContentEntity[]
     */
    public function getAllByType($type)
    {
        $query =
            $this->contentRepository->build()
                ->leftJoin(config('railcontent.table_prefix') . 'content.child', 'child')
                ->restrictByUserAccess()
                ->andWhere(config('railcontent.table_prefix') . 'content' . '.type = :type')
                ->setParameter('type', $type)
                ->getQuery();

        $results =
            $this->entityManager->createQuery($query->getDQL())
                ->setParameters($query->getParameters())
                ->setCacheable(true)
                ->setCacheRegion('pull')
                ->getResult('Railcontent');

        return $results;
    }

    /**
     * Get all contents with specified status, field and type.
     *
     * @param array $types
     * @param string $status
     * @param string $fieldKey
     * @param string $fieldValue
     * @param string $fieldType
     * @param string $fieldComparisonOperator
     * @return array|Collection|ContentEntity[]
     */
    public function getWhereTypeInAndStatusAndField(
        array $types,
        $status,
        $fieldKey,
        $fieldValue,
        $fieldType,
        $fieldComparisonOperator = '='
    ) {

        $query =
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
            $query->andWhere(
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
                $query->join(
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

        $query->getQuery();

        $results =
            $this->entityManager->createQuery($query->getDQL())
                ->setParameters($query->getParameters())
                ->setCacheable(true)
                ->setCacheRegion('pull')
                ->getResult('Railcontent');

        return $results;
    }

    /**
     * Get ordered contents by type, status and published_on date.
     *
     * @param array $types
     * @param string $status
     * @param string $publishedOnValue
     * @param string $publishedOnComparisonOperator
     * @param string $orderByColumn
     * @param string $orderByDirection
     * @return array|Collection|ContentEntity[]
     */
    public function getWhereTypeInAndStatusAndPublishedOnOrdered(
        array $types,
        $status,
        $publishedOnValue,
        $publishedOnComparisonOperator = '=',
        $orderByColumn = 'publishedOn',
        $orderByDirection = 'desc'
    ) {
        $query =
            $this->contentRepository->build()
                ->restrictByUserAccess()
                ->andWhere(config('railcontent.table_prefix') . 'content' . '.type IN (:types)')
                ->andWhere(config('railcontent.table_prefix') . 'content' . '.status = :status')
                ->andWhere(
                    config('railcontent.table_prefix') .
                    'content' .
                    '.publishedOn ' .
                    $publishedOnComparisonOperator .
                    ' :publishedOn'
                )
                ->orderBy(config('railcontent.table_prefix') . 'content.' . $orderByColumn, $orderByDirection)
                ->setParameter('status', $status)
                ->setParameter('publishedOn', $publishedOnValue)
                ->setParameter('types', $types)
                ->getQuery();

        $results =
            $this->entityManager->createQuery($query->getDQL())
                ->setParameters($query->getParameters())
                ->setCacheable(true)
                ->setCacheRegion('pull')
                ->getResult('Railcontent');

        return $results;
    }

    /**
     * Get contents by slug and title.
     *
     * @param string $slug
     * @param string $type
     * @return array|Collection|ContentEntity[]
     */
    public function getBySlugAndType($slug, $type)
    {
        $query =
            $this->contentRepository->build()
                ->restrictByUserAccess()
                ->andWhere(config('railcontent.table_prefix') . 'content' . '.slug = :slug')
                ->andWhere(config('railcontent.table_prefix') . 'content' . '.type = :type')
                ->setParameter('slug', $slug)
                ->setParameter('type', $type)
                ->getQuery();

        $results =
            $this->entityManager->createQuery($query->getDQL())
                ->setParameters($query->getParameters())
                ->setCacheable(true)
                ->setCacheRegion('pull')
                ->getResult('Railcontent');

        return $results;
    }

    /**
     * Get contents by userId, type and slug.
     *
     * @param integer $userId
     * @param string $type
     * @param string $slug
     * @return array|Collection|ContentEntity[]
     */
    public function getByUserIdTypeSlug($userId, $type, $slug)
    {
        $query =
            $this->contentRepository->build()
                ->restrictByUserAccess()
                ->andWhere(config('railcontent.table_prefix') . 'content' . '.slug = :slug')
                ->andWhere(config('railcontent.table_prefix') . 'content' . '.type = :type')
                ->andWhere(config('railcontent.table_prefix') . 'content' . '.user = :user')
                ->setParameter('slug', $slug)
                ->setParameter('type', $type)
                ->setParameter('user', $userId)
                ->getQuery();

        $results =
            $this->entityManager->createQuery($query->getDQL())
                ->setCacheable(true)
                ->setCacheRegion('pull')
                ->setParameters($query->getParameters())
                ->getResult('Railcontent');

        return $results;
    }

    /**
     * Get contents based on parent id.
     *
     * @param integer $parentId
     * @param string $orderBy
     * @param string $orderByDirection
     * @return array|Collection|ContentEntity[]
     */
    public function getByParentId($parentId, $orderBy = 'childPosition', $orderByDirection = 'asc')
    {
        $query =
            $this->contentRepository->build()
                ->restrictByUserAccess()
                ->join(config('railcontent.table_prefix') . 'content' . '.parent', 'p')
                ->andWhere('p.parent = :parentId')
                ->setParameter('parentId', $parentId)
                ->orderBy('p.' . $orderBy, $orderByDirection)
                ->getQuery();

        $results =
            $this->entityManager->createQuery($query->getDQL())
                ->setParameters($query->getParameters())
                ->setCacheable(true)
                ->setCacheRegion('pull')
                ->getResult('Railcontent');

        return $results;
    }

    /**
     * Get paginated contents by parent id.
     *
     * @param integer $parentId
     * @param string $orderBy
     * @param string $orderByDirection
     * @return array|Collection|ContentEntity[]
     */
    public function getByParentIdPaginated(
        $parentId,
        $limit = 10,
        $skip = 1,
        $orderBy = 'childPosition',
        $orderByDirection = 'asc'
    ) {

        $query =
            $this->contentRepository->build()
                ->restrictByUserAccess()
                ->join(config('railcontent.table_prefix') . 'content' . '.parent', 'p')
                ->andWhere('p.parent = :parentId')
                ->setParameter('parentId', $parentId)
                ->orderBy('p.' . $orderBy, $orderByDirection)
                ->getQuery();

        $results =
            $this->entityManager->createQuery($query->getDQL())
                ->setMaxResults($limit)
                ->setFirstResult($skip * $limit)
                ->setParameters($query->getParameters())
                ->setCacheable(true)
                ->setCacheRegion('pull')
                ->getResult('Railcontent');

        return $results;
    }

    /**
     * Get ordered contents by parent id with specified type.
     *
     * @param integer $parentId
     * @param array $types
     * @param string $orderBy
     * @param string $orderByDirection
     * @return array|Collection|ContentEntity[]
     */
    public function getByParentIdWhereTypeIn(
        $parentId,
        $types,
        $orderBy = 'childPosition',
        $orderByDirection = 'asc'
    ) {

        $query =
            $this->contentRepository->build()
                ->restrictByUserAccess()
                ->join(config('railcontent.table_prefix') . 'content' . '.parent', 'p')
                ->whereIn(config('railcontent.table_prefix') . 'content' . '.type', $types)
                ->andWhere('p.parent = :parentId')
                ->setParameter('parentId', $parentId)
                ->orderBy('p.' . $orderBy, $orderByDirection)
                ->getQuery();

        $results =
            $this->entityManager->createQuery($query->getDQL())
                ->setParameters($query->getParameters())
                ->setCacheable(true)
                ->setCacheRegion('pull')
                ->getResult('Railcontent');

        return $results;
    }

    /**
     * Get ordered contents by parent id and type.
     *
     * @param integer $parentId
     * @param array $types
     * @param string $orderBy
     * @param string $orderByDirection
     * @return array|Collection|ContentEntity[]
     */
    public function getByParentIdWhereTypeInPaginated(
        $parentId,
        $types,
        $limit = 10,
        $skip = 0,
        $orderBy = 'childPosition',
        $orderByDirection = 'asc'
    ) {

        $query =
            $this->contentRepository->build()
                ->restrictByUserAccess()
                ->join(config('railcontent.table_prefix') . 'content' . '.parent', 'p')
                ->whereIn(config('railcontent.table_prefix') . 'content' . '.type', $types)
                ->andWhere('p.parent = :parentId')
                ->setParameter('parentId', $parentId)
                ->orderBy('p.' . $orderBy, $orderByDirection)
                ->getQuery();

        $results =
            $this->entityManager->createQuery($query->getDQL())
                ->setParameters($query->getParameters())
                ->setMaxResults($limit)
                ->setFirstResult($skip * $limit)
                ->setCacheable(true)
                ->setCacheRegion('pull')
                ->getResult('Railcontent');

        return $results;
    }

    /**
     * Count contents with specified type and parent id.
     *
     * @param integer $parentId
     * @param array $types
     * @return integer
     */
    public function countByParentIdWhereTypeIn(
        $parentId,
        $types
    ) {
        $query = $this->contentRepository->build();

        $query->select(
            $query->expr()
                ->count(config('railcontent.table_prefix') . 'content')
        )
            ->restrictByUserAccess()
            ->join(config('railcontent.table_prefix') . 'content' . '.parent', 'p')
            ->whereIn(config('railcontent.table_prefix') . 'content' . '.type', $types)
            ->andWhere('p.parent = :parentId')
            ->setParameter('parentId', $parentId)
            ->getQuery();

        return $this->entityManager->createQuery($query->getDQL())
            ->setParameters($query->getParameters())
            ->getSingleScalarResult('Railcontent');
    }

    /**
     * Get ordered contents based on parent ids.
     *
     * @param array $parentIds
     * @param string $orderBy
     * @param string $orderByDirection
     * @return array|Collection|ContentEntity[]
     */
    public function getByParentIds(array $parentIds, $orderBy = 'childPosition', $orderByDirection = 'asc')
    {
        $query =
            $this->contentRepository->build()
                ->restrictByUserAccess()
                ->join(config('railcontent.table_prefix') . 'content' . '.parent', 'p')
                ->whereIn('p.parent', $parentIds)
                ->orderBy('p.' . $orderBy, $orderByDirection)
                ->getQuery();

        return $this->entityManager->createQuery($query->getDQL())
            ->setParameters($query->getParameters())
            ->setCacheable(true)
            ->setCacheRegion('pull')
            ->getResult('Railcontent');
    }

    /**
     * Get contents by child and type.
     *
     * @param integer $childId
     * @param string $type
     * @return array|Collection|ContentEntity[]
     */
    public function getByChildIdWhereType($childId, $type)
    {
        $query =
            $this->contentRepository->build()
                ->restrictByUserAccess()
                ->join(config('railcontent.table_prefix') . 'content' . '.child', 'c')
                ->andWhere('c.child = :childId')
                ->andWhere(config('railcontent.table_prefix') . 'content' . '.type = :type')
                ->setParameter('type', $type)
                ->setParameter('childId', $childId)
                ->getQuery();

        return $this->entityManager->createQuery($query->getDQL())
            ->setParameters($query->getParameters())
            ->setCacheable(true)
            ->setCacheRegion('pull')
            ->getResult('Railcontent');
    }

    /**
     * Get contents by child ids with specified type.
     *
     * @param array $childIds
     * @param string $type
     * @return array|Collection|ContentEntity[]
     */
    public function getByChildIdsWhereType(array $childIds, $type)
    {
        $query =
            $this->contentRepository->build()
                ->restrictByUserAccess()
                ->join(config('railcontent.table_prefix') . 'content' . '.child', 'c')
                ->whereIn('c.child', $childIds)
                ->andWhere(config('railcontent.table_prefix') . 'content' . '.type = :type')
                ->setParameter('type', $type)
                ->getQuery();

        return $this->entityManager->createQuery($query->getDQL())
            ->setParameters($query->getParameters())
            ->setCacheable(true)
            ->setCacheRegion('pull')
            ->getResult('Railcontent');
    }

    /**
     * Get contents by child id where parent type met the criteria.
     *
     * @param integer $childId
     * @param array $types
     * @return array|Collection|ContentEntity[]
     */
    public function getByChildIdWhereParentTypeIn($childId, array $types)
    {
        $query =
            $this->contentRepository->build()
                ->restrictByUserAccess()
                ->join(config('railcontent.table_prefix') . 'content' . '.child', 'c')
                ->whereIn('c.child', [$childId])
                ->andWhere(config('railcontent.table_prefix') . 'content' . '.type IN (:type)')
                ->setParameter('type', $types)
                ->getQuery();

        return $this->entityManager->createQuery($query->getDQL())
            ->setParameters($query->getParameters())
            ->setCacheable(true)
            ->setCacheRegion('pull')
            ->getResult('Railcontent');
    }

    /**
     * Get paginated contents by type and user progress state.
     *
     * @param string $type
     * @param integer $userId
     * @param string $state
     * @param int $limit
     * @param int $skip
     * @return array|Collection|ContentEntity[]
     */
    public function getPaginatedByTypeUserProgressState($type, $userId, $state, $limit = 25, $skip = 0)
    {
        $alias = 'up';

        $query =
            $this->entityManager->getRepository(UserContentProgress::class)
                ->createQueryBuilder($alias);

        $query->join(
            $alias . '.content',
            config('railcontent.table_prefix') . 'content'
        );
        $query->where($alias . '.user = :userId')
            ->andWhere($alias . '.state = :state')
            ->andWhere(config('railcontent.table_prefix') . 'content' . '.type IN (:types)')
            ->setParameter('userId', $userId)
            ->setParameter('state', $state)
            ->setParameter('types', $type)
            ->getQuery();

        $results =
            $this->entityManager->createQuery($query->getDQL())
                ->setParameters($query->getParameters())
                ->setFirstResult($skip)
                ->setMaxResults($limit)
                ->setCacheable(true)
                ->setCacheRegion('pull')
                ->getResult('Railcontent');

        return $results;
    }

    /**
     * Get paginated contents by types and user progress state.
     *
     * @param array $types
     * @param integer $userId
     * @param string $state
     * @param int $limit
     * @param int $skip
     * @return array|Collection|ContentEntity[]
     */
    public function getPaginatedByTypesUserProgressState(
        array $types,
        $userId,
        $state,
        $limit = 25,
        $skip = 0
    ) {
        $alias = 'up';

        $query =
            $this->entityManager->getRepository(UserContentProgress::class)
                ->createQueryBuilder($alias);

        $query->join(
            $alias . '.content',
            config('railcontent.table_prefix') . 'content'
        );

        $query->where($alias . '.user = :userId')
            ->andWhere($alias . '.state = :state')
            ->andWhere(config('railcontent.table_prefix') . 'content' . '.type IN (:types)')
            ->setParameter('userId', $userId)
            ->setParameter('state', $state)
            ->setParameter('types', $types)
            ->getQuery();

        $results =
            $this->entityManager->createQuery($query->getDQL())
                ->setParameters($query->getParameters())
                ->setFirstResult($skip)
                ->setMaxResults($limit)
                ->setCacheable(true)
                ->setCacheRegion('pull')
                ->getResult('Railcontent');

        return $results;
    }

    /**
     * Get recent paginated contents by types and user progress state.
     *
     * @param array $types
     * @param integer $userId
     * @param string $state
     * @param int $limit
     * @param int $skip
     * @return array|Collection|ContentEntity[]
     */
    public function getPaginatedByTypesRecentUserProgressState(
        array $types,
        $userId,
        $state,
        $limit = 25,
        $skip = 0
    ) {
        //user
        $alias = 'up';

        $query =
            $this->entityManager->getRepository(UserContentProgress::class)
                ->createQueryBuilder($alias);

        $query->join(
            $alias . '.content',
            config('railcontent.table_prefix') . 'content'
        );
        $query->where($alias . '.user = :userId')
            ->andWhere($alias . '.state = :state')
            ->andWhere(config('railcontent.table_prefix') . 'content' . '.type IN (:types)')
            ->setMaxResults($limit)
            ->setFirstResult($skip)
            ->orderBy($alias . '.updatedOn', 'desc')
            ->setParameter('userId', $userId)
            ->setParameter('state', $state)
            ->setParameter('types', $types)
            ->getQuery();

        $results =
            $this->entityManager->createQuery($query->getDQL())
                ->setParameters($query->getParameters())
                ->setFirstResult($skip)
                ->setMaxResults($limit)
                ->setCacheable(true)
                ->setCacheRegion('pull')
                ->getResult('Railcontent');

        return $results;
    }

    /**
     * Count recent contents with user progress state and type.
     *
     * @param array $types
     * @param integer $userId
     * @param string $state
     * @param int $limit
     * @param int $skip
     * @return array|Collection|ContentEntity[]
     */
    public function countByTypesRecentUserProgressState(
        array $types,
        $userId,
        $state
    ) {
        $alias = 'up';

        $query =
            $this->entityManager->getRepository(UserContentProgress::class)
                ->createQueryBuilder($alias);

        $query->select('count(' . $alias . '.id)')
            ->join(
                $alias . '.content',
                config('railcontent.table_prefix') . 'content'
            );
        $query->where($alias . '.user = :userId')
            ->andWhere($alias . '.state = :state')
            ->andWhere(config('railcontent.table_prefix') . 'content' . '.type IN (:types)')
            ->setParameter('userId', $userId)
            ->setParameter('state', $state)
            ->setParameter('types', $types)
            ->getQuery();

        $results =
            $this->entityManager->createQuery($query->getDQL())
                ->setParameters($query->getParameters())
                ->getSingleScalarResult();

        return $results;
    }

    /**
     * Get neighbouring siblings by type.
     *
     * @param string $type
     * @param string $columnName
     * @param string $columnValue
     * @param int $siblingPairLimit
     * @param string $orderColumn
     * @param string $orderDirection
     * @return array|ContentEntity|Collection
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

    /**
     * Count contents by type and user progress state.
     *
     * @param array $types
     * @param integer $userId
     * @param string $state
     * @return integer
     */
    public function countByTypesUserProgressState(array $types, $userId, $state)
    {
        $alias = 'up';

        $query =
            $this->entityManager->getRepository(UserContentProgress::class)
                ->createQueryBuilder($alias);

        $query->select('count(' . $alias . '.id)')
            ->join(
                $alias . '.content',
                config('railcontent.table_prefix') . 'content'
            );

        $query->where($alias . '.user = :userId')
            ->andWhere($alias . '.state = :state')
            ->andWhere(config('railcontent.table_prefix') . 'content' . '.type IN (:types)')
            ->setParameter('userId', $userId)
            ->setParameter('state', $state)
            ->setParameter('types', $types)
            ->getQuery();

        $results =
            $this->entityManager->createQuery($query->getDQL())
                ->setParameters($query->getParameters())
                ->getSingleScalarResult();

        return $results;
    }

    /**
     * Get contents by child ids with specified type.
     *
     * @param array $childIds
     * @param string $type
     * @return array|Collection|ContentEntity[]
     */
    public function getByUserIdWhereChildIdIn($userId, array $childContentIds, $slug = null)
    {
        $query =
            $this->contentRepository->build()
                ->restrictByUserAccess()
                ->join(config('railcontent.table_prefix') . 'content' . '.child', 'c')
                ->whereIn('c.child', $childContentIds)
                ->andWhere(config('railcontent.table_prefix') . 'content' . '.user = :user')
                ->setParameter('user', $userId);

        if ($slug) {
            $query->andWhere(config('railcontent.table_prefix') . 'content' . '.slug = :slug')
                ->setParameter('slug', $slug);
        }
        $query->getQuery();

        $results =
            $this->entityManager->createQuery($query->getDQL())
                ->setParameters($query->getParameters())
                ->setCacheable(true)
                ->setCacheRegion('pull')
                ->getResult('Railcontent');

        return $results;
    }

    /**
     * Get filtered contents.
     * Returns:
     * ['results' => $lessons, 'total_results' => $totalLessonsAfterFiltering]
     *
     * @param int $page
     * @param int $limit
     * @param string $orderByAndDirection
     * @param array $includedTypes
     * @param array $slugHierarchy
     * @param array $requiredParentIds
     * @param array $requiredFields
     * @param array $includedFields
     * @param array $requiredUserStates
     * @param array $includedUserStates
     * @param boolean $pullFilterFields
     * @return ContentFilterResultsEntity
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
     * @throws \Doctrine\DBAL\DBALException
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \ReflectionException
     */
    public function create(
        $data
    ) {
        $content = new Content();

        $data = $this->saveContentFields($data, $content);

        $this->jsonApiHydrator->hydrate($content, $data);

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
            $parentId = $data['data']['relationships']['parent']['data']['id'];
            $parent = $this->contentRepository->find($parentId);

            $hierarchy = new ContentHierarchy();
            $hierarchy->setParent($parent);
            $hierarchy->setChild($content);
            $this->entityManager->persist($hierarchy);
            $this->entityManager->flush();
        }

        $this->entityManager->getCache('Railcontent')
            ->evictEntityRegion(Content::class);

        $this->entityManager->getCache('Railcontent')
            ->evictEntity(Content::class, 'pull');

        event(new ContentCreated($content->getId()));

        return $content;
    }

    /**
     * Update and return the updated content.
     *
     * @param integer $id
     * @param array $data
     * @return array|ContentEntity
     */
    public function update($id, array $data)
    {
        $content = $this->contentRepository->find($id);

        if (empty($content)) {
            return null;
        }

        $data = $this->saveContentFields($data, $content);

        $this->jsonApiHydrator->hydrate($content, $data);

        $this->entityManager->persist($content);
        $this->entityManager->flush();

        event(new ContentUpdated($id));

        $this->entityManager->getCache()
            ->evictEntityRegion(Content::class);

        return $content;
    }

    /**
     * Call the delete method from repository and returns true if the content was deleted
     *
     * @param $id
     * @return bool|null - if the content not exist
     */
    public function delete($id)
    {
        $content = $this->contentRepository->find($id);

        if (empty($content)) {
            return null;
        }
        event(new ContentDeleted($id));

        $this->entityManager->remove($content);
        $this->entityManager->flush();

        $this->entityManager->getCache()
            ->evictEntity(Content::class, $id);

        return true;
    }

    /**
     * Delete data related with the specified content id.
     *
     * @param integer $contentId
     */
    public function deleteContentRelated($contentId)
    {
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
     * @param array $contents
     * @param null $singlePlaylistSlug
     * @return array|Collection|ContentEntity[]
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

    /**
     * Call the update method from repository to mark the content as deleted and returns true if the content was updated
     *
     * @param $id
     * @return bool|null - if the content not exist
     */
    public function softDelete($id)
    {
        $content = $this->contentRepository->find($id);

        if (empty($content)) {
            return null;
        }

        $content->setStatus(ContentService::STATUS_DELETED);

        event(new ContentSoftDeleted($id));

        $this->entityManager->persist($content);
        $this->entityManager->flush();

        $this->entityManager->getCache()
            ->evictEntityRegion(Content::class);

        return $content;
    }

    /**
     * Soft delete the children for specified content id.
     *
     * @param int $id
     * @return int
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

    /**
     * Get contents by field value and types.
     *
     * @param array $contentTypes
     * @param string $contentFieldKey
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
     * @throws \Doctrine\DBAL\DBALException
     * @throws \Doctrine\ORM\ORMException
     * @throws \ReflectionException
     */
    private function saveContentFields($data, Content $content)
    {
        if (array_key_exists('fields', $data['data']['attributes'])) {
            $fields = $data['data']['attributes']['fields'];
            $groupedFields = $fields;

            foreach ($fields as $field) {
                if (strpos($field['key'], '_') !== false || strpos($field['key'], '-') !== false) {
                    $field['key'] = camel_case($field['key']);
                }

                if ($this->isEntityAttribute($field, Content::class)) {

                    $data['data']['attributes'] = array_merge(
                        $data['data']['attributes'],
                        [
                            $field['key'] => $field['value'],
                        ]
                    );

                } elseif ($this->isEntityAssociation($field, Content::class)) {

                    $associationMappings = $this->getAssociationMappings(get_class($content), $field);

                    $entityName = $associationMappings['targetEntity'];

                    $fieldEntity = new $entityName();

                    if ($this->isEntityAttribute($field, $entityName)) {

                        $field[$associationMappings['fieldName']] = $field['value'];

                    } elseif ($this->isEntityAssociation($field, $entityName)) {

                        $associationMappings = $this->getAssociationMappings($entityName, $field);

                        $associatedEntity =
                            $this->entityManager->getRepository($associationMappings['targetEntity'])
                                ->find($field['value']);

                        $addMethod = 'add' . ucwords($field['key']);

                        $fieldEntity->setContent($content);
                        $fieldEntity->$addMethod($associatedEntity);
                    }

                    $this->jsonApiHydrator->hydrate(
                        $fieldEntity,
                        [
                            'data' => [
                                'attributes' => $field,
                            ],
                        ]
                    );

                    $getFields = 'get' . ucwords($associationMappings['fieldName']);

                    if ($this->entityManager->contains($content)) {

                        $oldFields = $content->$getFields();
                        $removeField = 'remove' . ucwords($associationMappings['fieldName']);

                        foreach ($oldFields as $oldField) {
                            //check if field was deleted
                            if (!in_array($oldField->$getFields(), array_column($groupedFields, 'value'))) {
                                $content->$removeField($oldField);
                                $this->entityManager->remove($oldField);
                            }
                        }
                    }

                    if (array_key_exists('position', $field)) {
                        $position = $field['position'];
                        if (!$field['position'] || ($field['position'] > count($content->$getFields()))) {
                            $position = -1;
                        }

                        if ($field['position'] < -1) {
                            $position = 0;
                        }

                        $fieldEntity->setPosition($position);
                    }

                    $fieldEntity->setContent($content);

                    $addFieldNameMethod = 'add' . ucwords($associationMappings['fieldName']);
                    $content->$addFieldNameMethod($fieldEntity);
                }
            }
        }
        return $data;
    }

    /**
     * @param $field
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
}