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
     * @param array $contents
     * @return array
     */
    public function attachUserProgressToContents($userId, $contents)
    {
        $isArray = !isset($contents['id']);

        if (!$isArray) {
            $contents = [$contents];
        }

        $contentIds = array_column($contents, 'id');

        if (!empty($contentIds)) {
            $contentProgressions =
                $this->userContentRepository->getByUserIdAndWhereContentIdIn($userId, $contentIds);

            $contentProgressionsByContentId =
                array_combine(array_column($contentProgressions, 'content_id'), $contentProgressions);

            foreach ($contents as $index => $content) {
                if (!empty($contentProgressionsByContentId[$content['id']])) {
                    $contents[$index]['user_progress'][$userId] =
                        $contentProgressionsByContentId[$content['id']];
                } else {
                    $contents[$index]['user_progress'][$userId] = [];
                }
            }
        }

        if ($isArray) {
            return $contents;
        } else {
            return reset($contents);
        }
    }
}