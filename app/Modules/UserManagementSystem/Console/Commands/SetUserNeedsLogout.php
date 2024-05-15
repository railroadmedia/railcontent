<?php

namespace App\Modules\UserManagementSystem\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use Illuminate\Support\Facades\DB;
use Modules\UserManagementSystem\Models\User;

class SetUserNeedsLogout extends Command
{
    protected $signature = 'user:needs_logout
                            {userId* : The Id(s) of the user(s) to set the needs_logout flag upon.}';

    protected $description = 'Set the needs_logout flag to true, for the given users';

    /**
     * @throws \Throwable
     */
    public function handle()
    {
        $userIds = $this->argument('userId');

        // ensure the user IDs are all valid
        $users = User::whereIn('id', $userIds)->get();
        $missing = array_diff($userIds, $users->pluck('id')->toArray());

        if (!empty($missing)) {
            $this->error('Invalid user ID ' . implode(', ', $missing));
            return self::FAILURE;
        }

        // perform the update in a transaction, so we can just do one call
        DB::transaction(function () use ($users) {
            $users->each(function (User $user) {
                $user->update(['needs_logout' => true]);
            });
        });

        $this->info('Set needs_logout for user ID ' . implode(', ', $userIds));
        return self::SUCCESS;
    }
}
