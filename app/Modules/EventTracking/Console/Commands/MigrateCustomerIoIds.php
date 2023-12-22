<?php

namespace App\Modules\EventTracking\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\EventTracking\Jobs\MigrateCustomerIoIdsJob;

class MigrateCustomerIoIds extends Command
{
    protected $signature = 'eventTracking:migrateCustomerIoIds';

    protected $description = 'Sync shopfiy order data into user access permissions table';
    private const WORKSPACE_NAMES = ['musora', 'drumeo', 'pianote', 'guitareo', 'singeo'];

    public function handle(): void
    {
        foreach (self::WORKSPACE_NAMES as $workspaceName) {
            $this->runBatchQuery(
                function (int $skip, int $take) use ($workspaceName) {
                    return new MigrateCustomerIoIdsJob(
                        $skip,
                        $take,
                        $workspaceName
                    );
                },
                chunks: 100,
                queue: 'command'
            );
        }
    }
}
