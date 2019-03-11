<?php

namespace Railroad\Railcontent\Services;

use Carbon\Carbon;
use Doctrine\ORM\EntityManager;
use Railroad\Railcontent\Contracts\UserProviderInterface;
use Railroad\Railcontent\Entities\Content;
use Railroad\Railcontent\Entities\UserContentProgress;
use Railroad\Railcontent\Events\UserContentProgressSaved;
use Railroad\Railcontent\Events\UserContentsProgressReset;
use Railroad\Railcontent\Repositories\UserContentProgressRepository;
use Railroad\Railcontent\Support\Collection;

class UserContentProgressService
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * @var UserContentProgressRepository
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
     * @param EntityManager $entityManager
     * @param ContentService $contentService
     */
    public function __construct(
        ContentHierarchyService $contentHierarchyService,
        EntityManager $entityManager,
        ContentService $contentService,
        UserProviderInterface $userProvider
    ) {
        $this->entityManager = $entityManager;
        $this->contentHierarchyService = $contentHierarchyService;
        $this->contentService = $contentService;
        $this->userProvider = $userProvider;

        $this->userContentRepository = $this->entityManager->getRepository(UserContentProgress::class);
    }

    /**
     * @param $contentType
     * @param $userId
     * @param $state
     * @return array
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
                    'brand' => ConfigService::$brand,
                    'contentType' => $contentType,
                    'state' => $state,
                    'user' => $user,
                ]
            )
            ->setMaxResults(1)
            ->orderBy($alias . '.updatedOn', 'desc');

        return $qb->getQuery()
            ->getSingleResult();
    }

    /**
     * Keyed by content id.
     *
     * [ content_id => count ]
     *
     * @param $state
     * @param $contentIds
     * @return mixed
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
                ->getResult();

        return array_combine(array_column($results, 'content_id'), array_column($results, 'count'));
    }

    /**
     * @param $contentId
     * @param $userId
     * @param bool $forceEvenIfComplete
     * @return bool
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

        $isCompleted = $this->userContentRepository->findOneBy(
            [
                'user' => $user,
                'content' => $content,
                'state' => 'completed',

            ]
        );

        if (!$isCompleted || $forceEvenIfComplete) {
            $userContentProgress = $this->userContentRepository->findOneBy(
                [
                    'user' => $user,
                    'content' => $content,
                ]
            );

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

        event(new UserContentProgressSaved($userId, $contentId));

        return true;
    }

    /**
     * @param integer $contentId
     * @param integer $userId
     * @return bool
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

        $content = $this->contentService->getById($contentId);
        $user = $this->userProvider->getUserById($userId);

        $userContentProgress = $this->userContentRepository->findOneBy(
            [
                'user' => $user,
                'content' => $content,
            ]
        );
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

        // also mark children as complete
        $childIds = [$contentId];

        $hierarchies = $this->contentHierarchyService->getByParentIds($childIds);

        foreach ($hierarchies as $hierarchy) {
            $child = $hierarchy->getChild();

            $userContentProgress = $this->userContentRepository->findOneBy(
                [
                    'user' => $user,
                    'content' => $child,
                ]
            );

            if (!$userContentProgress) {
                $userContentProgress = new UserContentProgress();
            }

            $userContentProgress->setProgressPercent(100);
            $userContentProgress->setState(self::STATE_COMPLETED);
            $userContentProgress->setUser($user);
            $userContentProgress->setContent($child);
            $userContentProgress->setUpdatedOn(Carbon::parse(now()));

            $this->entityManager->persist($userContentProgress);
            $this->entityManager->flush();

            event(new UserContentProgressSaved($userId, $child->getId(), false));
        }

        event(new UserContentProgressSaved($userId, $contentId));

        $this->entityManager->getCache()
            ->evictEntityRegion(Content::class);

        UserContentProgressRepository::$cache = [];

        return true;
    }

    /**
     * @param integer $contentId
     * @param integer $userId
     * @return bool
     */
    public function resetContent($contentId, $userId)
    {
        $content = $this->contentService->getById($contentId);
        $user = $this->userProvider->getUserById($userId);

        $userContentProgress = $this->userContentRepository->findOneBy(
            [
                'user' => $user,
                'content' => $content,
            ]
        );
        $this->entityManager->remove($userContentProgress);
        $this->entityManager->flush();

        // also reset progress on children
        $childIds = [$contentId];

        $hierarchies = $this->contentHierarchyService->getByParentIds($childIds);

        foreach ($hierarchies as $hierarchy) {
            $child = $hierarchy->getChild();

            $userContentProgress = $this->userContentRepository->findOneBy(
                [
                    'user' => $user,
                    'content' => $child,
                ]
            );

            if ($userContentProgress) {
                $this->entityManager->remove($userContentProgress);
                $this->entityManager->flush();

                event(new UserContentProgressSaved($userId, $child->getId(), false));
            }
        }

        //delete user content progress cache
        UserContentProgressRepository::$cache = [];

        event(new UserContentProgressSaved($userId, $contentId));

        //delete user progress from cache
        $this->entityManager->getCache()
            ->evictEntityRegion(Content::class);

        return true;
    }

    /**
     * @param integer $contentId
     * @param integer $progress
     * @param integer $userId
     * @param bool $overwriteComplete
     * @return bool
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

        $content = $this->contentService->getById($contentId);
        $user = $this->userProvider->getUserById($userId);

        $userContentProgress = $this->userContentRepository->findOneBy(
            [
                'content' => $content,
                'user' => $user,
            ]
        );

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
        $userContentProgress->setState(($progress == 100) ? self::STATE_COMPLETED : self::STATE_STARTED);
        $userContentProgress->setUpdatedOn(Carbon::parse(now()));

        $this->entityManager->persist($userContentProgress);
        $this->entityManager->flush();

        $this->entityManager->getCache()
            ->evictEntityRegion(Content::class);

        UserContentProgressRepository::$cache = [];

        event(new UserContentProgressSaved($userId, $contentId));

        return true;
    }

    /**
     * @param int $userId
     * @param int $contentId
     * @return bool
     */
    public function bubbleProgress($userId, $contentId)
    {
        $content =
            $this->entityManager->getRepository(Content::class)
                ->find($contentId);

        $allowedTypesForStarted = config('railcontent.allowed_types_for_bubble_progress')['started'];
        $allowedTypesForCompleted = config('railcontent.allowed_types_for_bubble_progress')['completed'];
        $allowedTypes = array_unique(array_merge($allowedTypesForStarted, $allowedTypesForCompleted));

        $parents = $this->contentService->getByChildIdWhereParentTypeIn(
            $contentId,
            $allowedTypes
        );

        foreach ($parents as $parent) {
            // start parent if necessary
            if ($content->isStarted() &&
                !$parent->isStarted() &&
                in_array($parent->getType(), $allowedTypesForStarted)) {
                $this->startContent($parent->getId(), $userId);
            }

            // get siblings
            $siblings = $parent->getChild() ?? $this->attachProgressToContents(
                    $userId,
                    $this->contentService->getByParentId($parent->getId())
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
                    $this->completeContent($parent->id(), $userId);
                }
            }

            // calculate and save parent progress percent from children
            $alreadyStarted = $parent->isStarted();
            $typeAllows = in_array($parent->getType(), $allowedTypesForStarted);

            if ($alreadyStarted || $typeAllows) {
                $this->saveContentProgress(
                    $parent->getId(),
                    $this->getProgressPercentage($userId, $this->contentService->getByParentId($parent->getId())),
                    $userId,
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
                ->getResult();

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
        $orderByColumn = 'updated_on',
        $orderByDirection = 'desc',
        $limit = 25
    ) {
        $user = $this->userProvider->getUserById($id);

        $alias = 'uc';
        $aliasContent = 'c';

        if (strpos($orderByColumn, '_') !== false || strpos($orderByColumn, '-') !== false) {
            $orderByColumn = camel_case($orderByColumn);
        }
        $orderByColumn = $alias . '.' . $orderByColumn;

        $qb = $this->userContentRepository->createQueryBuilder($alias);

        $qb->join($alias . '.content', $aliasContent)
            ->where($aliasContent . '.brand = :brand')
            ->andWhere($aliasContent . '.type IN (:contentType)')
            ->andWhere($alias . '.state = :state')
            ->andWhere($alias . '.user = :user')
            ->setParameters(
                [
                    'brand' => ConfigService::$brand,
                    'contentType' => $types,
                    'state' => $state,
                    'user' => $user,
                ]
            )
            ->setMaxResults($limit)
            ->orderBy($orderByColumn, $orderByDirection);

        return $qb->getQuery()
            ->getResult();
    }

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
            ->getResult();
    }

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
                ->getSingleResult();

        return $results['count'];
    }
}