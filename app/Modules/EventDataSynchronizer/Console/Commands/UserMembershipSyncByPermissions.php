<?php

namespace App\Modules\EventDataSynchronizer\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\EventDataSynchronizer\Jobs\UserMembershipOwnedProductSyncJob;

class UserMembershipSyncByPermissions extends Command
{
    protected $description = 'Sync membership data for user who own permission';
    protected $signature = 'user:MembershipSyncByPermission
    {permissionId : filter on users who own this permission}
    {syncCustomerIO? : sync some customer io data} 
    {afterDate? : only sync users who obtained permission after this date}';

    public function handle()
    {
        $permissionId = $this->argument('permissionId');
        $syncCustomerIO = $this->argument('syncCustomerIO') == 1;
        $afterDate = $this->argument('afterDate');

        $this->runBatchQuery(function (int $skip, int $take) use ($permissionId, $syncCustomerIO, $afterDate) {
            return new UserMembershipOwnedProductSyncJob($skip, $take, $permissionId, $syncCustomerIO, $afterDate);
        }, chunks: 500);
    }
}
