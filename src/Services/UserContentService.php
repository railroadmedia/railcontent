<?php

namespace Railroad\Railcontent\Services;

use Railroad\Railcontent\Repositories\UserContentRepository;

class UserContentService
{
    /**
     * @var UserContentRepository
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
    public function __construct(UserContentRepository $userContentRepository)
    {
        $this->userContentRepository = $userContentRepository;
        $this->userId = $this->userContentRepository->getAuthenticatedUserId(request());
    }

    /**
     * @param integer $contentId
     * @return bool
     */
    public function startContent($contentId)
    {
        $userContentId =
            $this->userContentRepository->saveUserContent(
                $contentId,
                $this->userId,
                UserContentService::STATE_STARTED
            );

        return $userContentId > 0;
    }

    /**
     * @param integer $contentId
     * @return bool
     */
    public function completeContent($contentId)
    {
        $progress = 100;
        $data = [
            'state' => UserContentService::STATE_COMPLETED,
            'progress' => $progress
        ];

        $userContentId = $this->userContentRepository->updateUserContent($contentId, $this->userId, $data);

        return $userContentId > 0;
    }

    /**
     * @param integer$contentId
     * @param string $progress
     * @return bool
     */
    public function saveContentProgress($contentId, $progress)
    {
        $data = [
            'progress' => $progress
        ];

        $userContentId = $this->userContentRepository->updateUserContent($contentId, $this->userId, $data);

        return $userContentId > 0;
    }
}