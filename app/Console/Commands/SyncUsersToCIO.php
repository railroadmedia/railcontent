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
        $this->info('Users found: ' . User::query()->where('created_at', '>', '2023-11-01')->count());

        $totalDone = 0;

        $usersToSync = User::query()->where('created_at', '>', '2023-11-01')
            ->orderBy('id', 'asc')
            ->chunk(100, function(Collection $users) use (&$totalDone) {
                $this->info('Syncing ' . $users->count() . ' users to c.io.');

                foreach ($users as $userIndex => $user) {
                    dispatch(new CustomerIoSyncUserByUserId($user));

                    $this->info('Email to sync: ' . $user->email);
                }

                if ($totalDone % 50 == 0) {
                    $this->info('Done ' . $totalDone);
                }
            });
    }
}
