<?php

namespace App\Modules\Content\Controllers;

use App\Modules\Content\Models\ContentUserProgress;
use App\Modules\Content\Services\ContentProgressService;
use App\Modules\Tracker\Models\LastEngagedSeconds;
use Illuminate\Http\JsonResponse;

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
                return ['s' => $item['state'], 'p' => $item['progress_percent']];
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

    public function start(int $contentId): JsonResponse
    {
        $this->contentProgressService->startContent($contentId, user()->id);
        return response()->json(['success' => 'success'], 201);
    }

    public function complete(int $contentId): JsonResponse
    {
        $this->contentProgressService->completeContent($contentId, user()->id);
        return response()->json(['success' => 'success']);
    }

    public function reset(int $contentId): JsonResponse
    {
        $this->contentProgressService->resetContent($contentId, user()->id);
        return response()->json(['success' => 'success']);
    }

    public function saveProgress(int $contentId, int $progressPercent): JsonResponse
    {
        $this->contentProgressService->saveContentProgress($contentId, $progressPercent, user()->id);
        return response()->json(['success' => 'success']);
    }
}
