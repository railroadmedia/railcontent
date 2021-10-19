<?php

namespace Railroad\Railcontent\Services;

use Carbon\Carbon;
use Railroad\Railcontent\Events\ContentFollow;
use Railroad\Railcontent\Events\ContentUnfollow;
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

        event(new ContentFollow($contentId, $userId));

        return $this->contentFollowsRepository->getById($id);
    }

    /**
     * @param $contentId
     * @param $userId
     * @return int
     */
    public function unfollow($contentId, $userId)
    {
        event(new ContentUnfollow($contentId, $userId));

        return $this->contentFollowsRepository->query()
            ->where([
                    'content_id' => $contentId,
                    'user_id' => $userId,
                ])
            ->delete();
    }

    /**
     * @param $userId
     * @param $brand
     * @param null $contentType
     * @return array
     */
    public function getUserFollowedContent($userId, $brand, $contentType = null)
    {
        $results = $this->contentFollowsRepository->getFollowedContent($userId, $brand, $contentType);

        return $results;
    }
}
