<?php

namespace App\Modules\Content\Services;

use App\Modules\Content\Enums\ProgressState;
use App\Modules\Content\Models\ContentUserProgress;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class ContentProgressDataContext
{
    private array $loadedContentProgressLookup = [];


    public function getOrCreate(int $contentId, int $userId): ContentUserProgress
    {
        $contentProgress = $this->get($contentId, $userId);
        if (!$contentProgress) {
            $contentProgress = new ContentUserProgress();
            $contentProgress->user_id = $userId;
            $contentProgress->content_id = $contentId;
            $contentProgress->state = ProgressState::Started;
            $contentProgress->started_on = Carbon::now()->toDateTimeString();
        }
        return $contentProgress;
    }

    public function get(int $contentId, int $userId): ?ContentUserProgress
    {
        $contentProgress = ContentUserProgress::query()
            ->where('content_id', $contentId)
            ->where('user_id', $userId)
            ->first();
        if ($contentProgress) {
            $this->loadedContentProgressLookup[$contentProgress->content_id] = $contentProgress;
        }
        return $contentProgress;
    }

    public function getByIds(array $contentIds, int $userId): Collection
    {
        $notLoadedIds = [];
        foreach ($contentIds as $contentId) {
            if (!key_exists($contentId, $this->loadedContentProgressLookup)) {
                $notLoadedIds[] = $contentId;
            }
        }
        if (count($notLoadedIds) > 0) {
            $contentProgress = ContentUserProgress::query()
                ->whereIn('content_id', $notLoadedIds)
                ->where('user_id', $userId)
                ->get();
            $contentProgress->each(function (ContentUserProgress $contentProgress) {
                $this->loadedContentProgressLookup[$contentProgress->content_id] = $contentProgress;
            });
        }
        $contentProgresses = collect($contentIds)->map(function ($childId) {
            return $this->loadedContentProgressLookup[$childId] ?? null;
        })->filter(function ($item) {
            return $item !== null;
        });
        return $contentProgresses;
    }

    public function save(
        int $contentId,
        int $userId,
        int $progress,
        ProgressState $state,
        ?ContentUserProgress $contentProgress = null
    ): ContentUserProgress {
        if (!$contentProgress) {
            $contentProgress = $this->getOrCreate($contentId, $userId);
        }
        $contentProgress->state = $state;
        $contentProgress->progress_percent = $progress;
        $contentProgress->updated_on = Carbon::now()->toDateTimeString();
        if ($progress == 100) {
            $contentProgress->completed_on = Carbon::now()->toDateTimeString();
        }
        $contentProgress->save();
        $this->loadedContentProgressLookup[$contentProgress->content_id] = $contentProgress;
        return $contentProgress;
    }
}
