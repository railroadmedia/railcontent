<?php

namespace Railroad\Railcontent\Services;

use Carbon\Carbon;
use Railroad\Railcontent\Events\UserContentProgressSaved;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Repositories\UserContentProgressRepository;

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
     * @param $userId
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
        $isCompleted = $this->userContentRepository->isContentAlreadyCompleteForUser($contentId, $userId);

        if (!$isCompleted || $forceEvenIfComplete) {
            $this->userContentRepository->updateOrCreate(
                [
                    'content_id' => $contentId,
                    'user_id' => $userId,
                ],
                [
                    'state' => self::STATE_STARTED,
                    'progress_percent' => 0,
                    'updated_on' => Carbon::now()->toDateTimeString(),
                ]
            );
        }

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
        $this->userContentRepository->updateOrCreate(
            [
                'content_id' => $contentId,
                'user_id' => $userId,
            ],
            [
                'state' => self::STATE_COMPLETED,
                'progress_percent' => 100,
                'updated_on' => Carbon::now()->toDateTimeString(),
            ]
        );

        event(new UserContentProgressSaved($userId, $contentId));

        return true;
    }

    /**
     * @param integer $contentId
     * @param integer $progress
     * @param integer $userId
     * @param null|string $state
     * @return bool
     */
    public function saveContentProgress($contentId, $progress, $userId)
    {
        if ($progress === 100) {
            return $this->completeContent($contentId, $userId);
        }

        $this->userContentRepository->updateOrCreate(
            [
                'content_id' => $contentId,
                'user_id' => $userId
            ],
            [
                'state' => self::STATE_STARTED,
                'progress_percent' => $progress,
                'updated_on' => Carbon::now()->toDateTimeString()
            ]
        );

        event(new UserContentProgressSaved($userId, $contentId));

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
        $isArray = !isset($contentOrContents['id']);

        if (!$isArray) {
            $contentOrContents = [$contentOrContents];
        }

        $contentIds = array_column($contentOrContents, 'id');

        if (!empty($contentIds)) {
            $contentProgressions =
                $this->userContentRepository->getByUserIdAndWhereContentIdIn($userId, $contentIds);

            $contentProgressionsByContentId =
                array_combine(array_column($contentProgressions, 'content_id'), $contentProgressions);

            foreach ($contentOrContents as $index => $content) {
                if (!empty($contentProgressionsByContentId[$content['id']])) {
                    $contentOrContents[$index]['user_progress'][$userId] =
                        $contentProgressionsByContentId[$content['id']];

                    $contentOrContents[$index][self::STATE_COMPLETED] = $contentProgressionsByContentId[$content['id']]['state'] ==
                        self::STATE_COMPLETED;

                    $contentOrContents[$index][self::STATE_STARTED] = $contentProgressionsByContentId[$content['id']]['state'] ==
                        self::STATE_STARTED;
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
        $content = $this->attachProgressToContents($userId, $this->contentRepository->getById($contentId));
        $parents = $this->attachProgressToContents(
            $userId,
            $this->contentService->getByChildIdWhereTypes(
                $content['id'],
                config(
                    'railcontent.allowed_types_for_bubble_progress'
                )
            )
        );

        foreach ($parents as $parent) {
            // One ------------------------------------------------------------

            if ($content[self::STATE_STARTED] && !$parent[self::STATE_STARTED]) {
                $this->startContent($parent['id'], $userId);
            }

            $siblings = $this->attachProgressToContents(
                $userId,
                $this->contentService->getByParentId($parent['id'])
            );

            // Two ------------------------------------------------------------

            if ($content[self::STATE_COMPLETED]) {
                $complete = true;
                foreach ($siblings as $sibling) {
                    if (!$sibling[self::STATE_COMPLETED]) {
                        $complete = false;
                    }
                }
                if ($complete && !$parent[self::STATE_COMPLETED]) {
                    $this->completeContent($parent['id'], $userId);
                }
            }

            // Three ----------------------------------------------------------

            $progressOfSiblings = array_column($siblings, 'user_progress');

            $progressOfSiblingsDeNested = [];

            foreach ($progressOfSiblings as $progressOfSingleSibling) {
                $progressOfSiblingsDeNested[] = reset($progressOfSingleSibling);
            }

            $percentages = [];

            foreach ($progressOfSiblingsDeNested as $progressOfSingleDeNestedSibling) {
                if (!empty($progressOfSingleDeNestedSibling)) {
                    $percentages[] = $progressOfSingleDeNestedSibling['progress_percent'];
                } else {
                    $percentages[] = 0;
                }
            }

            $arraySum = array_sum($percentages);
            $siblingCount = count($siblings);

            $progress = $arraySum / $siblingCount;

            $this->saveContentProgress(
                $parent['id'],
                $progress,
                $userId
            );
        }

        return true;
    }
}