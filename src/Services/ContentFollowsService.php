<?php

namespace Railroad\Railcontent\Services;

use Carbon\Carbon;
use Illuminate\Support\Arr;
use Railroad\Railcontent\Decorators\Decorator;
use Railroad\Railcontent\Entities\ContentFilterResultsEntity;
use Railroad\Railcontent\Events\ContentFollow;
use Railroad\Railcontent\Events\ContentUnfollow;
use Railroad\Railcontent\Helpers\CacheHelper;
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
            ->updateOrInsert([
                'content_id' => $contentId,
                'user_id' => $userId,
            ], [
                'created_on' => Carbon::now()
                    ->toDateTimeString(),
            ]);

        //delete the cached results
        CacheHelper::deleteCache('content_' . $contentId);

        event(new ContentFollow($contentId, $userId));

        return $this->contentFollowsRepository->query()
            ->where([
                'content_id' => $contentId,
                'user_id' => $userId,
            ])
            ->first();
    }

    /**
     * @param $contentId
     * @param $userId
     * @return int
     */
    public function unfollow($contentId, $userId)
    {
        //delete the cached results
        CacheHelper::deleteCache('content_' . $contentId);

        $results = $this->contentFollowsRepository->query()
            ->where([
                'content_id' => $contentId,
                'user_id' => $userId,
            ])
            ->delete();

        event(new ContentUnfollow($contentId, $userId));

        return $results;
    }

    /**
     * @param $userId
     * @param $brand
     * @param null $contentType
     * @return mixed|\Railroad\Railcontent\Support\Collection|null
     */
    public function getUserFollowedContent($userId, $brand, $contentType = null, $page, $limit)
    {
        $followedContent =
            $this->contentFollowsRepository->getFollowedContent($userId, $brand, $contentType, $page, $limit);

        $contentIds = Arr::pluck($followedContent, 'content_id');

        $contents = $this->contentService->getByIds($contentIds);

        $results = new ContentFilterResultsEntity([
            'results' => $contents,
            'total_results' => $this->contentFollowsRepository->countFollowedContent($userId, $brand, $contentType),
        ]);

        return Decorator::decorate($results, 'content');
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
    public function getLessonsForFollowedCoaches(
        $brand,
        $contentTypes = [],
        $statuses = [],
        $page = 1,
        $limit = 10,
        $sort = '-published_on'
    ) {
        $followedContent = $this->contentFollowsRepository->getFollowedContent(
            auth()->id(),
            $brand,
            null,
            1,
            'null'
        );

        $contentData = new ContentFilterResultsEntity(['results' => [], 'total_results' => 0]);

        if (!empty($followedContent)) {
            $includedFields = [];

            foreach ($followedContent as $content) {
                $includedFields[] = 'instructor,' . $content['id'];
                $instructor =
                    $this->contentService->getBySlugAndType($content['slug'], 'coach')
                        ->first();
                if ($instructor) {
                    $includedFields[] = 'instructor,' . $instructor['id'];
                }
            }

            ContentRepository::$pullFutureContent = false;
            ContentRepository::$availableContentStatues =
                (!empty($statuses)) ? $statuses : [ContentService::STATUS_PUBLISHED];

            $contentData = $this->contentService->getFiltered(
                $page,
                $limit,
                $sort,
                $contentTypes,
                [],
                [],
                [],
                $includedFields
            );
        }

        return Decorator::decorate($contentData, 'content');
    }

    /**
     * @param $contentId
     * @param array $statuses
     * @param int $page
     * @param int $limit
     * @param string $sort
     * @return mixed|\Railroad\Railcontent\Support\Collection|null
     */
    public function getLessonsForFollowedContent(
        $contentId,
        $statuses = [],
        $page = 1,
        $limit = 10,
        $sort = '-published_on'
    ) {

        $content = $this->contentService->getById($contentId);

        $includedFields = [];
        $includedFields[] = 'instructor,' . $contentId;
        $instructor =
            $this->contentService->getBySlugAndType($content['slug'], 'instructor')
                ->first();
        if ($instructor) {
            $includedFields[] = 'instructor,' . $instructor['id'];
        }

        ContentRepository::$pullFutureContent = false;
        ContentRepository::$availableContentStatues =
            (!empty($statuses)) ? $statuses : [ContentService::STATUS_PUBLISHED];

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

        return Decorator::decorate($contentData, 'content');
    }

    /**
     * @param $contentId
     * @return bool
     */
    public function isSubscribedCurrentUserToContent($contentId)
    {
        $followedContentIds = $this->getCurrentUserFollowedContentIds();

        return in_array($contentId, $followedContentIds);
    }

    /**
     * @return array|mixed
     */
    public function getCurrentUserFollowedContentIds()
    {
        return $this->contentFollowsRepository->getFollowedContentIds();
    }
}
