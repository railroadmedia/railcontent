<?php

namespace App\Modules\Ecommerce\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\Ecommerce\Jobs\Shopify\CancelDuplicateSubscriptionPaymentOrders;
use App\Modules\Ecommerce\Models\SubscriptionPayment;
use Carbon\Carbon;
use Illuminate\Bus\Batch;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Throwable;

class CancelDuplicateSubscriptionPaymentOrdersInShopifyDispatcher extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'shopify:cancel-duplicate-subscription-payments-orders
                            {--limit= : (Optional) The number of payment IDs to limit this run to.}
                            {--execute : Execute this operation to Shopify. Without this flag, it will be simulated.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cancel and delete orders in Shopify that were created by duplicate subscription payments';

    /**
     * Execute the console command.
     *
     * @throws Throwable
     */
    public function handle(): int
    {
        $simulate = $this->option("execute") == false;
        $limit = $this->option("limit");

        // find all duplicate entries
        $subscriptionPayments = SubscriptionPayment::query()
            ->selectRaw("payment_id, count(payment_id) as `count`")
            ->whereNotNull("shopify_id")
            ->groupBy("payment_id")
            ->having("count", ">", 1)
            ->orderBy("payment_id");

        $paymentsCount = $subscriptionPayments->count();
        $batchSize = 25;
        $jobs = [];

        if ($limit) {
            $paymentsCount = min($limit, $paymentsCount);
            // chunk doesn't use a limit set in the query, so we'll work around that by keeping track of the count internally
            $isAtLimit = false;
            $tally = 0;
            $subscriptionPayments->chunk(
                $batchSize,
                function ($subscriptionPaymentData, $batchIndex) use (
                    $limit,
                    &$isAtLimit,
                    $batchSize,
                    $simulate,
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
                        $subscriptionPaymentData = $subscriptionPaymentData->take($toGet);
                    }

                    $paymentIds = $subscriptionPaymentData->transform(fn ($data) => $data->payment_id)->toArray();
                    $jobs[] = new CancelDuplicateSubscriptionPaymentOrders(
                        $paymentIds,
                        $simulate,
                        $batchIndex
                    );
                }
            );
        } else {
            // step through the chunks of subscription payment ids, and add a job to process each chunk
            $subscriptionPayments->chunk(
                $batchSize,
                function ($subscriptionPaymentData, $batchIndex) use ($simulate, &$jobs) {
                    $paymentIds = $subscriptionPaymentData->transform(fn ($data) => $data->payment_id)->toArray();
                    $jobs[] = new CancelDuplicateSubscriptionPaymentOrders(
                        $paymentIds,
                        $simulate,
                        $batchIndex
                    );
                }
            );
        }
        $startAt = Carbon::now();
        $batch = Bus::batch($jobs)
            ->then(function (Batch $batch) use ($startAt) {
                Log::info(
                    sprintf(
                        "CancelDuplicateSubscriptionPaymentOrders: completed in %s seconds",
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
                "CancelDuplicateSubscriptionPaymentOrdersInShopifyDispatcher: Batch ID %s dispatched with %s %s to cancel orders for %s %s.",
                $batch->id,
                $batch->totalJobs,
                Str::plural("job", $batch->totalJobs),
                $paymentsCount,
                Str::plural("payment", $paymentsCount)
            )
        );

        return self::SUCCESS;
    }
}
