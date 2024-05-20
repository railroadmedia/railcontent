<?php

namespace App\Modules\Ecommerce\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\Ecommerce\Jobs\Shopify\KickOffBulkCustomerCreateFromUsers;
use Carbon\Carbon;

class SyncBulkUsersToShopify extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'shopify:sync-users-bulk
                            {--limit= : (Optional) The number of users to limit this run to. Not recommended for production environment. }
                            {--execute : Execute this sync to Shopify. Without this flag, it will be simulated. }';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync our users up to Shopify in a bulk operation';

    /**
     * Is this sync running for real?
     *
     * @return bool
     */
    protected function getIsExecuting(): bool
    {
        return $this->option("execute") == true;
    }

    /**
     * Get the optional limit to the number of users to sync
     *
     * @return int|null
     */
    protected function getLimit(): ?int
    {
        return $this->option("limit");
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        $this->info(sprintf("Starting SyncBulkUsersToShopify at %s", Carbon::now()->toString()));
        if (!$this->getIsExecuting()) {
            $this->info("Executing in simulation mode. The source jsonl files will be created, but not processed."
                ." Please check the logs for results of the SyncBulkUsersToShopify jobs to get the file names for"
                ." your review.  Use --execute to run for real.");
        }

        // the kickoff jobs for users and customers create more jobs in sequence, and we want all users to be completed
        // before the customers start, so we will dispatch only the kickoff for users, and the customers will be run
        // separately
        KickOffBulkCustomerCreateFromUsers::dispatchSync($this->getIsExecuting(), $this->getLimit());
        $this->info("Jobs dispatched. Please check the logs for results of the SyncBulkUsersToShopify jobs.");
        $this->info("Check the logs for 'SyncBulkUsersToShopify: Batch ID' to retrieve the batch id in case you need to cancel it.");

        return self::SUCCESS;
    }
}
