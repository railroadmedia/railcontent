<?php

namespace Railroad\Railcontent\Services;

use Carbon\Carbon;
use Doctrine\ORM\EntityManager;
use Illuminate\Support\Facades\Cache;
use Railroad\Railcontent\Entities\Content;
use Railroad\Railcontent\Entities\UserContentProgress;
use Railroad\Railcontent\Events\UserContentProgressSaved;
use Railroad\Railcontent\Events\UserContentsProgressReset;
use Railroad\Railcontent\Helpers\CacheHelper;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Repositories\UserContentProgressRepository;
use Railroad\Railcontent\Support\Collection;

class UserContentProgressService
{
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
     * @var ContentRepository
     */
    private $contentRepository;

    /**
     * @var ContentService
     */
    private $contentService;

    const STATE_STARTED = 'started';
    const STATE_COMPLETED = 'completed';

    /**
     * UserContentService constructor.
     *
     * @param UserContentProgressRepository $userContentRepository
     * @param ContentHierarchyService $contentHierarchyService
     * @param ContentRepository $contentRepository
     * @param ContentService $contentService
     */
    public function __construct(
        //  UserContentProgressRepository $userContentRepository,
        ContentHierarchyService $contentHierarchyService,
        EntityManager $entityManager,
        //   ContentRepository $contentRepository,
        ContentService $contentService
    ) {
        $this->entityManager = $entityManager;

        $this->contentHierarchyService = $contentHierarchyService;
        $this->contentService = $contentService;

        $this->userContentRepository = $this->entityManager->getRepository(UserContentProgress::class);

        //   $this->contentRepository = $contentRepository;

    }

    /**
     * @param $contentType
     * @param $userId
     * @param $state
     * @return array
     */
    public function getMostRecentByContentTypeUserState($contentType, $userId, $state)
    {
        return $this->userContentRepository->query()
            ->getMostRecentByContentTypeUserState(
                $contentType,
                $userId,
                $state
            );
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
        $results =
            $this->userContentRepository->query()
                ->countTotalStatesForContentIds($state, $contentIds);

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
                'userId' => $userId,
                'content' => $content,
                'state' => 'completed',

            ]
        );

        if (!$isCompleted || $forceEvenIfComplete) {
            $userContentProgress = $this->userContentRepository->findOneBy(
                [
                    'userId' => $userId,
                    'content' => $content,
                ]
            );
            if (!$userContentProgress) {
                $userContentProgress = new UserContentProgress();
                $userContentProgress->setUserId($userId);
                $userContentProgress->setContent($content);
            }

            $userContentProgress->setProgressPercent($progressPercent);
            $userContentProgress->setState(self::STATE_STARTED);
            $userContentProgress->setUpdatedOn(Carbon::parse(now()));

            $this->entityManager->persist($userContentProgress);
            $this->entityManager->flush();

        }
        //delete user progress from cache
        CacheHelper::deleteUserFields(
            [
                Cache::store(ConfigService::$cacheDriver)
                    ->getPrefix() . 'userId_' . $userId,
            ],
            'user_progress'
        );

        CacheHelper::deleteUserFields(
            [
                Cache::store(ConfigService::$cacheDriver)
                    ->getPrefix() . 'userId_' . $userId,
            ],
            'content'
        );

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

        $userContentProgress = $this->userContentRepository->findOneBy(
            [
                'userId' => $userId,
                'content' => $content,
            ]
        );
        if (!$userContentProgress) {
            $userContentProgress = new UserContentProgress();
            $userContentProgress->setUserId($userId);
            $userContentProgress->setContent($content);
        }

        $userContentProgress->setProgressPercent(100);
        $userContentProgress->setState(self::STATE_COMPLETED);
        $userContentProgress->setUpdatedOn(Carbon::parse(now()));

        $this->entityManager->persist($userContentProgress);
        $this->entityManager->flush();

        event(new UserContentProgressSaved($userId, $contentId));

        CacheHelper::deleteUserFields(
            [
                Cache::store(ConfigService::$cacheDriver)
                    ->getPrefix() . 'userId_' . $userId,
            ],
            'user_progress'
        );

        CacheHelper::deleteUserFields(
            [
                Cache::store(ConfigService::$cacheDriver)
                    ->getPrefix() . 'userId_' . $userId,
            ],
            'content'
        );
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
        $this->userContentRepository->query()
            ->where(
                [
                    'content_id' => $contentId,
                    'user_id' => $userId,
                ]
            )
            ->delete();

        $idsToDelete = [];
        $childIds = [$contentId];

        do {
            $children = $this->contentHierarchyService->getByParentIds($childIds);

            foreach ($children as $child) {
                $idsToDelete[] = $child['child_id'];
            }

            $childIds =
                $children->pluck('child_id')
                    ->toArray();
        } while (count($children) > 0);

        $this->userContentRepository->query()
            ->where(
                [
                    'user_id' => $userId,
                ]
            )
            ->whereIn('content_id', $idsToDelete)
            ->delete();

        event(new UserContentsProgressReset($userId, $idsToDelete));

        //delete user content progress cache
        UserContentProgressRepository::$cache = [];

        event(new UserContentProgressSaved($userId, $contentId));

        //delete user progress from cache
        CacheHelper::deleteUserFields(
            [
                Cache::store(ConfigService::$cacheDriver)
                    ->getPrefix() . 'userId_' . $userId,
            ],
            'user_progress'
        );

        CacheHelper::deleteUserFields(
            [
                Cache::store(ConfigService::$cacheDriver)
                    ->getPrefix() . 'userId_' . $userId,
            ],
            'content'
        );

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

        $userContentProgress = $this->userContentRepository->findOneBy(
            [
                'content' => $content,
                'userId' => $userId,
            ]
        );

        if ($userContentProgress &&
            !$overwriteComplete &&
            ($userContentProgress->getState() == 'completed' || $userContentProgress->getProgressProcent() == 100)) {
            return true;
        }

        if (!$userContentProgress) {
            $userContentProgress = new UserContentProgress();
            $userContentProgress->setUserId($userId);
            $userContentProgress->setContent($content);
        }

        $userContentProgress->setProgressPercent($progress);
        $userContentProgress->setState(($progress == 100) ? self::STATE_COMPLETED : self::STATE_STARTED);
        $userContentProgress->setUpdatedOn(Carbon::parse(now()));

        $this->entityManager->persist($userContentProgress);
        $this->entityManager->flush();

        CacheHelper::deleteUserFields(
            [
                Cache::store(ConfigService::$cacheDriver)
                    ->getPrefix() . 'userId_' . $userId,
            ],
            'user_progress'
        );

        UserContentProgressRepository::$cache = [];

        //event(new UserContentProgressSaved($userId, $contentId));

        return true;
    }

    /**
     * @param integer $userId
     * @param array $contentOrContents
     *
     * @return array
     */
    public function attachProgressToContents($userId, $contentOrContents)
    {
        if (empty($userId) || empty($contentOrContents)) {
            return $contentOrContents;
        }

        $isArray = !isset($contentOrContents['id']);
        $contentIds = array_map(
            function ($entity) {
                return $entity->getId();
            },
            $contentOrContents
        );

        if (!empty($contentIds)) {

            $contentProgressions = $this->userContentRepository->getByUserIdAndWhereContentIdIn($userId, $contentIds);

            $contentProgressionsByContentId = array_combine(
                array_map(
                    function ($entity) {
                        return $entity->getId();
                    },
                    $contentProgressions
                ),
                $contentProgressions
            );

            foreach ($contentOrContents as $index => $content) {
                $id = $content->getId();

                if (!empty($contentProgressionsByContentId[$id])) {
                    $contentOrContents[$index]->addUserProgress($contentProgressionsByContentId[$id]);
                    $contentOrContents[$index]->setCompleted(
                        $contentProgressionsByContentId[$id]->getState() == self::STATE_COMPLETED
                    );

                    $contentOrContents[$index]->setCompleted(
                        $contentProgressionsByContentId[$id]->getState() == self::STATE_STARTED
                    );
                } else {
                    $contentOrContents[$index]->setCompleted(false);
                    $contentOrContents[$index]->setStarted(false);
                    $contentOrContents[$index]->addUserProgress([]);
                }

            }
        }

        if ($isArray) {
            return $contentOrContents;
        } else {
            return reset($contentOrContents);
        }
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

        $content = $this->attachProgressToContents($userId, [$content])[0];

        $allowedTypesForStarted = config('railcontent.allowed_types_for_bubble_progress')['started'];
        $allowedTypesForCompleted = config('railcontent.allowed_types_for_bubble_progress')['completed'];
        $allowedTypes = array_unique(array_merge($allowedTypesForStarted, $allowedTypesForCompleted));

        $parents = $this->attachProgressToContents(
            $userId,
            $this->contentService->getByChildIdWhereParentTypeIn(
                $contentId,
                $allowedTypes
            )
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
                    $this->getProgressPercentage($userId, $siblings),
                    $userId,
                    true
                );
            }
        }

        return true;
    }

    private function getProgressPercentage($userId, $siblings)
    {

        $progressOfSiblingsDeNested = [];
        $percentages = [];

        foreach ($siblings as $sibling) {
            if (!empty(
            $sibling->getChild()
                ->getUserProgress()
            )) {
                $progressOfSiblings[] =
                    $sibling->getChild()
                        ->getUserProgress();
            }
        }

        if (empty($progressOfSiblings)) {
            if ($siblings instanceof Collection) {
                $progressOfSiblings =
                    ($siblings->has('user_progress')) ?
                        $siblings->pluck('user_progress')
                            ->toArray() : [];
            } else {
                $progressOfSiblings = array_column($siblings, 'user_progress');
            }
        }

        foreach ($progressOfSiblings as $progressOfSingleSibling) {
            $progressOfSiblingsDeNested[] = reset($progressOfSingleSibling);
        }

        foreach ($progressOfSiblingsDeNested as $progressOfSingleDeNestedSibling) {
            if (!empty($progressOfSingleDeNestedSibling)) {
                $percentages[] = $progressOfSingleDeNestedSibling['progress_percent'];
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
        return $this->userContentRepository->query()
            ->getForUser($id);
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
        return $this->userContentRepository->query()
            ->getForUserStateContentTypes(
                $id,
                $types,
                $state,
                $orderByColumn,
                $orderByDirection,
                $limit
            );
    }

    public function getLessonsForUserByType($id, $type, $state = null)
    {
        return $this->userContentRepository->query()
            ->getLessonsForUserByType($id, $type, $state);
    }

    public function countLessonsForUserByTypeAndProgressState($id, $type, $state)
    {
        return $this->userContentRepository->query()
            ->getLessonsForUserByType($id, $type, $state, true);
    }
}