<?php

namespace App\Modules\Ecommerce\Jobs\Shopify;

use App\Modules\Ecommerce\Enums\ShopifyMetafieldKey;
use App\Modules\Ecommerce\Enums\ShopifyPaymentSourceEnum;
use App\Modules\Ecommerce\Enums\ShopifyTagEnum;
use App\Modules\Ecommerce\Jobs\Shopify\Traits\HandlesShopifyRateLimit;
use App\Modules\Ecommerce\Models\Product;
use App\Modules\Ecommerce\Models\Shopify\MetaField;
use App\Modules\Ecommerce\Models\Shopify\Rest\Customer;
use App\Modules\Ecommerce\Models\Shopify\Rest\Order;
use App\Modules\Ecommerce\Models\Shopify\Rest\OrderLineItem;
use App\Modules\Ecommerce\Traits\ExecutesShopifyGraphQlQuery;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Signifly\Shopify\REST\Resources\OrderResource;
use Signifly\Shopify\Shopify;

class AddOrderTags implements ShouldQueue
{
    use Batchable;
    use Dispatchable;
    use ExecutesShopifyGraphQlQuery;
    use HandlesShopifyRateLimit;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    protected const TIMEOUT = 840;
    protected Shopify $shopify;
    protected Customer $customer;
    /** @var Collection<Order> $otherOrders */
    protected Collection $otherOrders;
    /** @var Collection<ShopifyTagEnum> $tagsToAdd */
    protected Collection $tagsToAdd;

    public function __construct(
        protected Order $order,
        protected int $trialConversionDayLimit = 45,
        protected bool $isSimulation = false
    ) {
        $this->customer = $order->customer;
        $this->tagsToAdd = collect();
    }

    public function handle(Shopify $shopify): void
    {
        // set DI instances that we'll need
        $this->shopify = $shopify;

        $this->otherOrders = $this->getOtherOrders();

        if ($this->isTrialStart($this->order)) {
            $this->tagsToAdd->push(ShopifyTagEnum::TrialStart);
        }

        // an order can't be a trial conversion AND a trial start, so skip this check
        // if we already have a tag to apply
        if ($this->tagsToAdd->isEmpty() && $this->isTrialConversion()) {
            $this->tagsToAdd->push(ShopifyTagEnum::TrialConversion);
        }

        $isMembershipRenewal = $this->isMembershipRenewal();
        // an order can't be a membership renewal AND (a trial conversion or a trial start), so skip this check
        // if we already have a tag to apply
        if ($this->tagsToAdd->isEmpty() && $isMembershipRenewal) {
            $this->tagsToAdd->push(ShopifyTagEnum::MembershipRenewal);
        }

        if ($this->isInitialOrder($isMembershipRenewal)) {
            $this->tagsToAdd->push(ShopifyTagEnum::InitialOrder);
        }

        $this->applyTags();
    }

    /**
     * Get all orders for this customer, except this one that we're working on.
     *
     * @return Collection<Order>
     */
    protected function getOtherOrders(): Collection
    {
        // DEV NOTE: make sure we have the status param, otherwise archived orders will be skipped
        $customerOrders = $this->shopify->getCustomerOrders($this->customer->id, ['status' => 'any']);
        $this->handleRateLimit();
        $customerOrders->transform(function (OrderResource $orderResource) {
            // grab the attributes from the entry
            $attributes = $orderResource->getAttributes();
            // and make one of our Order data models with it
            return new Order(json_decode(json_encode($attributes), false));
        });

        // remove this order
        return $customerOrders->filter(fn(Order $order) => $order->id != $this->order->id);
    }

    /**
     * Check if the given order is a trial start.
     * If the order item was for zero dollars and for a trial membership product, it's a Trial Start.
     *
     * @param  Order  $order
     * @return bool
     */
    private function isTrialStart(Order $order): bool
    {
        if (!$order->isTrialOrder()) {
            return false;
        }

        // ensure that this trial product had 0 cost
        return $order->lineItems
            ->filter(fn(OrderLineItem $lineItem) => $lineItem->isTrial() && $lineItem->totalPrice == 0)
            ->isNotEmpty();
    }

    /**
     * Check if this is the first paid order for a membership after a trial start.
     *
     * Any membership order item for more than zero dollars after that first one
     * (within the first [trialConversionDayLimit] days) is a trial conversion,
     * assuming that first trial order exists.
     *
     * @return bool
     */
    protected function isTrialConversion(): bool
    {
        // this order needs to be for a paid membership
        if ($this->order->totalPrice <= 0 || !$this->order->isMembershipOrder()) {
            return false;
        }

        // check if there are any previous orders within the past (trialConversionDayLimit) days, that were a trial start
        $recentDaysStart = $this->order->processedAt->copy();
        $recentDaysStart->subDays($this->trialConversionDayLimit);
        $recentOrders = $this->otherOrders
            ->filter(
                fn(Order $otherOrder) => $otherOrder->processedAt->isBetween(
                    $recentDaysStart,
                    $this->order->processedAt
                )
            );

        $hasRecentTrialStart = $recentOrders
            ->filter(fn(Order $otherOrder) => $this->isTrialStart($otherOrder))
            ->isNotEmpty();

        // and make sure there weren't other payments in that period
        $noRecentMembershipPayment = $recentOrders
            ->filter(fn(Order $otherOrder) => $otherOrder->totalPrice > 0 && $otherOrder->isMembershipOrder())
            ->isEmpty();

        return $hasRecentTrialStart && $noRecentMembershipPayment;
    }

    /**
     * Check if this is a membership renewal order.
     *
     * Any membership subscription payment after the first trial payment.
     *
     * @return bool
     */
    protected function isMembershipRenewal(): bool
    {
        // this order needs to be for a paid membership
        if ($this->order->totalPrice <= 0 || !$this->order->isMembershipOrder()) {
            return false;
        }

        // ensure we have a previous order that was a membership payment, to determine that this is a renewal of it
        /** @var Product $membershipProduct */
        $membershipProduct = $this->order->lineItems
            ->filter(fn(OrderLineItem $lineItem) => $lineItem->isMembership())
            ->first()
            ->product;
        // annual or monthly, with a 2-week buffer
        $historyDays = $membershipProduct->getMembershipTimeAsTotalDays() + 14;
        $historyPeriodStartDate = $this->order->processedAt->copy();
        $historyPeriodStartDate->subDays($historyDays);

        return $this->otherOrders
            ->filter(
                fn(Order $otherOrder) => $otherOrder->processedAt->isBetween(
                    $historyPeriodStartDate,
                    $this->order->processedAt
                )
            )
            ->filter(fn(Order $otherOrder) => $otherOrder->totalPrice > 0 && $otherOrder->isMembershipOrder())
            ->isNotEmpty();
    }

    /**
     * Check if this is an initial order.
     * An initial order is defined as an order that was placed by the customer (or by support) via a deliberate action,
     * i.e. not automated.
     *
     * @param  bool  $isMembershipRenewal
     * @return bool
     */
    protected function isInitialOrder(bool $isMembershipRenewal): bool
    {
        // if it came from one of out known automated sources, it can't be initial
        if (in_array($this->order->sourceName, config('shopify.automated_source_names'))) {
            return false;
        }

        // RevenueCat's webhook comes into MWP which then creates the order,
        // so check if the source was MWP
        if (in_array($this->order->sourceName, config('shopify.api_app.musora_web_platform.ids'))) {
            // the only way we can tell if it's a RevenueCat order is if it has payment source metafields of Apple or Google
            $metafields = $this->order->getMetafields();
            $mobilePaymentSourceMetafields = $metafields->filter(function (MetaField $metaField) {
                return $metaField->key === ShopifyMetafieldKey::PaymentSource->value
                    && in_array(
                        $metaField->value,
                        [ShopifyPaymentSourceEnum::Apple->value, ShopifyPaymentSourceEnum::Google->value]
                    );
            });
            if ($mobilePaymentSourceMetafields->isNotEmpty()) {
                // we don't have any way to distinguish a RevenueCat initial order from a renewal, so we need to use $isMembershipRenewal
                return !$isMembershipRenewal;
            }
        }

        // otherwise, it came from a manual source and must be an Initial Order
        return true;
    }

    /**
     * Apply all new tags that are to be added to this order.
     *
     * @return void
     */
    protected function applyTags(): void
    {
        // transform the enums into their values, and remove any that are already in the order's tags
        $this->tagsToAdd->transform(fn(ShopifyTagEnum $shopifyTagEnum) => $shopifyTagEnum->value);
        $this->tagsToAdd = $this->tagsToAdd->reject(fn(string $tag) => in_array($tag, $this->order->tags));

        $gql = <<<GQL
                mutation {
                    tagsAdd (
                        id: "{$this->order->gid}"
                        tags: {$this->tagsToAdd->values()}
                    ) {
                    node {
                        id
                    }
                    userErrors {
                        field
                        message
                    }
                }
            }
            GQL;

        Log::info(
            sprintf(
                '%s: Adding tags to Shopify Order %s: %s',
                $this->getClassName(),
                $this->order->id,
                $this->tagsToAdd->isEmpty() ? '(none)' : $this->tagsToAdd->implode(', ')
            )
        );

        if (!$this->isSimulation && $this->tagsToAdd->isNotEmpty()) {
            try {
                $this->executeQuery($gql);
            } catch (\Exception $e) {
                Log::error($e->getMessage());
                Log::debug($gql);
            }
        }
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
        return $this->isSimulation;
    }

    /**
     * @inheritDoc
     */
    protected function getShopifyConnection(): Shopify
    {
        return $this->shopify;
    }
}
