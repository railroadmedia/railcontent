<?php

namespace App\Modules\Content\Controllers;

use App\Modules\Brand\Enums\Brand;
use App\Modules\Content\Enums\ProgressState;
use App\Modules\Content\Models\ContentLike;
use App\Modules\Content\Models\ContentUserProgress;
use App\Modules\Content\Requests\ContentMetadataRequest;
use App\Modules\Tracker\Models\LastEngagedSeconds;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Validation\Rules\Enum;
use Modules\UserManagementSystem\Models\User;

class ContentMetadataController extends Controller
{
    public function __construct()
    {
    }

    public function isLikedByUser(ContentMetadataRequest $request, ?User $user = null): JsonResponse
    {
        // if the user ID isn't provided, grab the user from the session
        if (is_null($user)) {
            $user = user();
        }

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
        if (is_null($user)) {
            $user = user();
        }

        try {
            $contentIds = $request->query('content_ids', []);
            $results = [];
            foreach ($contentIds as $contentId) {
                $progressState = ContentUserProgress::getState($contentId, $user->id);
                $results[$contentId] = $progressState->toArray();
            }
            return response()->json($results);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }

    public function inProgressForUser(Request $request, ?User $user = null): JsonResponse
    {
        $validated = $request->validate(
            [
                'content_type' => 'nullable|string',
                'brand' => ['nullable', new Enum(Brand::class)],
                'user' => 'nullable'
            ]
        );

        // if the user ID isn't provided, grab the user from the session
        if (is_null($user)) {
            $user = user();
        }

        $type = $validated['content_type'] ?? null;
        $brandValue = $validated['brand'] ?? null;
        $brand = null;
        if ($brandValue) {
            $brand = Brand::from($brandValue);
        }

        $inProgress = $user->progress()
            ->incomplete()
            ->when(!is_null($type), fn($query) => $query->ofContentType($type))
            ->when(!is_null($brand), fn($query) => $query->ofContentBrand($brand))
            ->pluck('content_id');

        return response()->json([ProgressState::Started->value => $inProgress]);
    }

    public function getContentPageUserData(int $contentId, ?User $user = null): array
    {
        //$userId = user()->id;
        $isLiked = ContentLike::isContentLikedByUser($contentId, $user->id);
        $likedCount = ContentLike::getContentLikedCount($contentId);
        $currentSecond = LastEngagedSeconds::getResumeTimeSeconds($contentId, $user->id);
        return [
            'isLiked' =>$isLiked ,
            'likeCount' => $likedCount,
            'isAdded' => false,
            'currentSecond' => $currentSecond
        ];
    }
}
