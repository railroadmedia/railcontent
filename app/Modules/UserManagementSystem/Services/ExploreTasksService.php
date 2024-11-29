<?php

namespace Modules\UserManagementSystem\Services;

use App\Modules\FeatureFlagging\Facades\FeatureFlagging;
use Illuminate\Support\Carbon;
use Modules\UserManagementSystem\Models\ExploreTask;
use Modules\UserManagementSystem\Models\User;
use Modules\UserManagementSystem\Models\UserExploreTask;

class ExploreTasksService
{
    public function createDefaultExploreTasks(User $user): void
    {
        $tasks = ExploreTask::all()->toArray();

        $user->exploreTasks()->createMany(
            array_map(function ($task) {
                return [
                    'title' => $task['title'],
                    'task_id' => $task['id'],
                    'hook' => $task['hook'],
                    'description' => $task['description'],
                    'icon' => $task['icon'],
                    'expires_at' => isset($task['expires_in_days']) ? Carbon::now()->addDays($task['expires_in_days']) : null,
                ];
            }, $tasks)
        );
    }

    public function uncompletedTasksForUser(User $user, ?int $take = 2): array
    {
        if (boolval(FeatureFlagging::branch('homepage-v2', user()))) {
            $count = $user->exploreTasks->count();
            if ($count === 0) {
                $this->createDefaultExploreTasks($user);
            }

            return $user->exploreTasks()
                ->uncompleted()
                ->notExpired()
                ->orderBy('created_at')
                ->take($take)
                ->get()
                ->map(function (UserExploreTask $userTask) {
                    return [
                        'title' => $userTask->task->title,
                        'description' => $userTask->task->description,
                        'hook' => $userTask->task->hook,
                        'icon' => $userTask->task->icon,
                        'expires_at' => $userTask->expires_at,
                        'leaving_soon' => $userTask->isLeavingSoon(),
                    ];
                })
                ->toArray();
        }
        return [];
    }
}
