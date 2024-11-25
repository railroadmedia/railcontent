<?php

namespace Modules\UserManagementSystem\Listeners;

use App\Modules\FeatureFlagging\Facades\FeatureFlagging;
use Illuminate\Support\Carbon;
use Exception;
use Illuminate\Support\Facades\Log;
use Modules\UserManagementSystem\Events\User\UserCreated;
use Modules\UserManagementSystem\Models\User;
use Modules\UserManagementSystem\Models\UserExploreTask;
use Modules\UserManagementSystem\Services\ExploreTasksService;
use Railroad\Railcontent\Events\UserContentProgressSaved;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Services\UserContentProgressService;
use Railroad\Railforums\Events\PostCreated;

class ExploreTasksListener
{
    public function __construct(
        private readonly ExploreTasksService $exploreTasksService,
        private readonly ContentService $contentService
    ) {
    }

    public function handleUserCreated(UserCreated $event): void
    {
        if (boolval(FeatureFlagging::branch('homepage-v2', $event->getUser()))) {
            $this->exploreTasksService->createDefaultExploreTasks($event->getUser());
        }
    }

    public function handlePostCreated(PostCreated $event): void
    {
        $user = User::find($event->getUserId());

        if ($user && boolval(FeatureFlagging::branch('homepage-v2', $user))) {
            UserExploreTask::query()
                ->where([ 'user_id' => $user->id, ])
                ->byHook('introduce-yourself')
                ->notExpired()
                ->uncompleted()
                ->update([
                    'is_completed' => true,
                    'completed_at' => Carbon::now()
                ]);
        }
    }

    public function handleUserContentProgressSaved(UserContentProgressSaved $event): void
    {
        $content = $this->contentService->getById($event->contentId);

        /** @var User $user */
        $user = User::find($event->userId);

        if ($content && $user && boolval(FeatureFlagging::branch('homepage-v2', $user))) {
            try {
                $parentData = $content->getParentContentData();
                if (
                    $parentData
                    && last($parentData)->type === 'learning-path'
                    && $event->progressStatus === UserContentProgressService::STATE_STARTED
                ) {
                    $user->exploreTasks()
                        ->where([ 'user_id' => $user->id, ])
                        ->byHook('start-the-method')
                        ->notExpired()
                        ->uncompleted()
                        ->update([
                            'is_completed' => true,
                            'completed_at' => Carbon::now()
                        ]);
                }
            } catch (Exception $e) {
                // shouldn't block user
                Log::error($e->getMessage());
            }
        }
    }
}
