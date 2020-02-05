<?php

namespace Railroad\Railcontent\Services;

use Carbon\Carbon;
use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Railroad\Railcontent\Contracts\UserProviderInterface;
use Railroad\Railcontent\Entities\Content;
use Railroad\Railcontent\Entities\UserContentProgress;
use Railroad\Railcontent\Events\UserContentProgressSaved;
use Railroad\Railcontent\Managers\RailcontentEntityManager;
use Railroad\Railcontent\Repositories\UserContentProgressRepository;
use Railroad\Railcontent\Support\Collection;

class UserContentProgressService
{
    /**
     * @var RailcontentEntityManager
     */
    private $entityManager;

    /**
     * @var ObjectRepository|EntityRepository
     */
    protected $userContentRepository;

    /**
     * @var ContentHierarchyService
     */
    private $contentHierarchyService;

    /**
     * @var ContentService
     */
    private $contentService;

    /**
     * @var UserProviderInterface
     */
    private $userProvider;

    const STATE_STARTED = 'started';
    const STATE_COMPLETED = 'completed';

    /**
     * UserContentProgressService constructor.
     *
     * @param ContentHierarchyService $contentHierarchyService
     * @param RailcontentEntityManager $entityManager
     * @param ContentService $contentService
     * @param UserProviderInterface $userProvider
     * @param UserContentProgressRepository $userContentProgressRepository
     */
    public function __construct(
        ContentHierarchyService $contentHierarchyService,
        RailcontentEntityManager $entityManager,
        ContentService $contentService,
        UserProviderInterface $userProvider,
        UserContentProgressRepository $userContentProgressRepository
    ) {
        $this->entityManager = $entityManager;
        $this->contentHierarchyService = $contentHierarchyService;
        $this->contentService = $contentService;
        $this->userProvider = $userProvider;
        $this->userContentRepository = $userContentProgressRepository;
    }

    /**
     * @param $contentType
     * @param $userId
     * @param $state
     * @return mixed
     * @throws NoResultException
     * @throws NonUniqueResultException
     */
    public function getMostRecentByContentTypeUserState($contentType, $userId, $state)
    {
        $user = $this->userProvider->getUserById($userId);

        $alias = 'uc';
        $aliasContent = 'c';
        $qb = $this->userContentRepository->createQueryBuilder($alias);
        $qb->join(
            $alias . '.content',
            $aliasContent
        )
            ->where($aliasContent . '.brand = :brand')
            ->andWhere($aliasContent . '.type = :contentType')
            ->andWhere($alias . '.state = :state')
            ->andWhere($alias . '.user = :user')
            ->setParameters(
                [
                    'brand' => config('railcontent.brand'),
                    'contentType' => $contentType,
                    'state' => $state,
                    'user' => $user,
                ]
            )
            ->setMaxResults(1)
            ->orderByColumn($alias, 'updatedOn', 'desc');

        return $qb->getQuery()
            ->getOneOrNullResult('Railcontent');
    }

    /** Keyed by content id.
     *
     * [ content_id => count ]
     *
     * @param $state
     * @param $contentIds
     * @return array|false
     */
    public function countTotalStatesForContentIds($state, $contentIds)
    {
        $alias = 'up';
        $contentAlias = 'c';
        $qb = $this->userContentRepository->createQueryBuilder($alias);

        $qb->select('count(' . $alias . '.id) as count,' . $contentAlias . '.id as content_id')
            ->join($alias . '.content', $contentAlias)
            ->where($alias . '.state = :state')
            ->andWhere($contentAlias . '.id' . ' IN (:contentIds)')
            ->setParameter('state', $state)
            ->setParameter('contentIds', $contentIds)
            ->groupBy($contentAlias . '.id');

        $results =
            $qb->getQuery()
                ->getResult('Railcontent');

        return array_combine(array_column($results, 'content_id'), array_column($results, 'count'));
    }

    /**
     * @param $contentId
     * @param $userId
     * @param bool $forceEvenIfComplete
     * @return bool
     * @throws NonUniqueResultException
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function startContent($contentId, $userId, $forceEvenIfComplete = false)
    {
        $progressPercent = 0;

        $children = $this->contentService->getByParentId($contentId);

        $content = $this->contentService->getById($contentId);

        $user = $this->userProvider->getUserById($userId);

        if (!empty($children)) {

            /*
             * Check for children with progress_percent values that should be used in calculating the progress_percent
             * to set here on the parent. For (edge) cases where parent is of type not allowed for progress-bubbling on
             * child start. Otherwise despite child progress, parent would be marked started here but with inaccurate
             * progress value of 0.
             *
             * Jonathan, Dec 2017
             */

            $progressPercent = $this->getProgressPercentage($userId, $children);
        }

        $isCompleted = $this->userContentRepository->getByUserContentState($user, $content, 'completed');

        if (!$isCompleted || $forceEvenIfComplete) {
            $userContentProgress = $this->userContentRepository->getByUserContentState($user, $content);

            if (!$userContentProgress) {
                $userContentProgress = new UserContentProgress();
            }

            $userContentProgress->setProgressPercent($progressPercent);
            $userContentProgress->setState(self::STATE_STARTED);
            $userContentProgress->setUser($user);
            $userContentProgress->setContent($content);
            $userContentProgress->setUpdatedOn(Carbon::parse(now()));

            $this->entityManager->persist($userContentProgress);

            $this->entityManager->flush();
        }

        $this->entityManager->getCache()
            ->evictEntityRegion(Content::class);

        UserContentProgressRepository::$cache = [];

        event(new UserContentProgressSaved($user, $content, $progressPercent, self::STATE_STARTED));

        return true;
    }

    /**
     * @param $contentId
     * @param $userId
     * @return bool
     * @throws NonUniqueResultException
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function completeContent($contentId, $userId)
    {
        if (is_null($contentId)) {
            error_log(
                print_r(
                    [
                        'method' => 'completeContent',
                        '$contentId' => $contentId,
                        '$progress' => '(not present for "completeContent" method. -Jonathan)',
                        '$userId' => $userId,
                    ],
                    true
                )
            );
        }

        $content = $this->contentService->getById($contentId, false);
        $user = $this->userProvider->getUserById($userId);

        $userContentProgress = $this->userContentRepository->getByUserContentState($user, $content);

        if (!$userContentProgress) {
            $userContentProgress = new UserContentProgress();
        }

        $userContentProgress->setProgressPercent(100);
        $userContentProgress->setState(self::STATE_COMPLETED);
        $userContentProgress->setUser($user);
        $userContentProgress->setContent($content);
        $userContentProgress->setUpdatedOn(Carbon::parse(now()));

        $this->entityManager->persist($userContentProgress);
        $this->entityManager->flush();

        $childIds = [];
        // also mark children as complete
        $hierarchies = $this->contentHierarchyService->getByParentIds([$contentId]);
        foreach ($hierarchies as $hierarchy) {
            $childIds[] =
                $hierarchy->getChild()
                    ->getId();
        }

        $userContentProgress = $this->userContentRepository->getByUserIdAndWhereContentIdIn($user, $childIds);
        $existingProgress = [];
        foreach ($userContentProgress as $progress) {
            $existingProgress[$progress->getContent()
                ->getId()] = $progress;
        }

        foreach ($hierarchies as $child) {
            $userContentProgress = new UserContentProgress();
            if (array_key_exists($child->getId(), $existingProgress)) {
                $userContentProgress = $existingProgress[$child->getId()];
            }

            $userContentProgress->setProgressPercent(100);
            $userContentProgress->setState(self::STATE_COMPLETED);
            $userContentProgress->setUser($user);
            $userContentProgress->setContent($child->getChild());
            $userContentProgress->setUpdatedOn(Carbon::parse(now()));

            $this->entityManager->persist($userContentProgress);
            $this->entityManager->flush();
        }

        event(new UserContentProgressSaved($user, $content, 100, self::STATE_COMPLETED));

        $this->entityManager->getCache()
            ->evictEntityRegion(Content::class);

        UserContentProgressRepository::$cache = [];

        return true;
    }

    /**
     * @param $contentId
     * @param $userId
     * @return bool
     * @throws NonUniqueResultException
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function resetContent($contentId, $userId)
    {
        $content = $this->contentService->getById($contentId, false);
        $user = $this->userProvider->getUserById($userId);

        $userContentProgress = $this->userContentRepository->getByUserContentState($user, $content);

        if ($userContentProgress) {
            $this->entityManager->remove($userContentProgress);
            $this->entityManager->flush();
        }

        // also reset progress on children
        $childIds = [$contentId];

        $hierarchies = $this->contentHierarchyService->getByParentIds($childIds);

        foreach ($hierarchies as $hierarchy) {
            $child = $hierarchy->getChild();

            $userContentProgress = $this->userContentRepository->getByUserContentState($user, $child);

            if ($userContentProgress) {
                $this->entityManager->remove($userContentProgress);
                $this->entityManager->flush();
            }
        }

        //delete user content progress cache
        UserContentProgressRepository::$cache = [];

        event(new UserContentProgressSaved($user, $content, 0, self::STATE_STARTED));

        //delete user progress from cache
        $this->entityManager->getCache()
            ->evictEntityRegion(Content::class);

        return true;
    }

    /**
     * @param $contentId
     * @param $progress
     * @param $userId
     * @param bool $overwriteComplete
     * @return bool
     * @throws NonUniqueResultException
     * @throws ORMException
     * @throws OptimisticLockException
     *
     */
    public function saveContentProgress($contentId, $progress, $userId, $overwriteComplete = false)
    {

        if (is_null($contentId)) {
            error_log(
                print_r(
                    [
                        'method' => 'saveContentProgress',
                        '$contentId' => $contentId,
                        '$progress' => print_r($progress, true),
                        '$userId' => $userId,
                    ],
                    true
                )
            );
        }

        $content = $this->contentService->getById($contentId, false);
        $user = $this->userProvider->getUserById($userId);
        $state = ($progress == 100) ? self::STATE_COMPLETED : self::STATE_STARTED;

        $userContentProgress = $this->userContentRepository->getByUserContentState($user, $content);

        if ($userContentProgress &&
            !$overwriteComplete &&
            ($userContentProgress->getState() == 'completed' || $userContentProgress->getProgressPercent() == 100)) {
            return true;
        }

        if (!$userContentProgress) {
            $userContentProgress = new UserContentProgress();
            $userContentProgress->setUser($user);
            $userContentProgress->setContent($content);
        }

        $userContentProgress->setProgressPercent($progress);
        $userContentProgress->setState($state);
        $userContentProgress->setUpdatedOn(Carbon::parse(now()));

        $this->entityManager->persist($userContentProgress);
        $this->entityManager->flush();

        $this->entityManager->getCache()
            ->evictEntityRegion(Content::class);

        UserContentProgressRepository::$cache = [];

        event(new UserContentProgressSaved($user, $content, $progress, $state));

        return true;
    }

    /**
     * @param $user
     * @param $content
     * @return bool
     * @throws NonUniqueResultException
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function bubbleProgress($user, $content)
    {
        $allowedTypesForStarted = config('railcontent.allowed_types_for_bubble_progress')['started'];
        $allowedTypesForCompleted = config('railcontent.allowed_types_for_bubble_progress')['completed'];
        $allowedTypes = array_unique(array_merge($allowedTypesForStarted, $allowedTypesForCompleted));

        $parents = $this->contentService->getByChildIdWhereParentTypeIn(
            $content->getId(),
            $allowedTypes,
            false
        );

        foreach ($parents as $parent) {
            // start parent if necessary
            if ($content->isStarted() &&
                !$parent->isStarted() &&
                in_array($parent->getType(), $allowedTypesForStarted)) {
                $this->startContent($parent->getId(), $user->getId());
            }

            // get siblings
            $siblings = $parent->getChild() ?? $this->attachProgressToContents(
                    $user->getId(),
                    $this->contentService->getByParentId($parent->getId(), 'childPosition', 'asc', false)
                );

            if (is_array($siblings)) {
                $siblings = new Collection($siblings);
            }

            // complete parent content if necessary
            if ($content->isCompleted()) {
                $complete = true;
                foreach ($siblings as $sibling) {
                    if (!$sibling->getChild()
                        ->isCompleted()) {
                        $complete = false;
                    }
                }
                if ($complete && !$parent->isCompleted() && in_array($parent->getType(), $allowedTypesForCompleted)) {
                    $this->completeContent($parent->getId(), $user->getId());
                }
            }

            // calculate and save parent progress percent from children
            $alreadyStarted = $parent->isStarted();
            $typeAllows = in_array($parent->getType(), $allowedTypesForStarted);

            if ($alreadyStarted || $typeAllows) {
                $this->saveContentProgress(
                    $parent->getId(),
                    $this->getProgressPercentage(
                        $user->getId(),
                        $this->contentService->getByParentId($parent->getId(), 'childPosition', 'asc', false)
                    ),
                    $user->getId(),
                    true
                );
            }
        }

        return true;
    }

    /**
     * @param $userId
     * @param $siblings
     * @return float|int
     */
    private function getProgressPercentage($userId, $siblings)
    {
        $progressOfSiblings = [];
        $percentages = [];

        foreach ($siblings as $sibling) {
            if (!empty(
            $sibling->getUserProgress($userId)
            )) {
                $progressOfSiblings[] = $sibling->getUserProgress($userId);
            }
        }

        foreach ($progressOfSiblings as $progressOfSingleDeNestedSibling) {
            if (!empty($progressOfSingleDeNestedSibling)) {
                $percentages[] = $progressOfSingleDeNestedSibling->getProgressPercent();
            } else {
                $percentages[] = 0;
            }
        }

        $arraySum = array_sum($percentages);
        $siblingCount = count($siblings);

        if ($siblingCount == 0) {
            return 0;
        }

        return $arraySum / $siblingCount;
    }

    /**
     * @param $id
     * @return array
     */
    public function getForUser($id)
    {
        $user = $this->userProvider->getUserById($id);

        $alias = 'uc';
        $contentAlias = 'c';

        $qb = $this->userContentRepository->createQueryBuilder($alias);

        $qb->join($alias . '.content', $contentAlias)
            ->where($alias . '.user = :user')
            ->andWhere($contentAlias . '.brand' . ' = :brand')
            ->setParameter('brand', config('railcontent.brand'))
            ->setParameter('user', $user)
            ->setMaxResults(100);

        $results =
            $qb->getQuery()
                ->getResult('Railcontent');

        return $results;
    }

    /**
     * @param $id
     * @param array $types
     * @param string $state
     * @param string $orderByColumn
     * @param string $orderByDirection
     * @param int $limit
     * @return array
     */
    public function getForUserStateContentTypes(
        $id,
        array $types,
        $state,
        $orderByColumn = '-updated_on',
        $limit = 25
    ) {
        $user = $this->userProvider->getUserById($id);

        $alias = 'uc';
        $aliasContent = 'c';

        $qb = $this->userContentRepository->createQueryBuilder($alias);

        $qb->join($alias . '.content', $aliasContent)
            ->where($aliasContent . '.brand = :brand')
            ->andWhere($aliasContent . '.type IN (:contentType)')
            ->andWhere($alias . '.state = :state')
            ->andWhere($alias . '.user = :user')
            ->setParameters(
                [
                    'brand' => config('railcontent.brand'),
                    'contentType' => $types,
                    'state' => $state,
                    'user' => $user,
                ]
            )
            ->setMaxResults($limit)
            ->sorted($alias, $orderByColumn);

        return $qb->getQuery()
            ->getResult('Railcontent');
    }

    /**
     * @param $id
     * @param $type
     * @param null $state
     * @return mixed
     */
    public function getLessonsForUserByType($id, $type, $state = null)
    {
        $user = $this->userProvider->getUserById($id);

        $alias = 'uc';
        $aliasContent = 'c';

        $qb = $this->userContentRepository->createQueryBuilder($alias);

        $qb->join($alias . '.content', $aliasContent)
            ->where($aliasContent . '.brand = :brand')
            ->andWhere($aliasContent . '.type = :contentType')
            ->andWhere($alias . '.user = :user');

        if ($state) {
            $qb->andWhere($alias . '.state = :state')
                ->setParameter('state', $state);
        }

        $qb->setParameter('brand', config('railcontent.brand'))
            ->setParameter('contentType', $type)
            ->setParameter('user', $user);

        return $qb->getQuery()
            ->getResult('Railcontent');
    }

    /**
     * @param $id
     * @param $type
     * @param $state
     * @return mixed
     * @throws NoResultException
     * @throws NonUniqueResultException
     */
    public function countLessonsForUserByTypeAndProgressState($id, $type, $state)
    {
        $user = $this->userProvider->getUserById($id);

        $alias = 'uc';
        $aliasContent = 'c';

        $qb = $this->userContentRepository->createQueryBuilder($alias);

        $qb->select('count(' . $alias . '.id) as count')
            ->join($alias . '.content', $aliasContent)
            ->where($aliasContent . '.brand = :brand')
            ->andWhere($aliasContent . '.type = :contentType')
            ->andWhere($alias . '.user = :user');

        if ($state) {
            $qb->andWhere($alias . '.state = :state')
                ->setParameter('state', $state);
        }

        $qb->setParameter('brand', config('railcontent.brand'))
            ->setParameter('contentType', $type)
            ->setParameter('user', $user);

        $results =
            $qb->getQuery()
                ->getSingleResult('Railcontent');

        return $results['count'];
    }

    /**
     * @param $contentTypes
     * @param $userId
     * @param string $orderByColumn
     * @param int $limit
     * @return mixed
     */
    public function getRecentActivitiesOnContentTypes(
        $contentTypes,
        $userId,
        $orderByColumn = '-updated_on',
        $limit = 10
    ) {
        $user = $this->userProvider->getUserById($userId);

        $alias = 'uc';
        $aliasContent = 'c';
        $qb = $this->userContentRepository->createQueryBuilder($alias);
        $qb->join(
            $alias . '.content',
            $aliasContent
        )
            ->where($aliasContent . '.type' . ' IN (:contentTypes)')
            ->andWhere($aliasContent . '.brand = :brand')
            ->andWhere($alias . '.user = :user')
            ->setParameters(
                [
                    'brand' => config('railcontent.brand'),
                    'contentTypes' => $contentTypes,
                    'user' => $user,
                ]
            )
             ->setMaxResults($limit)
            ->sorted($alias, $orderByColumn);

        return $qb->getQuery()
            ->getResult('Railcontent');
    }
}