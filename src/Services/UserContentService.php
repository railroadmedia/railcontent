<?php
/**
 * Created by PhpStorm.
 * User: roxana
 * Date: 9/15/2017
 * Time: 7:43 AM
 */

namespace Railroad\Railcontent\Services;


use Railroad\Railcontent\Repositories\UserContentRepository;

class UserContentService
{
    public $userContentRepository;

    // all possible user content state
    const STATE_STARTED = 'started';
    const STATE_COMPLETED = 'completed';
    const STATE_ADDED_TO_LIST = 'added';

    /**
     * UserContentService constructor.
     * @param $userContentRepository
     */
    public function __construct(UserContentRepository $userContentRepository)
    {
        $this->userContentRepository = $userContentRepository;
        $this->userId = $this->userContentRepository->getAuthenticatedUserId(request());
    }

    public function startContent($contentId)
    {
        $userContentId = $this->userContentRepository->saveUserContent($contentId, $this->userId, UserContentService::STATE_STARTED);

        return $userContentId > 0;
    }

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

    public function saveContentProgress($contentId, $progress)
    {

        $data = [
            'progress' => $progress
        ];

        $userContentId = $this->userContentRepository->updateUserContent($contentId, $this->userId, $data);

        return $userContentId > 0;
    }
}