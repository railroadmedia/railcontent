<?php

namespace App\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Jobs\RemoveRailTrackerDataJob;
use App\Modules\EventDataSynchronizer\Jobs\CustomerIoSyncUserByUserId;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Modules\UserManagementSystem\Models\User;

class SyncUsersToCIO extends Command
{
    protected $signature = 'SyncUsersToCIO';

    public function handle()
    {
        $usersToSync = User::query()->where('created_at', '<', '2023-11-07')
            ->orderBy('id', 'asc')
            ->chunk(100, function(Collection $users) {
                $this->info('Syncing ' . $users->count() . ' users to c.io.');

                foreach ($users as $userIndex => $user) {
                    dispatch(new CustomerIoSyncUserByUserId($user));

                    if ($userIndex % 50 == 0) {
                        $this->info('Done ' . $userIndex);
                    }
                }

                $this->info('Done.');
            });
    }
}
