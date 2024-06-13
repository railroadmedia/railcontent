<?php

namespace App\Modules\Ecommerce\Jobs\Shopify;

use App\Jobs\WebhookChildJob;
use App\Modules\Ecommerce\Enums\ShopifyMetafieldKey;
use App\Modules\Ecommerce\Enums\ShopifyMetafieldNamespace;
use App\Modules\Ecommerce\Enums\ShopifyPaymentSourceEnum;
use App\Modules\Ecommerce\Enums\ShopifyTagEnum;
use App\Modules\Ecommerce\Jobs\Shopify\Traits\HandlesShopifyRateLimit;
use App\Modules\Ecommerce\Models\Product;
use App\Modules\Ecommerce\Models\Shopify\MetaField;
use App\Modules\Ecommerce\Models\Shopify\Rest\Customer;
use App\Modules\Ecommerce\Models\Shopify\Rest\Order;
use App\Modules\Ecommerce\Models\Shopify\Rest\OrderLineItem;
use App\Modules\Ecommerce\Models\SubscriptionPayment;
use App\Modules\Ecommerce\Traits\ExecutesShopifyGraphQlQuery;
use Exception;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Signifly\Shopify\REST\Resources\OrderResource;
use Signifly\Shopify\Shopify;

class AddOrderTags extends WebhookChildJob
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
    protected ?Customer $customer;
    /** @var Collection<Order> $otherOrders */
    protected Collection $otherOrders;
    /** @var array<string, bool> */
    protected array $orderTagsEnabled;

    // buffer for subscription renewals (in case of failed payment, etc.)
    protected int $subscriptionRenewalBufferDays = 60;

    public function __construct(
        protected Order $order,
        protected int $trialConversionDayLimit = 45,
        protected bool $isSimulation = false
    ) {
        $this->customer = $order->customer;
        $this->orderTagsEnabled = [
            ShopifyTagEnum::TrialStart->value => in_array(ShopifyTagEnum::TrialStart->value, $order->tags),
            ShopifyTagEnum::TrialConversion->value => in_array(ShopifyTagEnum::TrialConversion->value, $order->tags),
            ShopifyTagEnum::InitialOrder->value => in_array(ShopifyTagEnum::InitialOrder->value, $order->tags),
            ShopifyTagEnum::MembershipRenewal->value => in_array(
                ShopifyTagEnum::MembershipRenewal->value,
                $order->tags
            ),
        ];
    }

    public function handle(Shopify $shopify): void
    {
        // set DI instances that we'll need
        $this->shopify = $shopify;

        $this->otherOrders = $this->getOtherOrders();

        // we added the import note, so we can use that to identify Shopify orders created by ecommerce data
        $isImported = Str::contains($this->order->note, 'Imported from the old ecommerce system');
        $isImportedInitialOrder = $this->isImportedInitialOrder($isImported);

        // check for each order tag and determine if this order should have it or note
        $this->orderTagsEnabled[ShopifyTagEnum::TrialStart->value] = $this->isTrialStart($this->order);
        $this->orderTagsEnabled[ShopifyTagEnum::TrialConversion->value] = $this->isTrialConversion();
        $this->orderTagsEnabled[ShopifyTagEnum::MembershipRenewal->value] = $this->isMembershipRenewal($isImportedInitialOrder);

        if ($isImportedInitialOrder) {
            // if this was an imported initial order, we need it to be tagged
            $this->orderTagsEnabled[ShopifyTagEnum::InitialOrder->value] = true;
        } elseif ($isImported && in_array(ShopifyTagEnum::InitialOrder->value, $this->order->tags)) {
            // if this was imported but is not from an imported Initial Order, and was previously tagged as one, we need to remove it
            $this->orderTagsEnabled[ShopifyTagEnum::InitialOrder->value] = false;
        } else {
            // finally, use the normal logic to check if it should be added
            $this->orderTagsEnabled[ShopifyTagEnum::InitialOrder->value] = $this->isInitialOrder(
                $this->orderTagsEnabled[ShopifyTagEnum::MembershipRenewal->value]
            );
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
        // it's possible for there to be no customer on the order, so we just need to return the empty collection then
        if (is_null($this->customer)) {
            return collect();
        }

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
        return $customerOrders->filter(fn (Order $order) => $order->id != $this->order->id);
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
        // if the order already has the Trial Start tag, it is one
        if ($this->orderTagsEnabled[ShopifyTagEnum::TrialStart->value]) {
            return true;
        }

        if (!$order->isTrialOrder()) {
            return false;
        }

        // ensure that this trial product had 0 cost
        return $order->lineItems
            ->filter(fn (OrderLineItem $lineItem) => $lineItem->isTrial() && $lineItem->totalPrice <= 0)
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
        // an order can't be a trial conversion AND a trial start
        if ($this->orderTagsEnabled[ShopifyTagEnum::TrialStart->value]) {
            return false;
        }

        // if the order already has the Trial Conversion tag, it is one
        if ($this->orderTagsEnabled[ShopifyTagEnum::TrialConversion->value]) {
            return true;
        }

        // if there are no other orders for the customer, it can't be a trial conversion
        if ($this->otherOrders->isEmpty()) {
            return false;
        }

        // this order needs to be for a paid membership
        if ($this->order->totalPrice <= 0 || !$this->order->isMembershipOrder()) {
            return false;
        }

        // check if there are any previous orders within the past (trialConversionDayLimit) days, that were a trial start
        $recentDaysStart = $this->order->processedAt->copy();
        $recentDaysStart->subDays($this->trialConversionDayLimit);
        $recentOrders = $this->otherOrders
            ->filter(
                fn (Order $otherOrder) => $otherOrder->processedAt->isBetween(
                    $recentDaysStart,
                    $this->order->processedAt
                )
            );

        $hasRecentTrialStart = $recentOrders
            ->filter(fn (Order $otherOrder) => $this->isTrialStart($otherOrder))
            ->isNotEmpty();

        // and make sure there weren't other payments in that period
        $noRecentMembershipPayment = $recentOrders
            ->filter(fn (Order $otherOrder) => $otherOrder->totalPrice > 0 && $otherOrder->isMembershipOrder())
            ->isEmpty();

        return $hasRecentTrialStart && $noRecentMembershipPayment;
    }

    /**
     * Check if this is a membership renewal order.
     *
     * Any membership subscription payment after the first trial payment.
     *
     * @param  bool  $isImportedInitialOrder
     * @return bool
     */
    protected function isMembershipRenewal(bool $isImportedInitialOrder): bool
    {
        // an order can't be a membership renewal AND (a trial conversion or a trial start)
        if ($this->orderTagsEnabled[ShopifyTagEnum::TrialStart->value] || $this->orderTagsEnabled[ShopifyTagEnum::TrialConversion->value]) {
            return false;
        }

        // if the order already has the Membership Renewal tag, it is one
        if (in_array(ShopifyTagEnum::MembershipRenewal->value, $this->order->tags)) {
            return true;
        }

        // if this order was created from an imported Initial Order, then it can't be a Membership Renewal
        if ($isImportedInitialOrder) {
            return false;
        }

        // if there are no other orders for the customer, it can't be a membership renewal
        if ($this->otherOrders->isEmpty()) {
            return false;
        }

        // this order needs to be for a paid membership
        if ($this->order->totalPrice <= 0 || !$this->order->isMembershipOrder()) {
            return false;
        }

        // ensure we have a previous order that was a membership payment, to determine that this is a renewal of it
        /** @var Product $membershipProduct */
        $membershipProduct = $this->order->lineItems
            ->filter(fn (OrderLineItem $lineItem) => $lineItem->isMembership())
            ->first()
            ->product;
        // annual or monthly, with the buffer
        $historyDays = $membershipProduct->getMembershipTimeAsTotalDays() + $this->subscriptionRenewalBufferDays;
        $historyPeriodStartDate = $this->order->processedAt->copy();
        $historyPeriodStartDate->subDays($historyDays);

        return $this->otherOrders
            ->filter(
                fn (Order $otherOrder) => $otherOrder->processedAt->isBetween(
                    $historyPeriodStartDate,
                    $this->order->processedAt
                )
            )
            ->filter(fn (Order $otherOrder) => $otherOrder->totalPrice > 0 && $otherOrder->isMembershipOrder())
            ->isNotEmpty();
    }

    /**
     * Check if this Shopify order was created from an imported ecommerce subscription payment or order,
     * that would be considered an Initial Order.
     * This would mean either of the following cases:
     *  - it was created by an import AND
     *      - it was created by an imported ecommerce order, OR
     *      - it was created by an imported ecommerce subscription payment that is linked to an order
     *
     */
    protected function isImportedInitialOrder(bool $isImported): bool
    {
        if ($isImported) {
            // get the metafields, so we can grab the model type and id
            $metafields = $this->order->getMetafields();

            $orderIdMetafield = $metafields->filter(function (MetaField $metaField) {
                return $metaField->key === ShopifyMetafieldKey::Id->value
                    && $metaField->namespace === ShopifyMetafieldNamespace::Model_Orders->value;
            })->first();

            // an ecommerce order has to be "Initial"
            if ($orderIdMetafield) {
                return true;
            }

            // if this is from a subscription payment, we need to check if the payment is attached to an ecommerce_orders
            // row via the ecommerce_order_payments table. If it is, then it must be an initial order.
            $subscriptionPaymentIdMetafield = $metafields->filter(function (MetaField $metaField) {
                return $metaField->key === ShopifyMetafieldKey::Id->value
                    && $metaField->namespace === ShopifyMetafieldNamespace::Model_SubscriptionPayments->value;
            })->first();

            if ($subscriptionPaymentIdMetafield) {
                // this is from a subscription payment, so find our record of it and look for a related order through the subscription
                $orders = SubscriptionPayment::with('payment.orders')->firstWhere('id', $subscriptionPaymentIdMetafield->value)->orders;
                if ($orders) {
                    return true;
                }
            }
        }

        return false;
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
        // if the order already has the Initial Order tag, it is one
        if (in_array(ShopifyTagEnum::InitialOrder->value, $this->order->tags)) {
            return true;
        }

        // if it came from one of our known automated sources, it can't be initial
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
     * Apply all new tags that are to be added to or removed from this order.
     *
     * @return void
     */
    protected function applyTags(): void
    {
        // grab all the tags that should be removed
        $tagsToRemove = collect($this->orderTagsEnabled)->filter(
            function (bool $isEnabled, string $tag) {
                return in_array($tag, $this->order->tags) && !$isEnabled;
            }
        )
        ->keys();

        // grab all the tags that should be enabled
        $tagsToAdd = collect($this->orderTagsEnabled)->filter()->keys();

        // do the safety sanitization in case of edge cases
        $tagsToAdd = $this->sanitizeTags($tagsToAdd);

        // ignore any that already exist on the order
        $tagsToAdd = $tagsToAdd->reject(fn (string $tag) => in_array($tag, $this->order->tags));
        $addGql = <<<GQL
                mutation {
                    tagsAdd (
                        id: "{$this->order->gid}"
                        tags: {$tagsToAdd->values()}
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
                $tagsToAdd->isEmpty() ? '(none)' : $tagsToAdd->implode(', ')
            )
        );

        if (!$this->isSimulation && $tagsToAdd->isNotEmpty()) {
            try {
                $this->executeQuery($addGql);
            } catch (Exception $e) {
                Log::error($e->getMessage());
                Log::debug($addGql);
            }
        }

        $removeGql = <<<GQL
                mutation {
                    tagsRemove (
                        id: "{$this->order->gid}"
                        tags: {$tagsToRemove->values()}
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
                '%s: Removing tags from Shopify Order %s: %s',
                $this->getClassName(),
                $this->order->id,
                $tagsToRemove->isEmpty() ? '(none)' : $tagsToRemove->implode(', ')
            )
        );

        if (!$this->isSimulation && $tagsToRemove->isNotEmpty()) {
            try {
                $this->executeQuery($removeGql);
            } catch (Exception $e) {
                Log::error($e->getMessage());
                Log::debug($removeGql);
            }
        }
    }

    /**
     * Perform any necessary sanitization for edge cases.
     * In general, no order should ever have a combination of these tags:
     *      Trial Conversion
     *      Initial Order
     *      Membership Renewal
     * If one does have more than one of these tags, we should remove the excess based on the priority order above.
     *
     * @param  Collection  $tags
     * @return Collection
     */
    protected function sanitizeTags(Collection $tags): Collection
    {
        $hasTrialConversion = $tags->contains(ShopifyTagEnum::TrialConversion->value);
        $hasInitialOrder = $tags->contains(ShopifyTagEnum::InitialOrder->value);

        return $tags->filter(function (string $tag) use ($hasTrialConversion, $hasInitialOrder) {
            if ($tag === ShopifyTagEnum::InitialOrder->value && $hasTrialConversion) {
                return false;
            }
            if ($tag === ShopifyTagEnum::MembershipRenewal->value && ($hasTrialConversion || $hasInitialOrder)) {
                return false;
            }
            return true;
        });
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
