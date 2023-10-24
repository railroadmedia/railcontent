<?php

namespace App\Modules\Ecommerce\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Models\ShopifySync;
use App\Modules\Ecommerce\Jobs\Shopify\SyncSubscriptionPaymentsToShopifyOrdersJobManager;
use App\Modules\Ecommerce\Models\Payment;
use App\Modules\Ecommerce\Models\SubscriptionPayment;
use Carbon\Carbon;
use Illuminate\Bus\Batch;
use Illuminate\Database\Eloquent\Builder;
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
                            {--since= : (Optional) The ISO 8601 date time to sync all changes since. e.g. 2023-10-13T17:03:25+00:00}
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
     * @return int
     * @throws Throwable
     */
    public function handle(): int
    {
        $simulate = $this->option("execute") == false;
        $fresh = $this->option("fresh");
        $startingId = $this->option("startingId");
        $limit = $this->option("limit");

        $lastSyncAt = $this->getDateTimeOfLastSync();

        // find all subscription payments that need to be synced
        $subscriptionPayments = SubscriptionPayment::query()
            ->when(!is_null($startingId), function (Builder $q) use ($startingId) {
                return $q->where("id", ">=", $startingId);
            })
            ->where(function (Builder $q) use ($lastSyncAt, $fresh) {
                $q->when(!$fresh, function (Builder $q) use ($lastSyncAt) {
                    return $q->whereNull("shopify_id")
                        ->orWhereDate("updated_at", ">", $lastSyncAt);
                });
            })
            ->whereIn("payment_id", function ($query) {
                $query->select("id")
                    ->from("ecommerce_payments")
                    ->where("status", Payment::STATUS_PAID)
                    ->whereNot("type", Payment::TYPE_INITIAL_ORDER);
            })
            ->select("id");
        $subscriptionPaymentsCount = $subscriptionPayments->count();
        $batchSize = 500;
        $jobs = [];

        $this->info(
            "SyncSubscriptionPaymentsToShopifyOrders: Preparing to chunk orders into jobs for SyncSubscriptionPaymentsToShopifyOrders. Please wait..."
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
                        $subscriptionPaymentIds = $subscriptionPaymentIds->take($toGet);
                    }

                    $firstSubscriptionPaymentId = $subscriptionPaymentIds->first()->id;
                    $lastSubscriptionPaymentId = $subscriptionPaymentIds->last()->id;
                    $jobs[] = new SyncSubscriptionPaymentsToShopifyOrdersJobManager(
                        $firstSubscriptionPaymentId,
                        $lastSubscriptionPaymentId,
                        $lastSyncAt,
                        $simulate,
                        $fresh
                    );
                }
            );
        } else {
            // step through the chunks of order ids to sync, and add a job to process each chunk
            $subscriptionPayments->chunk(
                $batchSize,
                function ($subscriptionPaymentIds) use ($lastSyncAt, $simulate, $fresh, &$jobs) {
                    $firstSubscriptionPaymentId = $subscriptionPaymentIds->first()->id;
                    $lastSubscriptionPaymentId = $subscriptionPaymentIds->last()->id;
                    $jobs[] = new SyncSubscriptionPaymentsToShopifyOrdersJobManager(
                        $firstSubscriptionPaymentId,
                        $lastSubscriptionPaymentId,
                        $lastSyncAt,
                        $simulate,
                        $fresh
                    );
                }
            );
        }
        $this->info(
            sprintf(
                "SyncSubscriptionPaymentsToShopifyOrders: Completed chunking orders into jobs for ".
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
            ->onQueue('command')
            ->dispatch();
        $this->info(
            sprintf(
                "SyncSubscriptionPaymentsToShopifyOrders: Batch ID %s dispatched with %s %s to sync %s %s.",
                $batch->id,
                $batch->totalJobs,
                Str::plural("job", $batch->totalJobs),
                $subscriptionPaymentsCount,
                Str::plural("order", $subscriptionPaymentsCount)
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

        $sync = ShopifySync::where("resource", ShopifySync::RESOURCE_SUBSCRIPTION_PAYMENT)->latestFinished()->first();
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
