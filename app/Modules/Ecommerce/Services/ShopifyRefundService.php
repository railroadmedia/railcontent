<?php

namespace App\Modules\Ecommerce\Services;

use App\Modules\Ecommerce\Jobs\Shopify\Traits\HandlesShopifyRateLimit;
use Signifly\Shopify\Shopify;

class ShopifyRefundService
{
    use HandlesShopifyRateLimit;

    public function __construct(
        Shopify $shopify,
    ) {
        $this->shopify = $shopify;
    }

    public function refundAllTransactions(
        array $orderData,
        int $orderShopifyId
    ): void {
        // 1. orders are automatically closed (or "archived", as it's also called), and refunds cannot be issued to
        // closed orders. So before we issue any, we need to check the status, and reopen the order, if it's closed
        $wasReopened = false;

        if ($orderData["closed_at"]) {
            if (!$this->getIsSimulation()) {
                $this->shopify->openOrder($orderShopifyId);
                $this->handleRateLimit();
            }
            $wasReopened = true;
        }

        // 2. use the calculate endpoint to initiate the process
        $currency = $orderData["currency"];
        $calculateResponse = $this->shopify->calculateOrderRefund(
            $orderShopifyId,
            [
                "currency" => $currency
            ]
        );
        $this->handleRateLimit();

        // 3. we can now make the actual refund for each transaction (though there should be only one)
        $transactionsToRefund = $calculateResponse->getAttributes()["transactions"];
        foreach ($transactionsToRefund as $transactionData) {
            $refundData = [
                "currency" => $currency,
                "notify" => false,
                "transactions" => [
                    [
                        "parent_id" => $transactionData["parent_id"],
                        "amount" => $transactionData["maximum_refundable"],
                        "kind" => "refund"
                    ]
                ],
                "note" => ""
            ];


            if (!$this->getIsSimulation()) {
                $this->shopify->createOrderRefund($orderShopifyId, $refundData);
                $this->handleRateLimit();
            }
        }

        // 4. if we had to reopen the order, we need to close it again
        if ($wasReopened && !$this->getIsSimulation()) {
            $this->shopify->closeOrder($orderShopifyId);
            $this->handleRateLimit();
        }
    }

    protected function getIsSimulation(): bool
    {
        return false;
    }

    protected function getClassName(): string
    {
        return "ShopifyRefundService";
    }
}
