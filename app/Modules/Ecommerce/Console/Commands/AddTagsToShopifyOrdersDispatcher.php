<?php

namespace App\Modules\Ecommerce\Console\Commands;

use App\Modules\Ecommerce\Jobs\Shopify\AddOrderTagsJobManager;
use Carbon\Carbon;
use Illuminate\Bus\Batch;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Log;
use Throwable;

class AddTagsToShopifyOrdersDispatcher extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'shopify:add-order-tags
                            {--customerId= : (Optional) the Shopify ID of the customer to restrict the orders to}
                            {--startProcessedAt= : (Optional) The ISO 8601 date time for all Shopify orders to get where the processed_at at or after. e.g. 2023-10-13T17:00:25+00:00}
                            {--endProcessedAt= : (Optional) The ISO 8601 date time for all Shopify orders to get where the processed_at at or before. e.g. 2023-10-13T17:30:14+00:00}
                            {--trialConversionDayLimit=45 : the maximum number of days between a trial and a purchase, to consider it a conversion}
                            {--startCreatedAt= : (Optional) The ISO 8601 date time for all Shopify orders to get where the created_at at or after. e.g. 2023-10-13T17:00:25+00:00}
                            {--endCreatedAt= : (Optional) The ISO 8601 date time for all Shopify orders to get where the created_at at or before. e.g. 2023-10-13T17:30:14+00:00}
                            {--execute : Execute this operation to Shopify. Without this flag, it will be simulated.}';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Apply tags to Shopify orders';

    /**
     * Execute the console command.
     *
     * @throws Throwable
     */
    public function handle(): int
    {
        $startProcessedAt = $this->option("startProcessedAt") ?: '1970-01-01T00:00:00Z';
        $endProcessedAt = $this->option("endProcessedAt") ?: now()->toIso8601String();
        $startCreatedAt = $this->option("startCreatedAt");
        $endCreatedAt = $this->option("endCreatedAt");
        $customerId = $this->option("customerId");
        $simulate = $this->option("execute") == false;
        $trialConversionDayLimit = $this->option('trialConversionDayLimit');


        $startAt = Carbon::now();
        $batch = Bus::batch(new AddOrderTagsJobManager(null, $customerId, $startProcessedAt, $endProcessedAt, $startCreatedAt, $endCreatedAt, $simulate, $trialConversionDayLimit))
            ->then(function (Batch $batch) use ($startAt) {
                Log::info(
                    sprintf("AddOrderTags: completed in %s seconds", $startAt->diffInSeconds())
                );
            })->catch(function (Batch $batch, Throwable $e) {
                Log::error($e->getMessage());
            })
            ->onQueue('command')
            ->dispatch();
        $this->info(
            sprintf(
                "AddOrderTags: Batch ID %s dispatched.",
                $batch->id
            )
        );

        return self::SUCCESS;
    }
}
