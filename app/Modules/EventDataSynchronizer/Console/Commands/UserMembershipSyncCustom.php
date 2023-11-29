<?php

namespace App\Modules\EventDataSynchronizer\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\EventDataSynchronizer\Jobs\UserMembershipSyncCustomJob;

class UserMembershipSyncCustom extends Command
{
    protected $description = 'Sync membership data for user who own permission';
    protected $signature = 'user:MembershipSyncCustom
    ';

    public function handle()
    {
        $this->runBatchQuery(
            function (int $skip, int $take)  {
                return new UserMembershipSyncCustomJob(
                    $skip,
                    $take
                );
            },
            chunks: 1000,
            queue: 'command'
        );
    }
}
