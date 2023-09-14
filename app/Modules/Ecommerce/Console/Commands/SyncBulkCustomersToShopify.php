<?php

namespace App\Modules\Ecommerce\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\Ecommerce\Jobs\Shopify\BulkCustomerCreateFromUsers;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Bus;
use Modules\UserManagementSystem\Models\User;

class SyncBulkCustomersToShopify extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'shopify:sync-customers-bulk
                            {--execute : Execute this sync to Shopify. Without this flag, it will be simulated. }';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync our users and customers up to Shopify';

    function getIsExecuting(): bool
    {
        return $this->option("execute") == true;
    }

    /**
     * Execute the console command.
     *
     * @return int
     * @throws \Throwable
     */
    public function handle(): int
    {
        $timeStart = microtime(true);
        // $batchSize = 500;
        $batchSize = 5;

        $usersToCreate = $this->getUsersToCreateQuery();
        $jobsBatch = [];

        $this->info(sprintf("Starting SyncBulkCustomersToShopify at %s", Carbon::now()->toString()));
        $this->info(sprintf("Found %s users to be created in Shopify.", $usersToCreate->count()));
        $this->info("Dispatching jobs to sync users and customers ...");

        //TODO TESTING ONLY - remove limit and userCount stuff for prod!
        $batchesToDo = 1;
        $totalCountForRun = $batchSize * $batchesToDo;
        $userCount = 0;
        $usersToCreate->chunk($batchSize, function (Collection $users) use (&$jobsBatch, &$userCount, $totalCountForRun) {
            $jobsBatch[] = new BulkCustomerCreateFromUsers($users, $this->getIsExecuting());

            //TODO TESTING ONLY - remove limit stuff for prod!
            // chunk doesn't keep the limit set before, so we'll work around that by keeping track of the count internally
            $userCount += $users->count();
            if ($userCount >= $totalCountForRun) {
                return false;
            }
        });
        //TODO add a JOB to initiate the create job for customers
        // - doing it through a job, instead of another query here, means that we can do the customers query AFTER
        // all the users have been done, and stop from having customers in the query results that would have been synced
        // in the users process

        //TODO maybe the finally is causing the delay
        // Bus::batch($jobsBatch)
        //     ->finally(function () use ($timeStart) {
        //         $diff = microtime(true) - $timeStart;
        //         $sec = intval($diff);
        //         Log::info(sprintf("Finished SyncBulkCustomersToShopify (%s s)", $sec));
        //     })->dispatch();
        Bus::batch($jobsBatch)
            ->dispatch();

        if (!$this->getIsExecuting()){
            $this->info("Executing in simulation mode. The source jsonl file will be created, but not processed."
                ." Please check the logs for results of the SyncBulkCustomersToShopify jobs to get the file names for"
                ." your review.  Use --execute to run for real.");
        }
        $this->info("Jobs dispatched. Please check the logs for results of the SyncBulkCustomersToShopify jobs.");
        return self::SUCCESS;
    }

    /**
     * Get the query builder that we'll use to get all users to create in Shopify
     *
     * @return Builder
     */
    private function getUsersToCreateQuery(): Builder
    {
        return User::query()
                    ->whereNull("shopify_id")
        //TODO TESTING ONLY
        ->limit(24)
        ;
    }

}
