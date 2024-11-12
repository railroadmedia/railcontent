<?php

namespace App\Modules\Content\Controllers;

use App\Modules\Content\Models\ContentUserProgress;
use App\Modules\Content\Services\ContentProgressService;
use App\Modules\Tracker\Models\LastEngagedSeconds;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ContentProgressController
{

    private ContentProgressService $contentProgressService;

    public function __construct(ContentProgressService $contentProgressService)
    {
        $this->contentProgressService = $contentProgressService;
    }

    public function all(): array
    {
        $allProgressData = ContentUserProgress::getAllProgressDataByUser(user()->id)
            ->keyBy('content_id')
            ->map(function ($item) {
                return [
                    's' => $item['state'],
                    'p' => $item['progress_percent'],
                    'u' => Carbon::parse($item['updated_on'])->timestamp
                ];
            });
        $lastEngagedSeconds = LastEngagedSeconds::getAllContentResumeTimeSeconds(user()->id)
            ->keyBy('content_id')
            ->map(function ($item) {
                return ['t' => $item['resume_time_seconds']];
            });
        foreach ($lastEngagedSeconds as $contentId => $lastEngagedSecond) {
            $allProgressData[$contentId] = array_merge(
                $allProgressData[$contentId] ?? [],
                $lastEngagedSecond
            );
        }

        return $allProgressData->toArray();
    }

    public function start(Request $request): JsonResponse
    {
        $contentId = $request->input('contentId');
        $this->contentProgressService->startContent($contentId, user()->id);
        return response()->json(['success' => 'success'], 201);
    }

    public function complete(Request $request): JsonResponse
    {
        $contentId = $request->input('contentId');
        $this->contentProgressService->completeContent($contentId, user()->id);
        return response()->json(['success' => 'success']);
    }

    public function reset(Request $request): JsonResponse
    {
        $contentId = $request->input('contentId');
        $this->contentProgressService->resetContent($contentId, user()->id);
        return response()->json(['success' => 'success']);
    }
}
