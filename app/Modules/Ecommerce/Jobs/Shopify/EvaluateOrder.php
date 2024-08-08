<?php

namespace App\Modules\Ecommerce\Jobs\Shopify;

use App\Modules\Ecommerce\Jobs\Shopify\Traits\HandlesShopifyRateLimit;
use App\Modules\Ecommerce\Models\Shopify\Rest\Customer;
use App\Modules\Ecommerce\Models\Shopify\Rest\Order;
use App\Modules\Ecommerce\Models\Shopify\ShopifyOrderFix;
use App\Modules\Ecommerce\Services\PaymentService;
use Exception;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\Middleware\SkipIfBatchCancelled;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Signifly\Shopify\Shopify;

class EvaluateOrder implements ShouldQueue
{
    use Batchable;
    use Dispatchable;
    use HandlesShopifyRateLimit;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public int $tries = 5;
    public int $timeout = 840;
    protected Shopify $shopify;
    protected PaymentService $paymentService;
    protected ?Customer $customer;

    public function middleware(): array
    {
        return [new SkipIfBatchCancelled()];
    }

    public function __construct(
        protected Order $order
    ) {
        $this->customer = $order->customer;
    }

    public function handle(Shopify $shopify, PaymentService $paymentService): void
    {
        // set DI instances that we'll need
        $this->shopify = $shopify;
        $this->paymentService = $paymentService;

        try {
            $ecommerceModel = $this->order->getEcommerceModel();
            $this->handleRateLimit();
            $truePaymentAmount = $this->paymentService->getTotalPaid($ecommerceModel);
            $action = $this->getActionToTake($truePaymentAmount);
            $note = null;
        } catch (Exception $e) {
            // DEV NOTE: after running this in production, we would occasionally get a 503 response code from Shopify
            // (seemingly when attempting to get the metafields). This just means that Shopify's server is temporarily
            // unavailable and we should retry. So check for that, and retry if it happens.
            if (Str::startsWith($e->getMessage(), 'HTTP request returned status code 503')) {
                Log::debug(sprintf('%s: %s', $this->getClassName(), $e->getMessage()));
                $this->release(1);
                return;
            } else {
                Log::error(sprintf('%s: %s', $this->getClassName(), $e->getMessage()));
                $truePaymentAmount = 0;
                $action = ShopifyOrderFix::ACTION_FAILURE;
                $ecommerceModel = null;
                $note = $e->getMessage();
            }
        }

        $fix = new ShopifyOrderFix([
            'original_shopify_order_id' => $this->order->id,
            'shopify_order_price' => $this->order->currentTotalPrice,
            'shopify_order_currency' => $this->order->currency,
            'true_payment_amount' => $truePaymentAmount,
            'action_taken' => $action,
            'status' => ShopifyOrderFix::STATUS_EVALUATED,
            'notes' => $note,
            'processed_at' => $this->order->processedAt,
            'order_total_usd' => $action === ShopifyOrderFix::ACTION_MATCHED ? $this->order->currentTotalPrice : $truePaymentAmount,
        ]);
        if ($ecommerceModel) {
            $fix->ecommerceModelable()->associate($ecommerceModel);
            $fix->save();
        }
    }

    private function getActionToTake(float $truePaymentAmount): string
    {
        // safety check: our store is set for USD, so we won't spend the effort to perform a conversion.
        // Just log an error here if for some reason the order's currency code is not USD
        if ($this->order->currencyCode !== 'USD') {
            Log::error(
                sprintf(
                    '%s: Order %s has currency code of %s',
                    $this->getClassName(),
                    $this->order->id,
                    $this->order->currencyCode
                )
            );
            return ShopifyOrderFix::ACTION_FAILURE;
        }

        // allow for a 2% variance
        $acceptableDiff = $truePaymentAmount * 0.02;

        if (abs($this->order->currentTotalPrice - $truePaymentAmount) > $acceptableDiff) {
            return ShopifyOrderFix::ACTION_REPLACED;
        }
        return ShopifyOrderFix::ACTION_MATCHED;
    }

    /**
     * Add extra logging in case of job failure
     *
     * @param  Exception  $exception
     * @return void
     */
    public function failed(Exception $exception): void
    {
        Log::error('Job failed', [
            'class' => $this->getClassName(),
            'shopifyId' => $this->order->id,
            'retryCount' => $this->attempts(),
            'maxTries' => $this->tries,
            'timeout' => $this->timeout,
            'exception' => $exception->getMessage(),
        ]);
    }

    /**
     * @inheritDoc
     */
    protected function getClassName(): string
    {
        return class_basename(__CLASS__);
    }

    /**
     * @inheritDoc
     */
    protected function getIsSimulation(): bool
    {
        return false;
    }
}
