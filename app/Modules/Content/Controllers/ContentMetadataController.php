<?php

namespace App\Modules\Content\Controllers;

use App\Modules\Content\Models\ContentLike;
use App\Modules\Content\Models\ContentUserProgress;
use App\Modules\Content\Requests\ContentMetadataRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
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

        // @codeCoverageIgnoreStart
        // safety catch
        if (!$user) {
            return response()->json(['error' => 'Invalid UserId or No Authenticated User'], 404);
        }
        // @codeCoverageIgnoreEnd

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

        // @codeCoverageIgnoreStart
        // safety catch
        if (!$user) {
            return response()->json(['error' => 'Invalid UserId or No Authenticated User'], 404);
        }
        // @codeCoverageIgnoreEnd

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
}
