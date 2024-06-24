<?php

namespace App\Modules\Content\Controllers;

use App\Modules\Content\Models\Content;
use App\Modules\Content\Models\ContentLike;
use App\Modules\Content\Models\ContentUserProgress;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\UserManagementSystem\Models\User;

class ContentMetadataController extends Controller
{
    public function __construct()
    {
    }

    public function isLikedByUser(Request $request, Content $content, ?User $user = null): JsonResponse
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

        $liked = ContentLike::isContentLikedByUser($content->id, $user->id);
        return response()->json([$content->id => $liked]);
    }

    public function userProgress(Request $request, Content $content, ?User $user = null): JsonResponse
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
            $progressState = ContentUserProgress::getState($content->id, $user->id);
            return response()->json([$content->id => $progressState->toArray()]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }
}
