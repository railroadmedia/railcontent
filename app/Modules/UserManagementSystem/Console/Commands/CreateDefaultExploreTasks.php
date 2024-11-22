<?php

namespace App\Modules\UserManagementSystem\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use Illuminate\Support\Carbon;
use Modules\UserManagementSystem\Models\ExploreTask;

class CreateDefaultExploreTasks extends Command
{
    protected $signature = 'onboarding:createDefaultExploreTasks';
    protected $description = 'Create default explore tasks based on the default configuration';

    public function handle(): void
    {
        $tasks = array_map(
            function ($task) {
                return [
                    'title' => $task['title'],
                    'hook' => $task['hook'],
                    'description' => $task['description'],
                    'icon' => $task['icon'],
                    'expires_in_days' => array_key_exists('expires_in_days', $task) ? $task['expires_in_days'] : null,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ];
            },
            config('onboarding.default_tasks')
        );


        /**
         * NOTE: Ignore duplicates to make the command idempotent. If the task already exists, no need to be
         * created again. This allows the command to be run multiple times to add new tasks without causing any issues.
         */
        ExploreTask::insertOrIgnore($tasks);
    }
}
