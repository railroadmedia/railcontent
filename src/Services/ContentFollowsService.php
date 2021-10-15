<?php

namespace Railroad\Railcontent\Services;

use Carbon\Carbon;
use Railroad\Railcontent\Repositories\ContentFollowsRepository;

class ContentFollowsService
{
    /**
     * @var ContentFollowsRepository
     */
    private $contentFollowsRepository;

    /**
     * @param ContentFollowsRepository $contentFollowsRepository
     */
    public function __construct(
        ContentFollowsRepository $contentFollowsRepository
    ) {
        $this->contentFollowsRepository = $contentFollowsRepository;
    }

    /**
     * @param $contentId
     * @param $userId
     * @return array
     */
    public function follow($contentId, $userId)
    {
        $id = $this->contentFollowsRepository->create([
                'content_id' => $contentId,
                'user_id' => $userId,
                'created_on' => Carbon::now()
                    ->toDateTimeString(),
            ]);

        return $this->contentFollowsRepository->getById($id);
    }

    /**
     * @param $contentId
     * @param $userId
     * @return int
     */
    public function unfollow($contentId, $userId)
    {
        return $this->contentFollowsRepository->query()
            ->where([
                    'content_id' => $contentId,
                    'user_id' => $userId,
                ])
            ->delete();
    }

    /**
     * @param $userId
     * @param null $contentType
     */
    public function getUserFollowedContent($userId, $contentType = null)
    {
        $results = $this->contentFollowsRepository->getFollowedContent($userId, $contentType);

        return $results;
    }
}
