<?php

namespace App\Modules\Content\Controllers;

use App\Modules\Brand\Enums\Brand;
use App\Modules\Content\Enums\ProgressState;
use App\Modules\Content\Models\ContentLike;
use App\Modules\Content\Models\ContentUserProgress;
use App\Modules\Content\Requests\ContentMetadataRequest;
use App\Modules\Content\Requests\ContentProgressMetadataRequest;
use Exception;
use App\Modules\Tracker\Models\LastEngagedSeconds;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Illuminate\Support\Arr;
use Modules\UserManagementSystem\Models\User;
use Railroad\MusoraApi\Contracts\ProductProviderInterface;
use Railroad\Railcontent\Services\UserPermissionsService;

class ContentMetadataController extends Controller
{
    public function __construct(
        private ProductProviderInterface $productProvider,
        private UserPermissionsService $userPermissionsService)
    {
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
     * @param  ProgressState  $progressState
     * @param  ContentProgressMetadataRequest  $request
     * @param  User|null  $user
     * @return JsonResponse
     */
    private function contentWithProgressForUser(ProgressState $progressState, ContentProgressMetadataRequest $request, ?User $user = null): JsonResponse
    {
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
                ->when($progressState === ProgressState::Started, fn ($query) => $query->incomplete())
                ->when($progressState === ProgressState::Completed, fn ($query) => $query->complete())
                ->when(!is_null($type), fn ($query) => $query->ofContentType($type))
                ->when(!is_null($brand), fn ($query) => $query->ofContentBrand($brand))
                ->when(
                    !is_null($page),
                    // when we're using pagination, we need to apply the limit to the page
                    fn ($query) => $query->forPage($page, $limit),
                    // otherwise, apply the limit to the whole query (if it's there)
                    fn ($query) => $query->when(!is_null($limit), fn ($query) => $query->limit($limit))
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
            'isLiked' => $isLiked ,
            'likeCount' => $likedCount,
            'isAdded' => false,
            'currentSecond' => $currentSecond
        ];
    }

    /**
     * @return JsonResponse
     */
    public function getUserPermissions() : JsonResponse
    {
        $permissions = $this->userPermissionsService->getUserPermissions(user()->id);
        $permissions = Arr::pluck($permissions, 'permission_id');
        return response()->json($permissions);
    }
}
