<?php

namespace App\Console\Commands;

use App\Jobs\SyncUsersProductPermissionsQueryJob;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Database\DatabaseManager;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\DB;
use Railroad\Railcontent\Events\ContentCreated;
use Railroad\Railcontent\Helpers\ContentHelper;
use Railroad\Railcontent\Repositories\ContentRepository;


class AssignSongsPermissionsToAllUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'AssignSongsPermissionsToAllUsers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'AssignSongsPermissionsToAllUsers';


    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('Starting AssignSongsPermissionsToAllUsers...');

        $allBrandsLegacyMembershipPermissionNames = [
            'Drumeo Edge',
            'Pianote Membership',
            'Guitareo Membership',
            'Singeo Membership',
            'Recordeo Membership',
            'Musora Membership',
            'Musora Basic Membership',
            'Musora Plus Membership',
        ];

        // get all products with any of these permission names
        $products = $this->musoraDB()
            ->from('ecommerce_products')
            ->whereJsonContains('digital_access_permission_names', $allBrandsLegacyMembershipPermissionNames[0])
            ->orWhereJsonContains('digital_access_permission_names', $allBrandsLegacyMembershipPermissionNames[1])
            ->orWhereJsonContains('digital_access_permission_names', $allBrandsLegacyMembershipPermissionNames[2])
            ->orWhereJsonContains('digital_access_permission_names', $allBrandsLegacyMembershipPermissionNames[3])
            ->orWhereJsonContains('digital_access_permission_names', $allBrandsLegacyMembershipPermissionNames[4])
            ->orWhereJsonContains('digital_access_permission_names', $allBrandsLegacyMembershipPermissionNames[5])
            ->orWhereJsonContains('digital_access_permission_names', $allBrandsLegacyMembershipPermissionNames[6])
            ->orWhereJsonContains('digital_access_permission_names', $allBrandsLegacyMembershipPermissionNames[7])
            ->get();

        // get all users who have any of those user products
        $allUsersIdsToSync = [];
        $count = 0;

        $this->info('Finding all unique user ids to sync...');

        $this->musoraDB()
            ->from('ecommerce_user_products')
            ->whereIn('product_id', $products->pluck('id'))
            ->orderBy('user_id', 'asc')
            ->chunkById(1000, function(Collection $userProductRows) use (&$count, &$allUsersIdsToSync) {
                $allUsersIdsToSync = array_merge($allUsersIdsToSync, array_unique($userProductRows->pluck('user_id')->toArray()));

                $count += 1000;

//                $this->info('$count:' . $count);
//                $this->info("real: ".(memory_get_peak_usage(true)/1024/1024)." MiB");
            }, 'user_id');

        $allUsersIdsToSync = array_unique($allUsersIdsToSync);
        $this->info('Syncing ' . count($allUsersIdsToSync) . ' user ids.');

        // sync all those user ids by dispatching jobs
        $allUsersIdsToSyncChunked = array_chunk($allUsersIdsToSync, 250);

        $jobsToChain = [];

        $allUsersIdsToSyncChunked = array_reverse($allUsersIdsToSyncChunked);

        foreach ($allUsersIdsToSyncChunked as $chunkIndex => $userIdsChunk) {
            $jobsToChain[] = new SyncUsersProductPermissionsQueryJob($userIdsChunk);
        }

        $jobsToChain = array_slice($jobsToChain, 0, 10);

        $this->info('About to chain jobs, count: ' . count($jobsToChain));

        Bus::chain($jobsToChain)->dispatch();

        $this->info('Done!');

        return 0;
    }

    private function musoraDB()
    {
        return DB::connection(config('railcontent.database_connection_name'))->query();
    }
}
