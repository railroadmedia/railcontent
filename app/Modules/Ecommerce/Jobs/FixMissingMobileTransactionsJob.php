<?php

namespace App\Modules\Ecommerce\Jobs;


use App\Console\Commands\Infrastructure\Timer;
use App\Modules\Ecommerce\ApiGateways\ShopifyGateway;
use App\Modules\Ecommerce\Services\ShopifyCancelService;
use App\Modules\Ecommerce\Services\ShopifyRefundService;
use App\Modules\Ecommerce\Services\ShopifySyncService;
use Carbon\Carbon;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Log;
use Signifly\Shopify\Shopify;

class FixMissingMobileTransactionsJob implements ShouldQueue
{
    use Batchable;
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    private Carbon $startDate;
    private Carbon $endDate;
    private string $endCursor;
    private int $totalProcessed;

    public function __construct(
        Carbon $startDate,
        Carbon $endDate,
        string $endCursor = '',
        int $totalProcessed = 0
    ) {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->endCursor = $endCursor;
        $this->totalProcessed = $totalProcessed;
    }

    public function handle(
        ShopifyGateway $shopifyGateway,
        Shopify $shopify,
        ShopifySyncService $shopifySyncService,
        ShopifyCancelService $shopifyCancelService
    ): void {
        $className = get_class($this);
        if (!$this->endCursor) {
            Log::info("$className: Start Processing");
        }
        $endCursor = $this->endCursor;
        $break = false;
        do {
            Timer::afterSeconds(120, function () use (&$break) {
                $break = true;
            });
            if ($break) {
                break;
            }
            $orders = $shopifyGateway->getOrdersBetween(
                $this->startDate,
                $this->endDate,
                10,
                ' AND (tag:Apple OR tag:Google)',
                ',transactions{id},totalPriceSet{shopMoney{amount}},cancelledAt',
                $endCursor
            );

            foreach ($orders as $order) {
                $orderId = str_replace('gid://shopify/Order/', '', $order->id);
                Log::info("Processing Order ID: $orderId");

                if (!$order->transactions) {
                    Log::info("Order ID: $orderId has no transactions");
                    $amount = $order->totalPriceSet->shopMoney->amount;
                    if ($order->cancelledAt != null) {
                        Log::info("Order ID: $orderId is cancelled");
                        //Do nothing for cancelled orders because adding the transaction and revoking it will add a bunch of refunds for whenever we processed this
                        //$shopifyCancelService->cancelOrder($orderId);
                    } else {
                        $shopifySyncService->createShopifyOrderTransaction($orderId, $amount);
                    }
                    $this->totalProcessed++;
                } else {
                    Log::info("Order ID: $orderId has transactions");
                }
            }
        } while ($endCursor);

        if ($break) {
            Log::info("$className: Processed $this->totalProcessed/??, triggering new job");
            dispatch(
                new FixMissingMobileTransactionsJob(
                    $this->startDate,
                    $this->endDate,
                    $endCursor,
                    $this->totalProcessed
                )
            );
        } else {
            Log::info("$className: Finished processing ($this->totalProcessed/$this->totalProcessed)");
        }
    }
}
