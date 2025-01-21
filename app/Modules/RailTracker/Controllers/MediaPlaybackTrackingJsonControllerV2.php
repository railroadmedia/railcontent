<?php

namespace App\Modules\RailTracker\Controllers;

use App\Modules\RailTracker\Enums\MediaTypeEnum;
use App\Modules\RailTracker\Requests\MediaSessionRequest;
use App\Modules\RailTracker\Services\MediaPlaybackServiceV2;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;

class MediaPlaybackTrackingJsonControllerV2 extends Controller
{
    use ValidatesRequests;

    public function __construct(private readonly MediaPlaybackServiceV2 $mediaPlaybackTracker)
    {
    }

    public function store(MediaSessionRequest $request): JsonResponse
    {
        $userId = auth()->id() ?? null;
        $mediaType = MediaTypeEnum::tryFrom($request->input('media_type_id'));
        $this->mediaPlaybackTracker->trackMediaPlaybackStart(
            $request->input('session_id'),
            $request->input('content_id'),
            $mediaType,
            $request->input('media_length_seconds'),
            $request->input('current_second', 0),
            $request->input('seconds_played', 0),
            $userId,
        );
        return response()->json();
    }
}
