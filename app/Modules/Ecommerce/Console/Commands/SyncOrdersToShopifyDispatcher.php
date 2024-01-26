<?php

namespace App\Modules\Ecommerce\Console\Commands;

use App\Models\ShopifySync;
use App\Modules\Ecommerce\Jobs\Shopify\SyncOrdersToShopifyJobManager;
use App\Modules\Ecommerce\Models\Order;
use Carbon\Carbon;
use Illuminate\Bus\Batch;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Builder;
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
                            {--since= : (Optional) The ISO 8601 date time to sync all changes since. e.g. 2023-10-13T17:03:25+00:00}
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
    public function handle(): int {
        $simulate = $this->option("execute") == false;
        $fresh = $this->option("fresh");
        $startingId = $this->option("startingId");
        $limit = $this->option("limit");

        $lastSyncAt = $this->getDateTimeOfLastSync();

        // find all orders that need to be synced
        $orders = Order::query()
            ->when(!is_null($startingId), function (Builder $q) use ($startingId) {
                return $q->where("id", ">=", $startingId);
            })
            ->where(function (Builder $q) use ($lastSyncAt, $fresh) {
                $q->when(!$fresh, function (Builder $q) use ($lastSyncAt) {
                    return $q->whereDate("updated_at", ">", $lastSyncAt)

                        // we also need to check if any of the order's order items or order item fulfillments need to be synced
                        ->orWhereHas("orderItems", function (Builder $oiq) use ($lastSyncAt) {
                            $oiq->whereDate("updated_at", ">", $lastSyncAt);
                        })
                        ->orWhereHas("orderItemFulfillments", function (Builder $oifq) use ($lastSyncAt) {
                            $oifq->whereDate("updated_at", ">", $lastSyncAt);
                        });
                });
            })
            ->select("id");
        $orderCount = $orders->count();
        $batchSize = 500;
        $jobs = [];

        $this->info("SyncOrdersToShopify: Preparing to chunk orders into jobs for SyncOrdersToShopifyJobManager. Please wait...");
        $startAt = Carbon::now();
        if ($limit) {
            $orderCount = min($limit, $orderCount);
            // chunk doesn't use a limit set in the query, so we'll work around that by keeping track of the count internally
            $isAtLimit = false;
            $tally = 0;
            $orders->chunk(
                $batchSize,
                function ($orderIds) use (
                    $lastSyncAt,
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

                    $firstOrderId = $orderIds->first()->id;
                    $lastOrderId = $orderIds->last()->id;
                    $jobs[] = new SyncOrdersToShopifyJobManager(
                        $firstOrderId,
                        $lastOrderId,
                        $lastSyncAt,
                        $simulate,
                        $fresh
                    );
                }
            );
        } else {
            // step through the chunks of order ids to sync, and add a job to process each chunk
            $orders->chunk($batchSize, function ($orderIds) use ($lastSyncAt, $simulate, $fresh, &$jobs) {
                $firstOrderId = $orderIds->first()->id;
                $lastOrderId = $orderIds->last()->id;
                $jobs[] = new SyncOrdersToShopifyJobManager(
                    $firstOrderId,
                    $lastOrderId,
                    $lastSyncAt,
                    $simulate,
                    $fresh
                );
            });
        }
        $this->info(sprintf("SyncOrdersToShopify: Completed chunking orders into jobs for SyncOrdersToShopifyJobManager in %s seconds.",
            $startAt->diffInSeconds()));

        $startAt = Carbon::now();
        $batch = Bus::batch($jobs)
            ->then(function (Batch $batch) use ($startAt) {
                Log::info(sprintf("SyncOrdersToShopify: Completed in %s seconds", $startAt->diffInSeconds()));
            })->catch(function (Batch $batch, Throwable $e) {
                Log::error($e->getMessage());
            })
            ->onQueue('command')
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

    /**
     * Get the date and time that orders were last synced up to Shopify
     *
     * @return Carbon
     */
    protected function getDateTimeOfLastSync(): Carbon
    {
        $override = $this->getLastSyncAtOverride();
        if (!is_null($override)) {
            return $override;
        }

        $sync = ShopifySync::where("resource", ShopifySync::RESOURCE_ORDER)->latestFinished()->first();
        return $sync?->finished_at ?? Carbon::createFromTimestamp(0);
    }

    /**
     * Get the optional override of when this entity was last synced to Shopify
     *
     * @return Carbon|null
     */
    protected function getLastSyncAtOverride(): null|Carbon
    {
        $override = $this->option("since");
        if (!is_null($override)) {
            return new Carbon($override);
        }
        return null;
    }
}
