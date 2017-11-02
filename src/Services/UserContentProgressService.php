<?php

namespace Railroad\Railcontent\Services;

use Railroad\Railcontent\Repositories\UserContentProgressRepository;

class UserContentProgressService
{
    /**
     * @var UserContentProgressRepository
     */
    public $userContentRepository;

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
     * @param integer $contentId
     * @param integer $userId
     * @return integer
     */
    public function startContent($contentId, $userId)
    {
        $userContentId =
            $this->userContentRepository->updateOrCreate(
                [
                    'content_id' => $contentId,
                    'user_id' => $userId,
                ],
                [
                    'state' => UserContentProgressService::STATE_STARTED
                ]
            );

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
                    'complete' => $progress,
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
                'complete' => $progress
            ]
        );

        return true;
    }
}