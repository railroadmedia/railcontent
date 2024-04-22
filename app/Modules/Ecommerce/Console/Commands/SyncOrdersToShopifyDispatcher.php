<?php

namespace App\Modules\Ecommerce\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\Ecommerce\Jobs\Shopify\SyncOrdersToShopifyJobManager;
use App\Modules\Ecommerce\Models\Order;
use Carbon\Carbon;
use Illuminate\Bus\Batch;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Throwable;

class SyncOrdersToShopifyDispatcher extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'shopify:sync-orders
                            {--startingId= : (Optional) The order Id to start processing at}
                            {--limit= : (Optional) The number of order to limit this run to}
                            {--startCreatedAt= : (Optional) The ISO 8601 date time for all ecommerce_orders to get where the created_at is at or after. e.g. 2023-10-13T17:00:25+00:00}
                            {--endCreatedAt= : (Optional) The ISO 8601 date time for all  ecommerce_orders to get where the created_at is at or before. e.g. 2023-10-13T17:30:14+00:00}
                            {--fresh : Sync all orders, not just those that need it}
                            {--execute : Execute this sync to Shopify. Without this flag, it will be simulated.}';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync our orders up to Shopify';

    /**
     * Execute the console command.
     *
     * @return int
     * @throws Throwable
     */
    public function handle(): int
    {
        $simulate = $this->option("execute") == false;
        $fresh = $this->option("fresh");
        $startingId = $this->option("startingId");
        $limit = $this->option("limit");

        $startCreatedAt = new Carbon($this->option("startCreatedAt") ?: '1970-01-01T00:00:00Z');
        $endCreatedAt = new Carbon($this->option("endCreatedAt") ?: config('ecommerce.launch_date_times.shopify'));

        // find all orders that need to be synced
        $orders = Order::toSyncWithShopify(
            startingId: $startingId,
            fresh: $fresh,
            startCreatedAt: $startCreatedAt,
            endCreatedAt: $endCreatedAt
        )
            ->select("id");

        $orderCount = $orders->count();
        $batchSize = 500;
        $jobs = [];

        $this->info(
            "SyncOrdersToShopify: Preparing to chunk orders into jobs for SyncOrdersToShopifyJobManager. Please wait..."
        );
        $startAt = Carbon::now();
        if ($limit) {
            $orderCount = min($limit, $orderCount);
            // chunk doesn't use a limit set in the query, so we'll work around that by keeping track of the count internally
            $isAtLimit = false;
            $tally = 0;
            $orders->chunk(
                $batchSize,
                function ($orderIds) use (
                    $endCreatedAt,
                    $startCreatedAt,
                    $limit,
                    &$isAtLimit,
                    $batchSize,
                    $simulate,
                    $fresh,
                    &$jobs,
                    &$tally
                ) {
                    if ($isAtLimit) {
                        return false;
                    }

                    $tally += $batchSize;
                    $remaining = $limit - $tally;
                    if ($remaining <= 0) {
                        $isAtLimit = true;
                        $toGet = $tally + $remaining;
                        $orderIds = $orderIds->take($toGet);
                    }

                    $jobs[] = new SyncOrdersToShopifyJobManager(
                        $orderIds->first()->id,
                        $orderIds->last()->id,
                        $startCreatedAt,
                        $endCreatedAt,
                        $simulate,
                        $fresh
                    );
                }
            );
        } else {
            // step through the chunks of order ids to sync, and add a job to process each chunk
            $orders->chunk(
                $batchSize,
                function ($orderIds) use ($endCreatedAt, $startCreatedAt, $simulate, $fresh, &$jobs) {
                    $jobs[] = new SyncOrdersToShopifyJobManager(
                        $orderIds->first()->id,
                        $orderIds->last()->id,
                        $startCreatedAt,
                        $endCreatedAt,
                        $simulate,
                        $fresh
                    );
                }
            );
        }
        $this->info(
            sprintf(
                "SyncOrdersToShopify: Completed chunking orders into jobs for SyncOrdersToShopifyJobManager in %s seconds.",
                $startAt->diffInSeconds()
            )
        );

        $startAt = Carbon::now();
        $batch = Bus::batch($jobs)
            ->then(function (Batch $batch) use ($startAt) {
                Log::info(sprintf("SyncOrdersToShopify: Completed in %s seconds", $startAt->diffInSeconds()));
            })->catch(function (Batch $batch, Throwable $e) {
                Log::error($e->getMessage());
            })
            ->onQueue('command-two')
            ->dispatch();
        $this->info(
            sprintf(
                "SyncOrdersToShopify: Batch ID %s dispatched with %s %s to sync %s %s.",
                $batch->id,
                $batch->totalJobs,
                Str::plural("job", $batch->totalJobs),
                $orderCount,
                Str::plural("order", $orderCount)
            )
        );

        return self::SUCCESS;
    }
}
