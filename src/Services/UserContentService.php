<?php

namespace Railroad\Railcontent\Services;

use Railroad\Railcontent\Repositories\UserContentProgressRepository;

class UserContentService
{
    /**
     * @var UserContentProgressRepository
     */
    public $userContentRepository;

    /**
     * @var int|null
     */
    public $userId;

    // all possible user content state
    const STATE_STARTED = 'started';
    const STATE_COMPLETED = 'completed';
    const STATE_ADDED_TO_LIST = 'added';

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
     * @return bool
     */
    public function startContent($contentId, $userId)
    {
        $userContentId =
            $this->userContentRepository->saveUserContent(
                $contentId,
                $userId,
                UserContentService::STATE_STARTED
            );

        return $userContentId;
    }

    /**
     * @param integer $contentId
     * @return bool
     */
    public function completeContent($contentId, $userId)
    {
        $progress = 100;
        $data = [
            'state' => UserContentService::STATE_COMPLETED,
            'progress' => $progress
        ];

        $userContentId = $this->userContentRepository->updateUserContent($contentId, $userId, $data);

        return $userContentId > 0;
    }

    /**
     * @param integer$contentId
     * @param string $progress
     * @return bool
     */
    public function saveContentProgress($contentId, $progress, $userId)
    {
        $data = [
            'progress' => $progress
        ];

        $userContentId = $this->userContentRepository->updateUserContent($contentId, $userId, $data);

        return $userContentId > 0;
    }
}