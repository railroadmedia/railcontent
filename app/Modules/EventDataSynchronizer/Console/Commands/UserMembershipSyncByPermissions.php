<?php

namespace App\Modules\EventDataSynchronizer\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\EventDataSynchronizer\Jobs\UserMembershipOwnedProductSyncJob;

class UserMembershipSyncByPermissions extends Command
{
    protected $description = 'Sync membership data for user who own permission';
    protected $signature = 'user:MembershipSyncByPermission
        {permissionId : filter on users who own this permission}
        {afterDate? : only sync users who obtained permission after this date}
        {--syncContentPermissions : sync content permission}
        {--syncCustomerIO=0 : sync customer io data}
    ';

    public function handle()
    {
        $permissionId = $this->argument('permissionId');
        $syncCustomerIO = $this->option('syncCustomerIO');
        $syncContentPermissions = $this->option('syncContentPermissions');
        $afterDate = $this->argument('afterDate');

        $this->runBatchQuery(
            function (int $skip, int $take) use ($permissionId, $afterDate, $syncContentPermissions, $syncCustomerIO) {
                return new UserMembershipOwnedProductSyncJob(
                    $skip,
                    $take,
                    $permissionId,
                    $afterDate,
                    $syncContentPermissions,
                    $syncCustomerIO
                );
            },
            chunks: 1000,
            queue: 'command'
        );
    }
}
