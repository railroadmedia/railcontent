<?php

namespace Railroad\Railcontent\Services;

use Carbon\Carbon;
use Railroad\Railcontent\Decorators\Decorator;
use Railroad\Railcontent\Entities\ContentFilterResultsEntity;
use Railroad\Railcontent\Events\ContentFollow;
use Railroad\Railcontent\Events\ContentUnfollow;
use Railroad\Railcontent\Repositories\ContentFollowsRepository;
use Railroad\Railcontent\Repositories\ContentRepository;

class ContentFollowsService
{
    /**
     * @var ContentFollowsRepository
     */
    private $contentFollowsRepository;

    /**
     * @var ContentService
     */
    private $contentService;

    /**
     * @param ContentFollowsRepository $contentFollowsRepository
     * @param ContentService $contentService
     */
    public function __construct(
        ContentFollowsRepository $contentFollowsRepository,
        ContentService $contentService
    ) {
        $this->contentFollowsRepository = $contentFollowsRepository;
        $this->contentService = $contentService;
    }

    /**
     * @param $contentId
     * @param $userId
     * @return array
     */
    public function follow($contentId, $userId)
    {
        $this->contentFollowsRepository->query()
            ->updateOrInsert(
                [
                    'content_id' => $contentId,
                    'user_id' => $userId,
                ],
                [
                    'created_on' => Carbon::now()
                        ->toDateTimeString(),
                ]
            );

        event(new ContentFollow($contentId, $userId));

        return $this->contentFollowsRepository->query()
            ->where(
                [
                    'content_id' => $contentId,
                    'user_id' => $userId,
                ]
            )
            ->first();
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
     * @return mixed|\Railroad\Railcontent\Support\Collection|null
     */
    public function getUserFollowedContent($userId, $brand, $contentType = null)
    {
        $followedContent = $this->contentFollowsRepository->getFollowedContent($userId, $brand, $contentType);

        $contentIds = array_pluck($followedContent, 'content_id');

        $contents = $this->contentService->getByIds($contentIds);

        return Decorator::decorate($contents, 'content');
    }

    /**
     * @param $brand
     * @param null $contentType
     * @param array $statuses
     * @param int $page
     * @param int $limit
     * @param string $sort
     * @return mixed|\Railroad\Railcontent\Support\Collection|null
     */
    public function getLessonsForFollowedCoaches($brand, $contentType = null, $statuses = [], $page = 1, $limit = 10, $sort='-published_on')
    {
        $followedContent = $this->getUserFollowedContent(
            auth()->id(),
            $brand,
            $contentType
        );

        $contentData = new ContentFilterResultsEntity(['results' => [], 'total_results' => 0]);

        if (!empty($followedContent)) {
            $includedFields = [];
            $contentIds = $followedContent->pluck('id');

            foreach ($contentIds as $contentId) {
                $includedFields[] = 'instructor,' . $contentId;
               if(array_key_exists($contentId, config('railcontent.coach_id_instructor_id_mapping'))){
                   $includedFields[] = 'instructor,' . config('railcontent.coach_id_instructor_id_mapping.'.$contentId);
               }
            }

            ContentRepository::$pullFutureContent = false;
            ContentRepository::$availableContentStatues = (!empty($statuses))? $statuses : [ContentService::STATUS_PUBLISHED];

            $contentData = $this->contentService->getFiltered(
                $page,
                $limit,
                $sort,
                [],
                [],
                [],
                [],
                $includedFields
            );
        }

        return Decorator::decorate($contentData, 'content');
    }
}
