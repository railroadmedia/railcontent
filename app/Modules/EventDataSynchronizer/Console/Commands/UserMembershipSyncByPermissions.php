<?php

namespace App\Modules\EventDataSynchronizer\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\EventDataSynchronizer\Jobs\UserMembershipOwnedProductSyncJob;

class UserMembershipSyncByPermissions extends Command
{
    protected $description = 'Sync membership data for user who own permission';
    protected $signature = 'user:MembershipSyncByPermission
        {--customQuery= : run a custom query instead of the default one, see QueryServices.getCustomUserQuery for options}
        {--customQueryParameter= : parameter for custom query}
        {--syncContentPermissions : sync content permission}
        {--syncCustomerIO=0 : sync customer io data}
    ';

    public function handle()
    {
        $customQuery = $this->option('customQuery');
        $customQueryParameter = $this->option('customQueryParameter');
        $syncCustomerIO = $this->option('syncCustomerIO');
        $syncContentPermissions = $this->option('syncContentPermissions');

        $this->runBatchQuery(
            function (int $skip, int $take) use ($customQuery, $customQueryParameter, $syncContentPermissions, $syncCustomerIO) {
                return new UserMembershipOwnedProductSyncJob(
                    $skip,
                    $take,
                    $customQuery,
                    $customQueryParameter,
                    $syncContentPermissions,
                    $syncCustomerIO
                );
            },
            chunks: 1000,
            queue: 'command'
        );
    }
}
