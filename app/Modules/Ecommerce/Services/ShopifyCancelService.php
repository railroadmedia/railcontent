<?php

namespace App\Modules\Ecommerce\Services;

use App\Modules\Ecommerce\Jobs\Shopify\Traits\HandlesShopifyRateLimit;
use Signifly\Shopify\REST\Resources\OrderResource;
use Signifly\Shopify\Shopify;

class ShopifyCancelService
{
    use HandlesShopifyRateLimit;

    private ShopifyRefundService $shopifyRefundService;

    public function __construct(
        Shopify $shopify,
        ShopifyRefundService $shopifyRefundService
    ) {
        $this->shopify = $shopify;
        $this->shopifyRefundService = $shopifyRefundService;
    }

    public function cancelOrder(int $shopifyOrderId): void
    {
        $orderResource = $this->shopify->getOrder($shopifyOrderId);
        $this->handleRateLimit();
        $this->cancelOrderResource($orderResource);
    }

    public function cancelOrderResource(OrderResource $orderResource): void
    {
        $orderShopifyAttributes = $orderResource->getAttributes();
        if ($orderShopifyAttributes["cancelled_at"]) {
            return;
        }

        $shopifyOrderId = $orderShopifyAttributes["id"];

        // DEV NOTE: from testing this process, we'll most likely be in a situation where the order cannot be
        // cancelled, and we'd get the error "Cannot cancel a paid and fulfilled order". So first check if the
        // order is paid and/or fulfilled, and undo each of those
        if ($orderShopifyAttributes["fulfillment_status"] === "fulfilled") {
            $fulfillmentsData = $orderShopifyAttributes["fulfillments"];
            $this->cancelFulfillments($fulfillmentsData, $shopifyOrderId);
        }
        if ($orderShopifyAttributes["financial_status"] === "paid") {
            $this->shopifyRefundService->refundAllTransactions($orderShopifyAttributes, $shopifyOrderId);
        }
        $this->shopify->cancelOrder($shopifyOrderId);
        $this->handleRateLimit();
    }

    /**
     * Cancel all fulfillments in Shopify, in the given fulfillments data retrieved from Shopify through getOrder
     *
     * @param array $fulfillmentsData
     * @return void
     */
    private function cancelFulfillments(array $fulfillmentsData): void
    {
        foreach ($fulfillmentsData as $fulfillmentData) {
            if ($fulfillmentData["status"] === "success") {
                $fulfillmentId = $fulfillmentData["id"];
                if (!$this->getIsSimulation()) {
                    $this->shopify->cancelFulfillment($fulfillmentId);
                    $this->handleRateLimit();
                }
            }
        }
    }

    /**
     * @inheritDoc
     */
    protected function getIsSimulation(): bool
    {
        return false;
    }

    protected function getClassName(): string
    {
        return "ShopifyCancelService";
    }
}
