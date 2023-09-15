<?php

namespace App\Modules\Ecommerce\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\Ecommerce\Jobs\Shopify\KickOffBulkCustomerCreateFromCustomers;
use App\Modules\Ecommerce\Jobs\Shopify\KickOffBulkCustomerCreateFromUsers;
use Carbon\Carbon;
use Illuminate\Support\Facades\Bus;

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
     */
    public function handle(): int
    {
        $this->info(sprintf("Starting SyncBulkCustomersToShopify at %s", Carbon::now()->toString()));
        if (!$this->getIsExecuting()){
            $this->info("Executing in simulation mode. The source jsonl files will be created, but not processed."
                ." Please check the logs for results of the SyncBulkCustomersToShopify jobs to get the file names for"
                ." your review.  Use --execute to run for real.");
        }

        Bus::chain([
            new KickOffBulkCustomerCreateFromUsers($this->getIsExecuting()),
            new KickOffBulkCustomerCreateFromCustomers($this->getIsExecuting())
        ])->dispatch();

        $this->info("Jobs dispatched. Please check the logs for results of the SyncBulkCustomersToShopify jobs.");

        return self::SUCCESS;
    }
}
