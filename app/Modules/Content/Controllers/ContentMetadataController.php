<?php

namespace App\Modules\Content\Controllers;

use App\Modules\Content\Models\Content;
use App\Modules\Content\Models\ContentLike;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\UserManagementSystem\Models\User;
use Railroad\Railcontent\Services\ContentLikeService;

class ContentMetadataController extends Controller
{
    public function __construct(private ContentLikeService $contentLikeService)
    {
    }

    public function isLikedByUser(Request $request, Content $content, ?User $user = null): JsonResponse
    {
        // if the user ID isn't provided, grab the user from the session
        if (is_null($user)) {
            $user = user();
        }

        if (!$user) {
            return response()->json(['message' => 'Invalid UserId or No Authenticated User'], 404);
        }

        $liked = ContentLike::isContentLikedByUser($content->id, $user->id);
        return response()->json([$content->id => $liked]);
    }
}
