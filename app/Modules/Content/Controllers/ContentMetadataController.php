<?php

namespace App\Modules\Content\Controllers;

use App\Modules\Brand\Enums\Brand;
use App\Modules\Content\Enums\ProgressState;
use App\Modules\Content\Models\Content;
use App\Modules\Content\Models\ContentLike;
use App\Modules\Content\Models\ContentUserProgress;
use App\Modules\Content\Requests\ContentMetadataRequest;
use App\Modules\Content\Requests\ContentProgressMetadataRequest;
use App\Modules\DataVersion\Enums\UserDataVersionKeyEnum;
use App\Modules\DataVersion\Services\DataVersionService;
use Exception;
use App\Modules\Tracker\Models\LastEngagedSeconds;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Modules\UserManagementSystem\Models\User;
use Railroad\MusoraApi\Contracts\ProductProviderInterface;

class ContentMetadataController extends Controller
{
    private DataVersionService $dataVersionService;

    public function __construct(
        private ProductProviderInterface $productProvider,
        DataVersionService $dataVersionService
    ) {
        $this->dataVersionService = $dataVersionService;
    }

    public function isLikedByUser(ContentMetadataRequest $request, ?User $user = null): JsonResponse
    {
        // if the user ID isn't provided, grab the user from the session
        $user = $user ?? user();

        $contentIds = $request->query('content_ids', []);
        $results = [];
        foreach ($contentIds as $contentId) {
            $results[$contentId] = ContentLike::isContentLikedByUser($contentId, $user->id);
        }
        return response()->json($results);
    }

    public function userProgress(ContentMetadataRequest $request, ?User $user = null): JsonResponse
    {
        // if the user ID isn't provided, grab the user from the session
        $user = $user ?? user();

        try {
            $contentIds = $request->query('content_ids', []);
            $results = [];
            foreach ($contentIds as $contentId) {
                $progressState = ContentUserProgress::getState($contentId, $user->id);
                $results[$contentId] = $progressState->toArray();
            }
            return response()->json($results);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }

    public function inProgressForUser(ContentProgressMetadataRequest $request, ?User $user = null): JsonResponse
    {
        return $this->contentWithProgressForUser(ProgressState::Started, $request, $user);
    }

    public function completedByUser(ContentProgressMetadataRequest $request, ?User $user = null): JsonResponse
    {
        return $this->contentWithProgressForUser(ProgressState::Completed, $request, $user);
    }

    /**
     * Retrieve the data for content with a progress state for the user
     *
     * @param ProgressState $progressState
     * @param ContentProgressMetadataRequest $request
     * @param User|null $user
     * @return JsonResponse
     */
    private function contentWithProgressForUser(
        ProgressState $progressState,
        ContentProgressMetadataRequest $request,
        ?User $user = null
    ): JsonResponse {
        // if the user ID isn't provided, grab the user from the session
        $user = $user ?? user();

        $type = $request['content_type'] ?? null;
        $brandValue = $request['brand'] ?? null;
        $brand = null;
        if ($brandValue) {
            $brand = Brand::from($brandValue);
        }
        $limit = $request['limit'] ?? null;
        $page = $request['page'] ?? null;

        $results =
            $user->progress()
                ->when($progressState === ProgressState::Started, fn($query) => $query->incomplete())
                ->when($progressState === ProgressState::Completed, fn($query) => $query->complete())
                ->when(!is_null($type), fn($query) => $query->ofContentType($type))
                ->when(!is_null($brand), fn($query) => $query->ofContentBrand($brand))
                ->when(
                    !is_null($page),
                    // when we're using pagination, we need to apply the limit to the page
                    fn($query) => $query->forPage($page, $limit),
                    // otherwise, apply the limit to the whole query (if it's there)
                    fn($query) => $query->when(!is_null($limit), fn($query) => $query->limit($limit))
                )
                ->pluck('content_id');

        return response()->json([$progressState->value => $results]);
    }

    public function getContentPageUserData(int $contentId, ?User $user = null): array
    {
        //$userId = user()->id;
        $isLiked = ContentLike::isContentLikedByUser($contentId, $user->id);
        $likedCount = ContentLike::getContentLikedCount($contentId);
        $currentSecond = LastEngagedSeconds::getResumeTimeSeconds($contentId, $user->id);
        return [
            'isLiked' => $isLiked,
            'likeCount' => $likedCount,
            'isAdded' => false,
            'currentSecond' => $currentSecond
        ];
    }

    /**
     * @param $vimeoId
     * @return array
     */
    public function getVimeoData($vimeoId)
    {
        $content = $this->productProvider->getVimeoEndpoints($vimeoId);
        $response = [
            'vimeo_video_id' => $content['vimeo_video_id'] ?? null,
            'video_playback_endpoints' => $content['video_playback_endpoints'] ?? [],
            'length_in_seconds' => $content['length_in_seconds'] ?? 0,
        ];
        return $response;
    }

    private function buildUserContentData(int $userId): array
    {
        $allLikedContent = ContentLike::getAllContentLikedByUser($userId);
        //$allResumeTimes = LastEngagedSeconds::getAllContentResumeTimeSeconds($userId);
        //$allProgressData = ContentUserProgress::getAllProgressDataByUser($userId);

        $data = [];
//        foreach ($allProgressData as $progressData) {
//            $contentData = $data[$progressData->content_id] ?? [];
//            if ($progressData['progress_percent'] > 0) {
//                $contentData['p'] = $progressData['progress_percent'];
//                $data[$progressData->content_id] = $contentData;
//            }
//        }
        foreach ($allLikedContent as $likedContent) {
            $contentData = $data[$likedContent->content_id] ?? [];
            $contentData['l'] = 1;
            $data[$likedContent->content_id] = $contentData;
        }
//        foreach ($allResumeTimes as $lastEngagedSeconds) {
//            $contentData = $data[$lastEngagedSeconds->content_id] ?? [];
//            $contentData['s'] = $lastEngagedSeconds->resume_time_seconds;
//            $data[$lastEngagedSeconds->content_id] = $contentData;
//        }
        return $data;
    }

    public function likeContent(int $contentId)
    {
        $like = ContentLike::firstOrCreate(['contentId' => $contentId, 'userId' => user()->id]);
        $content = Content::find($contentId);
        if ($content) {
            $content->like_count++;
            $content->save();
        }
        if ($like->wasRecentlyCreated) {
            $this->dataVersionService->incrementUserContextVersion(UserDataVersionKeyEnum::Content, user()->id);
        }
    }

    public function unLikeContent(int $contentId)
    {
        $wasDeleted = ContentLike::where(['contentId' => $contentId, 'userId' => user()->id])->delete();
        $content = Content::find($contentId);
        if ($content && $content->like_count > 0) {
            $content->like_count--;
            $content->save();
        }
        if ($wasDeleted) {
            $this->dataVersionService->incrementUserContextVersion(UserDataVersionKeyEnum::Content, user()->id);
        }
    }
}
