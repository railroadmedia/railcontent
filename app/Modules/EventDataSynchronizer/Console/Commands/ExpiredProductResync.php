<?php

namespace App\Modules\EventDataSynchronizer\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\EventDataSynchronizer\Jobs\ExpiredProductsResyncJob;
use App\Modules\EventDataSynchronizer\Services\UserMembershipFieldsService;

class ExpiredProductResync extends Command
{
    protected $description = 'ExpiredProductResync';
    protected $signature = 'user:resyncExpiredProducts';

    public function handle(UserMembershipFieldsService $userMembershipFieldsService)
    {
        $this->runChainQuery(function (int $skip, int $take) {
            return new ExpiredProductsResyncJob($skip, $take);
        }, chunks: 500);

        return true;
    }
}
