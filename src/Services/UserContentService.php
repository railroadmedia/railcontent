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

    /**
     * UserContentService constructor.
     * @param $userContentRepository
     */
    public function __construct(UserContentRepository $userContentRepository)
    {
        $this->userContentRepository = $userContentRepository;
    }

    public function startContent($contentId)
    {
        //get authenticated user id
        $userId = ($this->userContentRepository->getAuthenticatedUserId(request()));

        $userContentId = $this->userContentRepository->startContent($contentId, $userId, UserContentService::STATE_STARTED);

        return $userContentId > 0;
    }

    public function completeContent($contentId)
    {
        //get authenticated user id
        $userId = ($this->userContentRepository->getAuthenticatedUserId(request()));
        $progress = 100;
        $data = [
            'state' => UserContentService::STATE_COMPLETED,
            'progress' => $progress
        ];

        $userContentId = $this->userContentRepository->updateUserContent($contentId, $userId, $data);

        return $userContentId > 0;
    }

    public function saveContentProgress($contentId, $progress)
    {
        //get authenticated user id
        $userId = $this->userContentRepository->getAuthenticatedUserId(request());

        $data = [
            'progress' => $progress
        ];

        $userContentId = $this->userContentRepository->updateUserContent($contentId, $userId, $data);

        return $userContentId > 0;
    }
}