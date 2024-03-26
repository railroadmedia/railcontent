<?php

namespace App\Modules\Ecommerce\Services;

use App\Modules\Content\Services\ContentPermissionsService;
use App\Modules\Ecommerce\Enums\UserAccessPermissionsStatusEnum;
use App\Modules\Ecommerce\Jobs\Shopify\Traits\HandlesShopifyRateLimit;
use App\Modules\Ecommerce\Models\SubscriptionPayment;
use App\Modules\Ecommerce\Models\UserAccessPermission;
use Illuminate\Support\Collection;
use Signifly\Shopify\Exceptions\NotFoundException;
use Signifly\Shopify\REST\Resources\OrderResource;
use Signifly\Shopify\Shopify;

class ShopifyDeleteService
{
    use HandlesShopifyRateLimit;

    private ShopifyCancelService $shopifyCancelService;
    private Collection $contentPermissionsLookup;

    public function __construct(
        Shopify $shopify,
        ContentPermissionsService $contentPermissionsService,
        ShopifyCancelService $shopifyCancelService
    ) {
        $this->shopify = $shopify;
        $this->contentPermissionsLookup = $contentPermissionsService->getContentPermissionsLookup();
        $this->shopifyCancelService = $shopifyCancelService;
    }

    public function deleteSubscriptionPaymentOrder(SubscriptionPayment $subscriptionPayment): void
    {
        $shopifyOrderId = $subscriptionPayment->shopify_id;
        $orderResource = $this->shopify->getOrder($shopifyOrderId);

        $this->shopifyCancelService->cancelOrderResource($orderResource);
        // we need to remove the permissions from the order
        $this->deleteUserAccessPermissions($subscriptionPayment, $orderResource->getAttributes());

        // now that we've cancelled the order, it can also be deleted
        $this->deleteOrder($shopifyOrderId);
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
    public function deleteOrder(int $shopifyOrderId): bool
    {
        if (!$this->getIsSimulation()) {
            // unfortunately, this is function doesn't return anything, so we just have to assume it worked
            $this->shopify->deleteOrder($shopifyOrderId);
        }

        // confirm that the deletion worked
        try {
            if (!$this->getIsSimulation()) {
                $this->shopify->getOrder($shopifyOrderId);
            }
        } catch (NotFoundException $exception) {
            return true;
        }

        return false;
    }

    protected function getIsSimulation(): bool
    {
        return false;
    }

    protected function getClassName(): string
    {
        return "ShopifyDeleteService";
    }
}
