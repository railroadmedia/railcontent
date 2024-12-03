<?php

namespace App\Modules\Content\Services;


use App\Modules\Content\Enums\ProgressState;
use App\Modules\Content\Models\Content;
use App\Modules\Content\Models\ContentHierarchy;
use App\Modules\Content\Models\ContentUserProgress;
use App\Modules\RailTracker\Models\MediaPlaybackSession;
use Railroad\Railcontent\Events\UserContentProgressSaved;
use Railroad\Railcontent\Events\UserContentsProgressReset;

class ContentProgressService
{
    public const int MAX_HIERARCHY_DEPTH = 4;
    private ContentProgressDataContext $contentProgressDataContext;

    public function __construct(ContentProgressDataContext $contentProgressDataContext)
    {
        $this->contentProgressDataContext = $contentProgressDataContext;
    }

    public function startContent(int $contentId, int $userId, bool $forceEvenIfComplete = false): void
    {
        $contentProgress = $this->contentProgressDataContext->getOrCreate($contentId, $userId);

        if ($contentProgress->state == ProgressState::Completed && !$forceEvenIfComplete) {
            return;
        }
        $progress = $this->getProgressPercentage($contentId, $userId);
        $this->saveContentProgressLogic(
            $contentId,
            $userId,
            $progress,
            ProgressState::Started,
            contentProgress: $contentProgress
        );
    }

    public function completeContent(int $contentId, int $userId): void
    {
        $this->saveContentProgressLogic($contentId, $userId, 100, ProgressState::Completed);

        // also mark children as complete if they have not already been marked as complete
        $allChildIds = $this->getChildIds($contentId);
        $lookup = ContentUserProgress::query()
            ->where('user_id', $userId)
            ->whereIn('id', $allChildIds)
            ->get()
            ->keyBy(function ($progress) {
                return md5("{$progress->id}_{$progress->user_id}");
            });
        foreach ($allChildIds as $childId) {
            $contentProgress = $lookup[md5("{$childId}_{$userId}")] ?? null;
            $this->saveContentProgressLogic($childId, $userId, 100, ProgressState::Completed, false, $contentProgress);
        }
    }

    public function getChildIds($contentId, $depth = self::MAX_HIERARCHY_DEPTH): array
    {
        //TODO: Ignore draft ids
        $allChildIds = [];
        $childIds = [$contentId];

        for ($i = 0; $i < $depth; $i++) {
            $childIds = ContentHierarchy::query()
                ->select(['child_id'])
                ->whereIn('parent_id', $childIds)
                ->pluck('child_id')
                ->toArray();
            $allChildIds = array_merge($allChildIds, $childIds);
            if (count($childIds) == 0) {
                break;
            }
        }
        return $allChildIds;
    }

    private function getParentIds($contentId): array
    {
//        TODO: Integrate allowed types
//        $allowedTypesForStarted = array_merge(
//            config('railcontent.allowed_types_for_bubble_progress')[ProgressState::Started],
//            config('railcontent.showTypes', [])[config('railcontent.brand')] ?? []
//        );
//        $allowedTypesForCompleted = array_merge(
//            config('railcontent.allowed_types_for_bubble_progress')[ProgressState::Completed],
//            config('railcontent.showTypes', [])[config('railcontent.brand')] ?? []
//        );
//        $allowedTypes = array_unique(array_merge($allowedTypesForStarted, $allowedTypesForCompleted));

        return ContentHierarchy::query()
            ->where('child_id', $contentId)
            ->pluck('parent_id')
            ->toArray();
    }

    private function saveContentProgressLogic(
        int $contentId,
        int $userId,
        int $progress,
        ProgressState $state,
        bool $bubble = true,
        ContentUserProgress $contentProgress = null,
    ): void {
        $this->contentProgressDataContext->save($contentId, $userId, $progress, $state, $contentProgress);
        if ($bubble) {
            $this->bubbleProgressToParent($contentId, $userId);
        }
        event(new UserContentProgressSaved($userId, $contentId, $progress, ProgressState::Completed, false));
    }

    public function resetContent(int $contentId, int $userId): void
    {
        $childIds = $this->getChildIds($contentId);
        $idsToDelete = array_merge([$contentId], $childIds);
        ContentUserProgress::query()
            ->where('user_id', $userId)
            ->whereIn('content_id', $idsToDelete)
            ->delete();

        event(new UserContentsProgressReset($userId, $idsToDelete));
        $this->bubbleProgressToParent($contentId, $userId);
        event(new UserContentProgressSaved($userId, $contentId, 0, ProgressState::Started));
    }

    public function saveContentProgress($contentId, $progress, $userId, $overwriteComplete = false): void
    {
        $contentProgress = $this->contentProgressDataContext->get($contentId, $userId);

        if (!$overwriteComplete && $contentProgress &&
            ($contentProgress->state == ProgressState::Completed || $contentProgress->progress_percent == 100)) {
            return;
        }

        if ($progress == 100) {
            $this->completeContent($contentId, $userId);
            return;
        }

        $this->saveContentProgressLogic(
            $contentId,
            $userId,
            $progress,
            ProgressState::Started,
            contentProgress: $contentProgress
        );
    }

    public function bubbleProgressToParent($contentId, $userId): void
    {
        $parentIds = $this->getParentIds($contentId);

        foreach ($parentIds as $parentId) {
            // TODO why does this happen sometimes?
            if (!$parentId) {
                continue;
            }
            $progress = $this->getProgressPercentage($parentId, $userId);

            if ($progress == 100) {
                $this->completeContent($parentId, $userId);
            } else {
                $this->saveContentProgressLogic($parentId, $userId, $progress, ProgressState::Started);
            }
        }
    }

    private function getProgressPercentage($contentId, $userId): int
    {
        $childIds = $this->getChildIds($contentId, 1);
        if (count($childIds) > 0) {
            $contentProgresses = $this->contentProgressDataContext->getByIds($childIds, $userId);

            $sum = $contentProgresses->sum(function ($contentProgress) {
                return $contentProgress->progress_percent ?? 0;
            });
            $progress = intval(round($sum / count($childIds)));
        } else {
            $progress = 0;
        }
        return $progress;
    }

   public function updateContentProgress(MediaPlaybackSession $mediaPlaybackSession, Content $content): void
   {
       if ($mediaPlaybackSession->media_length_seconds <= 0) {
           return;
       }
       $percentage = $mediaPlaybackSession->calculatePercentage();
       $this->saveContentProgress($content->id, $percentage, $mediaPlaybackSession->user_id);
   }
}
