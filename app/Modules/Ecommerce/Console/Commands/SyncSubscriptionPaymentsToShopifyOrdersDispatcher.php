<?php

namespace App\Modules\Ecommerce\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\Ecommerce\Jobs\Shopify\SyncSubscriptionPaymentsToShopifyOrdersJobManager;
use App\Modules\Ecommerce\Models\SubscriptionPayment;
use Carbon\Carbon;
use Illuminate\Bus\Batch;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Throwable;

class SyncSubscriptionPaymentsToShopifyOrdersDispatcher extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'shopify:sync-subscription-payments
                            {--startingId= : (Optional) The SubscriptionPayment Id to start processing at}
                            {--limit= : (Optional) The number of subscription payments to limit this run to}
                            {--startCreatedAt= : (Optional) The ISO 8601 date time for all ecommerce_subscription_payments to get where the created_at is at or after. e.g. 2023-10-13T17:00:25+00:00}
                            {--endCreatedAt= : (Optional) The ISO 8601 date time for all  ecommerce_subscription_payments to get where the created_at is at or before. e.g. 2023-10-13T17:30:14+00:00}
                            {--fresh : Sync all subscription payments, not just those that need it}
                            {--execute : Execute this sync to Shopify. Without this flag, it will be simulated.}';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync our subscription payments up to Shopify as orders';

    /**
     * Execute the console command.
     *
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

        // find all subscription payments that need to be synced
        $subscriptionPayments = SubscriptionPayment::toSyncWithShopify(
            startingId: $startingId,
            fresh: $fresh,
            startCreatedAt: $startCreatedAt,
            endCreatedAt: $endCreatedAt
        )
            ->select("id");

        $subscriptionPaymentsCount = $subscriptionPayments->count();
        $batchSize = 500;
        $jobs = [];

        $this->info(
            "SyncSubscriptionPaymentsToShopifyOrders: Preparing to chunk subscription payments into jobs for SyncSubscriptionPaymentsToShopifyOrders. Please wait..."
        );

        $startAt = Carbon::now();
        if ($limit) {
            $subscriptionPaymentsCount = min($limit, $subscriptionPaymentsCount);
            // chunk doesn't use a limit set in the query, so we'll work around that by keeping track of the count internally
            $isAtLimit = false;
            $tally = 0;
            $subscriptionPayments->chunk(
                $batchSize,
                function ($subscriptionPaymentIds) use (
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
                        $subscriptionPaymentIds = $subscriptionPaymentIds->take($toGet);
                    }

                    $jobs[] = new SyncSubscriptionPaymentsToShopifyOrdersJobManager(
                        $subscriptionPaymentIds->first()->id,
                        $subscriptionPaymentIds->last()->id,
                        $startCreatedAt,
                        $endCreatedAt,
                        $simulate,
                        $fresh
                    );
                }
            );
        } else {
            // step through the chunks of order ids to sync, and add a job to process each chunk
            $subscriptionPayments->chunk(
                $batchSize,
                function ($subscriptionPaymentIds) use ($startCreatedAt, $endCreatedAt, $simulate, $fresh, &$jobs) {
                    $jobs[] = new SyncSubscriptionPaymentsToShopifyOrdersJobManager(
                        $subscriptionPaymentIds->first()->id,
                        $subscriptionPaymentIds->last()->id,
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
                "SyncSubscriptionPaymentsToShopifyOrders: Completed chunking subscription payments into jobs for ".
                "SyncSubscriptionPaymentsToShopifyOrdersJobManager in %s seconds.",
                $startAt->diffInSeconds()
            )
        );

        $startAt = Carbon::now();
        $batch = Bus::batch($jobs)
            ->then(function (Batch $batch) use ($startAt) {
                Log::info(
                    sprintf(
                        "SyncSubscriptionPaymentsToShopifyOrders: Completed in %s seconds",
                        $startAt->diffInSeconds()
                    )
                );
            })->catch(function (Batch $batch, Throwable $e) {
                Log::error($e->getMessage());
            })
            ->onQueue('command-two')
            ->dispatch();
        $this->info(
            sprintf(
                "SyncSubscriptionPaymentsToShopifyOrders: Batch ID %s dispatched with %s %s to sync %s %s.",
                $batch->id,
                $batch->totalJobs,
                Str::plural("job", $batch->totalJobs),
                $subscriptionPaymentsCount,
                Str::plural("subscription payment", $subscriptionPaymentsCount)
            )
        );

        return self::SUCCESS;
    }
}
