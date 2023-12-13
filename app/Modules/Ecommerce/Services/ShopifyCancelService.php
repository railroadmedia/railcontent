<?php

namespace App\Modules\Ecommerce\Services;

use App\Modules\Content\Services\ContentPermissionsService;
use App\Modules\Ecommerce\Enums\UserAccessPermissionsStatusEnum;
use App\Modules\Ecommerce\Models\SubscriptionPayment;
use App\Modules\Ecommerce\Models\UserAccessPermission;
use Illuminate\Support\Collection;
use Signifly\Shopify\Exceptions\NotFoundException;
use Signifly\Shopify\Shopify;

class ShopifyCancelService
{

    private Shopify $shopify;
    private ContentPermissionsService $contentPermissionsService;

    private Collection $contentPermissionLookup;
    public function __construct(
        Shopify $shopify,
        ContentPermissionsService $contentPermissionsService
    ) {
        $this->shopify = $shopify;
        $this->contentPermissionsService = $contentPermissionsService;
        $this->contentPermissionsLookup = $contentPermissionsService->getContentPermissionsLookup();
    }

    public function cancelSubscriptionPaymentOrder(SubscriptionPayment $subscriptionPayment): void
    {
        $orderShopifyAttributes = $this->shopify->getOrder($subscriptionPayment->shopify_id)->getAttributes();
        if ($orderShopifyAttributes["cancelled_at"]) {
            return;
        }

        $shopifyOrderId = $orderShopifyAttributes["id"];

        // DEV NOTE: from testing this process, we'll most likely be in a situation where the order cannot be
        // cancelled, and we'd get the error "Cannot cancel a paid and fulfilled order". So first check if the
        // order is paid and/or fulfilled, and undo each of those
        if ($orderShopifyAttributes["fulfillment_status"] === "fulfilled") {
            $fulfillmentsData = $orderShopifyAttributes["fulfillments"];
            $this->cancelFulfillments($fulfillmentsData, $shopifyOrderId, $subscriptionPayment->payment_id);
        }

        if ($orderShopifyAttributes["financial_status"] === "paid") {
            $this->refundPayments(
                $orderShopifyAttributes,
                $shopifyOrderId,
                $subscriptionPayment->payment_id,
                $subscriptionPayment->id
            );
        }

        if (!$this->getIsSimulation()) {
            $cancelResults = $this->shopify->cancelOrder($shopifyOrderId);
        }

        // we need to remove the permissions from the order
        $this->deleteUserAccessPermissions($subscriptionPayment, $orderShopifyAttributes);

        // now that we've cancelled the order, it can also be deleted
        $this->deleteOrder($shopifyOrderId);
    }

    /**
     * Cancel all fulfillments in Shopify, in the given fulfillments data retrieved from Shopify through getOrder
     *
     * @param array $fulfillmentsData
     * @param int $shopifyOrderId
     * @param int $paymentId
     * @return void
     */
    private function cancelFulfillments(array $fulfillmentsData, int $shopifyOrderId, int $paymentId): void
    {
        foreach ($fulfillmentsData as $fulfillmentData) {
            if ($fulfillmentData["status"] === "success") {
                $fulfillmentId = $fulfillmentData["id"];
                /*
                $this->logDebug(
                    sprintf(
                        "%s: About to cancel fulfillment %s on order %s for payment id %s.",
                        $this->getClassName(),
                        $fulfillmentId,
                        $shopifyOrderId,
                        $paymentId
                    )
                );
                */

                if (!$this->getIsSimulation()) {
                    $this->shopify->cancelFulfillment($fulfillmentId);
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

    /**
     * Go through the refund process for all payments on the given Shopify Order
     *
     * @param array $orderData
     * @param int $orderShopifyId
     * @param int $paymentId
     * @param int $subscriptionPaymentId
     * @return void
     */
    private function refundPayments(
        array $orderData,
        int $orderShopifyId,
        int $paymentId,
        int $subscriptionPaymentId
    ): void {
        // 1. orders are automatically closed (or "archived", as it's also called), and refunds cannot be issued to
        // closed orders. So before we issue any, we need to check the status, and reopen the order, if it's closed
        $wasReopened = false;

        if ($orderData["closed_at"]) {
            if (!$this->getIsSimulation()) {
                $this->shopify->openOrder($orderShopifyId);
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
                "note" => sprintf(
                    "Duplicate payment from old ecommerce system. Subscription Payment ID %s",
                    $subscriptionPaymentId
                )
            ];

            /*
            $this->logDebug(
                sprintf(
                    "%s: About to refund payment of %s %s on order %s for payment id %s.",
                    $this->getClassName(),
                    $transactionData["maximum_refundable"],
                    $currency,
                    $orderShopifyId,
                    $paymentId
                )
            );
            */

            if (!$this->getIsSimulation()) {
                $this->shopify->createOrderRefund($orderShopifyId, $refundData);
            }
        }

        // 4. if we had to reopen the order, we need to close it again
        if ($wasReopened && !$this->getIsSimulation()) {
            $this->shopify->closeOrder($orderShopifyId);
        }
    }

    /**
     * Find the User Access Permissions related to the given Shopify Order and delete each entry
     *
     * @param SubscriptionPayment $subscriptionPayment
     * @param array $shopifyOrderAttributes
     * @return void
     */
    private function deleteUserAccessPermissions(
        SubscriptionPayment $subscriptionPayment,
        array $shopifyOrderAttributes
    ): void {
        $subscription = $subscriptionPayment->subscription;
        $user = $subscription->user;
        $product = $subscription->product;

        $shopifyOrderId = $shopifyOrderAttributes["id"];
        // orders created by subscription payments only have one line item, so just grab its id that we need to build the hash
        $shopifyLineItemId = $shopifyOrderAttributes["line_items"][0]["id"];

        $contentPermissions = $product->getContentPermissions($this->contentPermissionsLookup);

        foreach ($contentPermissions as $contentPermission) {
            $hash = sha1("$shopifyOrderId.$shopifyLineItemId.$contentPermission->id");

            // get the user access permission(s) created by this Shopify order
            // there should only be one, but use the whole collection result set just in case
            $userAccessPermissions = UserAccessPermission::query()
                ->whereBelongsTo($user)
                ->where("source_hash", $hash)
                ->where("status", UserAccessPermissionsStatusEnum::Active->value)
                ->get();

            if ($userAccessPermissions->isNotEmpty()) {
                $foundUAPs = $userAccessPermissions->implode("id", ", ");

                $userAccessPermissions->each(function (UserAccessPermission $userAccessPermission) {
                    if (!$this->getIsSimulation()) {
                        $userAccessPermission->delete();
                    }
                });
            }
        }
    }

    /**
     * Delete the Shopify Order
     *
     * @param int $shopifyOrderId
     * @return bool whether the order was deleted
     */
    private function deleteOrder(int $shopifyOrderId): bool
    {
        if (!$this->getIsSimulation()) {
            // unfortunately, this is function doesn't return anything, so we just have to assume it worked
            $this->shopify->deleteOrder($shopifyOrderId);

            // confirm that the deletion worked
            try {
                $this->shopify->getOrder($shopifyOrderId);
            } catch (NotFoundException $exception) {
                return true;
            }
        }

        return false;
    }
}
