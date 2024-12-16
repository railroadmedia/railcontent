<?php

namespace App\Modules\Ecommerce\Console\Commands;

use App\Modules\Ecommerce\Jobs\Shopify\FulfillOrdersImportedIntoShopify;
use Carbon\Carbon;
use Illuminate\Bus\Batch;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Log;
use Throwable;

class FulfillOrdersImportedIntoShopifyDispatcher extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'shopify:fulfill-imported-orders
                            {--customerId= : (Optional) the Shopify ID of the customer to restrict the orders to}
                            {--startProcessedAt= : (Optional) The ISO 8601 date time for all Shopify orders to get where the processed_at at or after. e.g. 2023-10-13T17:00:25+00:00}
                            {--endProcessedAt= : (Optional) The ISO 8601 date time for all Shopify orders to get where the processed_at at or before. e.g. 2023-10-13T17:30:14+00:00}
                            {--execute : Update the database records. Without this flag, results will be simulated.}';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fulfill eligible orders that were imported into Shopify';

    /**
     * Execute the console command.
     *
     * @throws Throwable
     */
    public function handle(): int
    {
        $customerId = $this->option("customerId");
        $startProcessedAt = $this->option("startProcessedAt") ?: '1970-01-01T00:00:00Z';
        $endProcessedAt = $this->option("endProcessedAt") ?: config('ecommerce.launch_date_times.shopify');
        $simulate = $this->option("execute") == false;

        $startAt = Carbon::now();
        $batch = Bus::batch(new FulfillOrdersImportedIntoShopify(null, $customerId, $startProcessedAt, $endProcessedAt, $simulate))
            ->then(function (Batch $batch) use ($startAt) {
                Log::info(
                    sprintf("FulfillOrdersImportedIntoShopify: completed in %s seconds", $startAt->diffInSeconds())
                );
            })->catch(function (Batch $batch, Throwable $e) {
                Log::error($e->getMessage());
            })
            ->onQueue('command')
            ->dispatch();
        $this->info(
            sprintf(
                "FulfillOrdersImportedIntoShopify: Batch ID %s dispatched.",
                $batch->id
            )
        );

        return self::SUCCESS;
    }
}
