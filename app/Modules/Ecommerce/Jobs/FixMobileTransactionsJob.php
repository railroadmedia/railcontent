<?php

namespace App\Modules\Ecommerce\Jobs;


use App\Console\Commands\Infrastructure\Timer;
use App\Modules\Ecommerce\ApiGateways\ShopifyGateway;
use App\Modules\Ecommerce\Enums\ShopifyPaymentSourceEnum;
use App\Modules\Ecommerce\Jobs\Shopify\Traits\HandlesMaskedEmailAddress;
use App\Modules\Ecommerce\Services\ProductService;
use App\Modules\Ecommerce\Services\ShopifyDeleteService;
use App\Modules\Ecommerce\Services\ShopifySyncService;
use App\Modules\UserManagementSystem\Services\UserService;
use Carbon\Carbon;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Log;

class FixMobileTransactionsJob implements ShouldQueue
{
    use HandlesMaskedEmailAddress;
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
        ShopifySyncService $shopifySyncService,
        UserService $userService,
        ProductService $productService,
        ShopifyDeleteService $shopifyDeleteService

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
                ",email,transactions{id,processedAt},subtotalPriceSet{shopMoney{amount}}, totalPriceSet{shopMoney{amount}}
                ,cancelledAt,processedAt,currencyCode,metafields(first:10){edges{node{namespace,value,key}}}
                ,lineItems(first:10){edges{node{id,title,quantity,variant{title,sku}}}}",
                $endCursor
            );

            foreach ($orders as $order) {
                $orderId = str_replace('gid://shopify/Order/', '', $order->id);
                Log::info("Processing Order ID: $orderId");

                try {
                    if ($order->subtotalPriceSet->shopMoney->amount != $order->totalPriceSet->shopMoney->amount) {
                        Log::info("Order ID: $orderId has a different subtotal and total price");
                    }
                    if ($order->transactions && !$order->cancelledAt) {
                        $hours = Carbon::parse($order->transactions[0]->processedAt)->diffInHours(
                            Carbon::parse($order->processedAt)
                        );

                        if ($hours > 1) { //anything within an hour is fine for metrics
                            Log::info(
                                "Order ID: $orderId has a transaction that is more than 1 hour apart from the order processedAt time"
                            );
                            $email = $this->getEmailFromShopify($order->email);
                            $user = $userService->getByEmailOrNull($email);

                            foreach ($order->metafields->edges as $metafield) {
                                if ($metafield->node->key === 'brand') {
                                    $brand = $metafield->node->value;
                                } elseif ($metafield->node->key === 'payment_source') {
                                    $paymentSource = ShopifyPaymentSourceEnum::tryFrom($metafield->node->value);
                                }
                            }

                            $sku = $order->lineItems->edges[0]->node->variant->sku;
                            $productsIds = [$productService->getBySku($sku)->id];
                            $processedAt = Carbon::parse($order->processedAt);

                            $price = $order->subtotalPriceSet->shopMoney->amount;
                            $tax = $order->totalPriceSet->shopMoney->amount - $price;
                            $currency = $order->currencyCode;

                            $shopifySyncService->syncOrder(
                                $user,
                                $productsIds,
                                $brand,
                                $processedAt,
                                $price,
                                $tax,
                                $paymentSource,
                                $currency
                            );

                            $shopifyDeleteService->deleteOrder($orderId);
                            $shopifySyncService->syncCustomerByUser($user, removeDeletedOrderPermissions: true);
                        }
                    }
                } catch (\Exception $e) {
                    Log::error("Order ID: $orderId failed to process");
                    Log::error($e);
                }
            }
        } while ($endCursor);

        if ($break) {
            Log::info("$className: Processed $this->totalProcessed/??, triggering new job");
            $this->batch()->add(
                new FixMobileTransactionsJob(
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
