<?php

namespace Railroad\Railcontent\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Railroad\Railcontent\Events\UserContentProgressSaved;
use Railroad\Railcontent\Events\UserContentProgressStarted;
use Railroad\Railcontent\Events\UserContentsProgressReset;
use Railroad\Railcontent\Helpers\CacheHelper;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Repositories\UserContentProgressRepository;
use Railroad\Railcontent\Support\Collection;

class UserContentProgressService
{
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
        UserContentProgressRepository $userContentRepository,
        ContentHierarchyService $contentHierarchyService,
        ContentRepository $contentRepository,
        ContentService $contentService
    ) {
        $this->userContentRepository = $userContentRepository;
        $this->contentHierarchyService = $contentHierarchyService;
        $this->contentRepository = $contentRepository;
        $this->contentService = $contentService;
    }

    /**
     * @param $contentType
     * @param $userIdcountContentProgress
     * @param $state
     * @return array
     */
    public function getMostRecentByContentTypeUserState($contentType, $userId, $state)
    {
        return $this->userContentRepository->getMostRecentByContentTypeUserState(
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
        $results = $this->userContentRepository->countTotalStatesForContentIds($state, $contentIds);

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

        $isCompleted = $this->userContentRepository->isContentAlreadyCompleteForUser($contentId, $userId);
        $existingRow = $this->userContentRepository->query()
            ->where(
                [
                    'content_id' => $contentId,
                    'user_id' => $userId,
                ]
            )
            ->get()
            ->first();

        if (!$isCompleted || $forceEvenIfComplete) {
            $dataArray =                 [
                'state' => self::STATE_STARTED,
                'progress_percent' => $progressPercent,
                'updated_on' => Carbon::now()
                    ->toDateTimeString(),
            ];

            if (empty($existingRow) || empty($existingRow['started_on'])) {
                $dataArray['started_on'] = Carbon::now()->toDateTimeString();
            }

            $this->userContentRepository->updateOrCreate(
                [
                    'content_id' => $contentId,
                    'user_id' => $userId,
                ],
                $dataArray
            );
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

        event(new UserContentProgressSaved($userId, $contentId, $progressPercent, self::STATE_STARTED));

        event(new UserContentProgressStarted($userId, $contentId, $progressPercent));

        return true;
    }

    /**
     * @param integer $contentId
     * @param integer $userId
     * @return bool
     */
    public function completeContent($contentId, $userId)
    {
        $existingRow = $this->userContentRepository->query()
            ->where(
                [
                    'content_id' => $contentId,
                    'user_id' => $userId,
                ]
            )
            ->get()
            ->first();

        $updateArray = [
            'state' => self::STATE_COMPLETED,
            'progress_percent' => 100,
            'updated_on' => Carbon::now()
                ->toDateTimeString(),
            'completed_on' => Carbon::now()
                ->toDateTimeString(),
        ];

        if (empty($existingRow) || empty($existingRow['started_on'])) {
            $updateArray['started_on'] = Carbon::now()
                ->toDateTimeString();
        }

        $this->userContentRepository->updateOrCreate(
            [
                'content_id' => $contentId,
                'user_id' => $userId,
            ],
            $updateArray
        );

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

        // also mark children as complete if they have not already been marked as complete
        $childIds = [$contentId];
        $idsToDeleteFromCache = [];

        do {
            $children = $this->contentHierarchyService->getByParentIdsWithUserProgress($childIds, $userId);

            foreach ($children as $child) {
                if ($child["state"] != self::STATE_COMPLETED) {
                    $idsToDeleteFromCache[] = $child['child_id'];

                    $updateArray = [
                        'state' => self::STATE_COMPLETED,
                        'progress_percent' => 100,
                        'updated_on' => Carbon::now()
                            ->toDateTimeString(),
                        'completed_on' => Carbon::now()
                            ->toDateTimeString(),
                    ];

                    if (empty($child['started_on'])) {
                        $updateArray['started_on'] = Carbon::now()->toDateTimeString();
                    }

                    $this->userContentRepository->updateOrCreate(
                        [
                            'content_id' => $child['child_id'],
                            'user_id' => $userId,
                        ],
                        $updateArray
                    );

                    event(new UserContentProgressSaved($userId, $child['child_id'], 100, self::STATE_COMPLETED, false));
                }
            }

            $childIds = array_column($children, 'child_id');
        } while (count($children) > 0);

        event(new UserContentProgressSaved($userId, $contentId, 100, self::STATE_COMPLETED));

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

        $idsToDelete = [(integer)$contentId];
        $childIds = [$contentId];

        do {
            $children = $this->contentHierarchyService->getByParentIds($childIds);

            foreach ($children as $child) {
                $idsToDelete[] = $child['child_id'];
            }

            $childIds = array_column($children, 'child_id');
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

        event(new UserContentProgressSaved($userId, $contentId, 0, self::STATE_STARTED));

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
        $currentProgress =
            $this->userContentRepository->query()
                ->where(
                    [
                        'content_id' => $contentId,
                        'user_id' => $userId,
                    ]
                )
                ->orderBy('updated_on', 'desc')
                ->first();

        if (!$overwriteComplete &&
            ($currentProgress['state'] == 'completed' || $currentProgress['progress_percent'] == 100)) {
            return true;
        }

        if ($progress == 100) {
            return $this->completeContent($contentId, $userId);
        }

        $updateArray = [
            'state' => self::STATE_STARTED,
            'progress_percent' => $progress,
            'updated_on' => Carbon::now()
                ->toDateTimeString(),
            'completed_on' => null,
        ];

        if (!empty($currentProgress) && empty($currentProgress['started_on'])) {
            $updateArray['started_on'] = Carbon::now()->toDateTimeString();
        }

        $this->userContentRepository->updateOrCreate(
            [
                'content_id' => $contentId,
                'user_id' => $userId,
            ],
            $updateArray
        );

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

        event(new UserContentProgressSaved($userId, $contentId, $progress, self::STATE_STARTED));

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

        if (!$isArray) {
            $contentOrContents = [(array)$contentOrContents];
        }

        if ($contentOrContents instanceof Collection) {
            $contentIds =
                $contentOrContents->pluck('id')
                    ->toArray();

        } else {
            $contentIds = array_column($contentOrContents, 'id');
        }

        if (!empty($contentIds)) {
            $contentProgressions = $this->userContentRepository->getByUserIdAndWhereContentIdIn($userId, $contentIds);

            $contentProgressionsByContentId =
                array_combine(array_column($contentProgressions, 'content_id'), $contentProgressions);

            foreach ($contentOrContents as $index => $content) {
                if (!empty($contentProgressionsByContentId[$content['id']])) {
                    $contentOrContents[$index]['user_progress'][$userId] =
                        $contentProgressionsByContentId[$content['id']];

                    $contentOrContents[$index][self::STATE_COMPLETED] =
                        $contentProgressionsByContentId[$content['id']]['state'] == self::STATE_COMPLETED;

                    $contentOrContents[$index][self::STATE_STARTED] =
                        $contentProgressionsByContentId[$content['id']]['state'] == self::STATE_STARTED;
                } else {
                    $contentOrContents[$index]['user_progress'][$userId] = [];

                    $contentOrContents[$index][self::STATE_COMPLETED] = false;
                    $contentOrContents[$index][self::STATE_STARTED] = false;
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
        $content = $this->attachProgressToContents($userId, ['id' => $contentId]);

        $allowedTypesForStarted = array_merge(
            config('railcontent.allowed_types_for_bubble_progress')['started'],
            config('railcontent.showTypes', [])
        );
        $allowedTypesForCompleted = array_merge(
            config('railcontent.allowed_types_for_bubble_progress')['completed'],
            config('railcontent.showTypes', [])
        );
        $allowedTypes = array_unique(array_merge($allowedTypesForStarted, $allowedTypesForCompleted));

        $parents = $this->attachProgressToContents(
            $userId,
            $this->contentRepository->query()
                ->selectPrimaryColumns()
                ->restrictByUserAccess()
                ->leftJoin(
                    ConfigService::$tableContentHierarchy,
                    ConfigService::$tableContentHierarchy . '.parent_id',
                    '=',
                    ConfigService::$tableContent . '.id'
                )
                ->where(ConfigService::$tableContentHierarchy . '.child_id', $content['id'])
                ->whereIn(ConfigService::$tableContent . '.type', $allowedTypes)
                ->selectInheritenceColumns()
                ->getToArray()
        );

        foreach ($parents as $parent) {

            // start parent if necessary
            if (!$parent[self::STATE_STARTED] &&
                in_array($parent['type'], $allowedTypesForStarted)) {
                $this->startContent($parent['id'], $userId, true);
                $parent[self::STATE_STARTED] = true;
            }

            // get siblings
            $oldBypassPermissions = ContentRepository::$bypassPermissions;
            $oldPullFutureContent = ContentRepository::$pullFutureContent;
            $oldContentStatuses = ContentRepository::$availableContentStatues;

            ContentRepository::$bypassPermissions = true;
            ContentRepository::$pullFutureContent = true;
            ContentRepository::$availableContentStatues =
                [ContentService::STATUS_PUBLISHED, ContentService::STATUS_SCHEDULED];

            $contentFakeArray = [];

            foreach (
                $this->contentHierarchyService->getByParentIdsWhereContentStatusIn([$parent['id']]) as $hierarchyRow
            ) {
                $contentFakeArray[] = ['id' => $hierarchyRow['child_id']];
            }

            $siblings = $parent['lessons'] ?? $this->attachProgressToContents(
                    $userId,
                    $contentFakeArray
                );

            ContentRepository::$bypassPermissions = $oldBypassPermissions;
            ContentRepository::$pullFutureContent = $oldPullFutureContent;
            ContentRepository::$availableContentStatues = $oldContentStatuses;

            if (is_array($siblings)) {
                $siblings = new Collection($siblings);
            }

            // complete parent content if necessary
            if ($content[self::STATE_COMPLETED]) {
                $complete = true;
                foreach ($siblings as $sibling) {
                    if (!$sibling[self::STATE_COMPLETED]) {
                        $complete = false;
                    }
                }

                if ($complete &&
                    !$parent[self::STATE_COMPLETED] &&
                    in_array($parent['type'], $allowedTypesForCompleted)) {
                    $this->completeContent($parent['id'], $userId);
                }
            }

            // calculate and save parent progress percent from children

            $alreadyStarted = $parent[self::STATE_STARTED];
            $typeAllows = in_array($parent['type'], $allowedTypesForStarted);

            if ($alreadyStarted || $typeAllows) {
                $this->saveContentProgress(
                    $parent['id'],
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

        if ($siblings instanceof Collection) {
            $progressOfSiblings =
                ($siblings->has('user_progress')) ?
                    $siblings->pluck('user_progress')
                        ->toArray() : [];
        } else {
            $progressOfSiblings = array_column($siblings, 'user_progress');
        }

        foreach ($siblings as $sibling) {
            if (!empty($sibling['user_progress'])) {
                $progressOfSiblings[] = $sibling['user_progress'];
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
        return $this->userContentRepository->getForUser($id);
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
        return $this->userContentRepository->getForUserStateContentTypes(
            $id,
            $types,
            $state,
            $orderByColumn,
            $orderByDirection,
            $limit
        );
    }

    /**
     * @param $id
     * @param $type
     * @param null $state
     * @return mixed
     */
    public function getLessonsForUserByType($id, $type, $state = null)
    {
        return $this->userContentRepository->getLessonsForUserByType($id, $type, $state);
    }

    /**
     * @param $id
     * @param $type
     * @param $state
     * @return mixed
     */
    public function countLessonsForUserByTypeAndProgressState($id, $type, $state)
    {
        return $this->userContentRepository->getLessonsForUserByType($id, $type, $state, true);
    }

    /**
     * @param $userId
     * @param $contentId
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Query\Builder|mixed|object|null
     */
    public function getUserProgressOnContent($userId, $contentId)
    {
        return $this->userContentRepository->getUserProgressOnContent($userId, $contentId);
    }

    /**
     * @param $userId
     * @param null $date
     * @param null $state
     * @return mixed
     */
    public function countUserProgress($userId, $date = null, $state = null)
    {
        return $this->userContentRepository->countUserProgress($userId, $date, $state);
    }

    /**
     * @param $contentId
     * @param null $date
     * @param null $state
     * @return int|mixed|string
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function countContentProgress($contentId, $date = null, $state = null)
    {
        return $this->userContentRepository->countContentProgress($contentId, $date, $state);
    }
}
