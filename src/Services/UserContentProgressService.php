<?php

namespace Railroad\Railcontent\Services;

use Carbon\Carbon;
use Railroad\Railcontent\Repositories\UserContentProgressRepository;

class UserContentProgressService
{
    /**
     * @var UserContentProgressRepository
     */
    protected $userContentRepository;

    const STATE_STARTED = 'started';
    const STATE_COMPLETED = 'completed';

    /**
     * UserContentService constructor.
     *
     * @param $userContentRepository
     */
    public function __construct(UserContentProgressRepository $userContentRepository)
    {
        $this->userContentRepository = $userContentRepository;
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
            $userContentId =
                $this->userContentRepository->updateOrCreate(
                    [
                        'content_id' => $contentId,
                        'user_id' => $userId,
                    ],
                    [
                        'state' => UserContentProgressService::STATE_STARTED,
                        'updated_on' => Carbon::now()->toDateTimeString(),
                    ]
                );
        }

        return true;
    }

    /**
     * @param integer $contentId
     * @param $userId
     * @return bool
     */
    public function completeContent($contentId, $userId)
    {
        $progress = 100;

        $userContentId =
            $this->userContentRepository->updateOrCreate(
                [
                    'content_id' => $contentId,
                    'user_id' => $userId,
                ],
                [
                    'state' => UserContentProgressService::STATE_COMPLETED,
                    'progress_percent' => $progress,
                    'updated_on' => Carbon::now()->toDateTimeString(),
                ]
            );

        // todo: complete parents if all children are complete

        return true;
    }

    /**
     * @param integer $contentId
     * @param string $progress
     * @param $userId
     * @return bool
     */
    public function saveContentProgress($contentId, $progress, $userId)
    {
        $userContentId = $this->userContentRepository->updateOrCreate(
            [
                'content_id' => $contentId,
                'user_id' => $userId,
            ],
            [
                'progress_percent' => $progress,
                'updated_on' => Carbon::now()->toDateTimeString()
            ]
        );

        return true;
    }

    /**
     * @param $userId
     * @param $contents
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

                    $contentOrContents[$index]['completed'] = $contentProgressionsByContentId[$content['id']]['state'] ==
                        self::STATE_COMPLETED;

                    $contentOrContents[$index]['started'] = $contentProgressionsByContentId[$content['id']]['state'] ==
                        self::STATE_STARTED;
                } else {
                    $contentOrContents[$index]['user_progress'][$userId] = [];

                    $contentOrContents[$index]['completed'] = false;
                    $contentOrContents[$index]['started'] = false;
                }
            }
        }

        if ($isArray) {
            return $contentOrContents;
        } else {
            return reset($contentOrContents);
        }
    }
}