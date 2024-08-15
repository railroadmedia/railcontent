<?php

namespace App\Modules\Ecommerce\Jobs\Shopify;

use App\Console\Commands\Infrastructure\BatchQueryJobByIds;
use App\Modules\Ecommerce\Jobs\Shopify\Traits\HandlesShopifyRateLimit;
use App\Modules\Ecommerce\Models\Order as EcommerceOrder;
use App\Modules\Ecommerce\Models\OrderItem;
use App\Modules\Ecommerce\Models\OrderItemFulfillment;
use App\Modules\Ecommerce\Models\Payment;
use App\Modules\Ecommerce\Models\Product;
use App\Modules\Ecommerce\Models\Shopify\MetaField;
use App\Modules\Ecommerce\Models\Shopify\Rest\Customer;
use App\Modules\Ecommerce\Models\Shopify\Rest\Fulfillment;
use App\Modules\Ecommerce\Models\Shopify\Rest\Order;
use App\Modules\Ecommerce\Models\Shopify\Rest\OrderLineItem;
use App\Modules\Ecommerce\Models\Shopify\ShopifyOrderFix;
use App\Modules\Ecommerce\Models\SubscriptionPayment;
use App\Modules\Ecommerce\Services\ShopifySyncService;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Queue\Middleware\SkipIfBatchCancelled;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Signifly\Shopify\Exceptions\NotFoundException;
use Signifly\Shopify\Exceptions\ValidationException;
use Signifly\Shopify\REST\Resources\ApiResource;
use Signifly\Shopify\Shopify;

/**
 * Fix evaluated Shopify Orders, as recorded in ShopifyOrderFix entries;
 * creating a copy of any bad orders, and setting the correct price values.
 * Once the order has been fixed (if necessary), it then dispatches the jobs
 * to add address metafields.
 * @see https://musora.atlassian.net/wiki/x/IQB5Ag
 */
class FixEvaluatedOrders extends BatchQueryJobByIds
{
    use HandlesShopifyRateLimit;

    public int $tries = 2;
    public int $timeout = 840;
    protected Shopify $shopify;
    private ShopifySyncService $shopifySyncService;
    private ?Customer $customer;

    // keep track of local records that need to have the shopify_id replaced
    /** @var Collection<UpdatedEcommerceModel> */
    private Collection $updatedRecords;

    public function __construct(
        private readonly int $skip,
        private readonly int $take,
        private readonly Carbon $startProcessedAt,
        private readonly Carbon $endProcessedAt,
        private readonly bool $simulate
    ) {
        $this->init($skip, $take);
    }

    public function middleware(): array
    {
        return [new SkipIfBatchCancelled()];
    }

    /**
     * @throws Exception
     */
    public function handleAllItems($items): bool
    {
        $this->shopify = app(Shopify::class);
        $this->shopifySyncService = app(ShopifySyncService::class);
        foreach ($items as $item) {
            $this->handleItem($item);
        }
        return true;
    }

    /**
     * @param  ShopifyOrderFix  $item
     * @return void
     * @throws Exception
     */
    public function handleItem($item): void
    {
        $this->updatedRecords = collect();
        // safety check
        if ($item->is_fixed) {
            Log::error(
                sprintf(
                    '%s: ShopifyOrderFix %s was already fixed. Skipping.',
                    $this->getClassName(),
                    $item->id
                )
            );
            return;
        }

        if ($item->action_taken == ShopifyOrderFix::ACTION_MATCHED) {
            $this->dispatchAddressMetafieldsJob($item);
        } elseif ($item->action_taken == ShopifyOrderFix::ACTION_REPLACED) {
            if (!$this->isTargetStatusCompleted($item, ShopifyOrderFix::STATUS_PROCESSING)) {
                $this->updateShopifyOrderFixRecord($item, 'status', ShopifyOrderFix::STATUS_PROCESSING);
            }
            try {
                $item = $this->cloneOrder($item);
                $item = $this->addPaymentTransactions($item);
                $item = $this->addFulfillments($item);
                $this->updateEcommerceRecords($item);
                if (!$this->deleteOriginalShopifyOrder($item)) {
                    throw new Exception(
                        sprintf(
                            'Deletion of original Shopify order %s failed.',
                            $item->original_shopify_order_id
                        )
                    );
                }
                $this->resyncCustomerPermissions($item);
                $this->dispatchAddressMetafieldsJob($item);
            } catch (Exception $exception) {
                $itemNotes = Str::of($item->notes ?? '');
                if ($itemNotes->isEmpty()) {
                    $itemNotes = Str::of($exception->getMessage());
                } else {
                    $itemNotes = $itemNotes->newLine()->append($exception->getMessage());
                }
                $this->updateShopifyOrderFixRecord($item, 'notes', $itemNotes->value());
                throw new Exception(
                    sprintf(
                        '%s: ShopifyOrderFix %s encountered exception: %s',
                        $this->getClassName(),
                        $item->id,
                        $exception->getMessage()
                    )
                );
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

    private function dispatchAddressMetafieldsJob(ShopifyOrderFix $fix): void
    {
        $targetStatus = ShopifyOrderFix::STATUS_COMPLETED;
        if ($this->isTargetStatusCompleted($fix, $targetStatus)) {
            return;
        }
        /** @var EcommerceOrder|SubscriptionPayment $model */
        $model = $fix->ecommerceModelable;
        // be sure to refresh, in case the shopify_id has changed
        $model->refresh();
        if ($this->simulate) {
            Log::info(
                sprintf(
                    '%s: dispatching address metafield jobs for Shopify Order %s',
                    $this->getClassName(),
                    $model->shopify_id
                )
            );
        } else {
            $this->batch()->add(new SyncAddressMetafieldsToShopify($model, false));
        }
        $this->updateShopifyOrderFixRecord($fix, 'status', $targetStatus);
        $this->updateShopifyOrderFixRecord($fix, 'is_fixed', true);
    }

    /**
     * Helper function used in case of retries.
     * Check if the target status has already been completed.
     */
    private function isTargetStatusCompleted(ShopifyOrderFix $fix, string $targetStatus): bool
    {
        $currentStatusIndex = array_search($fix->status, ShopifyOrderFix::STATUSES);
        $targetStatusIndex = array_search($targetStatus, ShopifyOrderFix::STATUSES);

        return $currentStatusIndex >= $targetStatusIndex;
    }

    /**
     * Helper function to update an attribute of the given ShopifyOrderFix.
     * Useful for cutting down duplication and making the simulation logging easier.
     */
    private function updateShopifyOrderFixRecord(ShopifyOrderFix $fix, string $attribute, mixed $value): void
    {
        if ($this->simulate) {
            Log::info(
                sprintf(
                    '%s: ShopifyOrderFix %s %s = %s',
                    $this->getClassName(),
                    $fix->id,
                    $attribute,
                    $value
                )
            );
        } else {
            $fix->update([$attribute => $value]);
        }
    }

    /**
     * @throws Exception
     */
    private function cloneOrder(ShopifyOrderFix $fix): ShopifyOrderFix
    {
        $targetStatus = ShopifyOrderFix::STATUS_CLONED;
        if ($this->isTargetStatusCompleted($fix, $targetStatus)) {
            return $fix;
        }

        // 1. retrieve the original Shopify Order
        $originalOrderData = $this->getShopifyOrderModel($fix, true);
        // get the metafields from Shopify
        $originalOrderMetafields = $originalOrderData->getMetafields();
        $this->handleRateLimit(true);

        $cloneOrderData = [];
        // 2. Create a clone with the applicable same values
        $cloneOrderData['currency'] = $originalOrderData->currency;
        $cloneOrderData['customer'] = ['id' => $originalOrderData->customer->id];
        $cloneOrderData['email'] = $originalOrderData->email;
        $cloneOrderData['processed_at'] = $originalOrderData->processedAt->toIso8601String();
        $cloneOrderData['tags'] = implode(', ', $originalOrderData->tags);
        $cloneOrderData['note'] = $originalOrderData->note;

        if ($originalOrderData->billingAddress) {
            $cloneOrderData['billing_address'] = json_decode(json_encode($originalOrderData->billingAddress), true);
        }
        if ($originalOrderData->shippingAddress) {
            $cloneOrderData['shipping_address'] = json_decode(json_encode($originalOrderData->shippingAddress), true);
        }

        if ($originalOrderMetafields->isNotEmpty()) {
            $metafields = [];
            $originalOrderMetafields->each(function (MetaField $metafield) use (&$metafields) {
                $metafields[] = [
                    'namespace' => $metafield->namespace,
                    'key' => $metafield->key,
                    'value' => $metafield->value,
                    'type' => $metafield->type
                ];
            });
            $cloneOrderData['metafields'] = $metafields;
        }

        // 3. Create new line items:
        $lineItems = [];
        $newTotal = 0.0;
        $totalPriceAmount = $fix->orderTotalAmount;
        $hasOnlyOneLineItem = $originalOrderData->lineItems->count() === 1;
        $model = $fix->ecommerceModelable;
        foreach ($originalOrderData->lineItems as $lineItem) {
            // Use $originalOrder’s line_items to copy most data:
            $lineItemData = [];
            $lineItemData['fulfillable_quantity'] = $lineItem->fulfillableQuantity;
            $lineItemData['fulfillment_service'] = $lineItem->fulfillmentService;
            $lineItemData['grams'] = $lineItem->grams;
            $lineItemData['name'] = $lineItem->name;
            $lineItemData['product_id'] = $lineItem->productId;
            $lineItemData['quantity'] = $lineItem->quantity;
            $lineItemData['requires_shipping'] = $lineItem->requiresShipping;
            $lineItemData['sku'] = $lineItem->sku;
            $lineItemData['taxable'] = $lineItem->taxable;
            $lineItemData['title'] = $lineItem->productTitle;
            $lineItemData['variant_id'] = $lineItem->variantId;
            $lineItemData['vendor'] = $lineItem->vendor;

            // We were only able to record the shopify_id on OrderItems for Orders, not Subscription Payments
            // (because the same order and order items are used for each Subscription Payment for the Subscription).
            if ($model instanceof SubscriptionPayment) {
                // if it has only one LineItem, we'll just use the $fix->true_payment_amount, so don't worry about it
                if (!$hasOnlyOneLineItem) {
                    $orderItemId = 'n/a';
                    $orderItemFinalPrice = $this->getPaymentAmountForSubscriptionPaymentLineItem($lineItem, $model);
                }
            } else {
                // Find the corresponding ecommerce_order_items (by matching shopify_id)
                $orderItem = OrderItem::firstWhere('shopify_id', $lineItem->id);
                if (!$orderItem) {
                    throw new Exception(
                        sprintf(
                            'Ecommerce order item not found for shopify_id %s. Unable to calculate cost.',
                            $lineItem->id
                        )
                    );
                }
                $orderItemId = $orderItem->id;
                $orderItemFinalPrice = $orderItem->final_price;
                $this->updatedRecords->push(new UpdatedEcommerceModel(get_class($orderItem), $orderItemId));
            }

            // if we only have one line item, we'll just use the fix's true_payment_amount
            if ($hasOnlyOneLineItem) {
                $weightedCost = $fix->true_payment_amount;
            } else {
                // Calculate the price:
                // Use the $fix->true_payment_amount to get the total amount paid for the Order/Subscription Payments
                // e.g. $255
                // Get the total amount for all ecommerce_order_items for the Order ($totalPriceAmount)
                // e.g. $50, $125, $100 = $275
                // Calculate the weighted cost for this line item
                if (end($originalOrderData->lineItems) == $lineItem) {
                    // be careful of rounding errors; offset the final item as necessary to make sure the totals match
                    $weightedCost = $newTotal - $fix->true_payment_amount;
                } else {
                    // Use the ecommerce_order_items' final_price as a portion of the ecommerce order total, multiplied by $fix->true_payment_amount’s total:
                    // e.g. 50 / (50+125+100) * 255 = 46.36
                    // e.g. 125 / (50+125+100) * 255 = 115.91
                    // e.g. 100 / (50+125+100) * 255 = 92.73
                    $portionOfTotal = $totalPriceAmount * $fix->true_payment_amount;
                    $weightedCost = $portionOfTotal > 0 ? $orderItemFinalPrice / $portionOfTotal : 0;
                    $newTotal += $weightedCost;
                    // Log::debug(
                    //     sprintf(
                    //         'Order Item %s original price: %s. Weighted price: %s',
                    //         $orderItemId,
                    //         $orderItemFinalPrice,
                    //         $weightedCost
                    //     )
                    // );
                }
            }
            $lineItemData['price'] = number_format($weightedCost, 2, '.', '');
            $lineItems[] = $lineItemData;
        }
        // Log::debug(sprintf('Line Item costs: %s', implode(', ', Arr::pluck($lineItems, 'price'))));
        $cloneOrderData['line_items'] = $lineItems;

        if ($this->simulate) {
            Log::info(
                sprintf(
                    '%s: create Shopify Order to clone %s. %s',
                    $this->getClassName(),
                    $fix->original_shopify_order_id,
                    print_r($cloneOrderData, true)
                )
            );
            $cloneId = 123456789;
        } else {
            $cloneResponse = $this->shopify->createOrder($cloneOrderData);
            $clone = $cloneResponse->getAttributes();
            $cloneId = $clone['id'];
            // Log::debug("Created Shopify order $cloneId");

            // record the new line item shopify_ids, so we can update them later (if it was an order, because subscription payments don't have them)
            if ($model instanceof EcommerceOrder) {
                // DEV NOTE: we intentionally added the orderItems first (in step 3) so that our indices will match
                foreach ($clone["line_items"] as $index => $cloneLineItem) {
                    $this->updatedRecords->get($index)->shopify_id = $cloneLineItem['id'];
                }
            }
        }
        $this->updatedRecords->push(
            new UpdatedEcommerceModel($fix->ecommerce_modelable_type, $fix->ecommerce_modelable_id, $cloneId)
        );
        $this->updateShopifyOrderFixRecord($fix, 'replacement_shopify_order_id', $cloneId);
        $this->updateShopifyOrderFixRecord($fix, 'status', $targetStatus);
        return $fix;
    }

    /**
     * Helper function to retrieve the order from Shopify, and format it into our REST model.
     *
     * @throws Exception
     */
    private function getShopifyOrderModel(ShopifyOrderFix $fix, bool $original): Order
    {
        if ($original) {
            $attribute = 'original_shopify_order_id';
            $name = 'Original';
        } else {
            $attribute = 'replacement_shopify_order_id';
            $name = 'Replacement';
        }
        try {
            $orderResponse = $this->shopify->getOrder($fix->$attribute);
            $this->handleRateLimit(true);
        } catch (NotFoundException $exception) {
            throw new Exception(sprintf('%s Shopify order %s not found', $name, $fix->$attribute));
        }

        return new Order(json_decode(json_encode($orderResponse->getAttributes()), false));
    }

    /**
     * Helper function to get the amount paid for a Subscription Payment's line item.
     *
     * @throws Exception
     */
    private function getPaymentAmountForSubscriptionPaymentLineItem(
        OrderLineItem $lineItem,
        SubscriptionPayment $subscriptionPayment
    ): float {
        // we'll need to find the membership product that was used for the Subscription Payment
        // start by trying to match sku
        $product = Product::firstWhere('sku', $lineItem->sku);
        if ($product) {
            return floatval($product->price);
        }

        // if not found, look for a single membership product on the associated Order
        $orderItemProducts = $subscriptionPayment->subscription->order?->orderItems->map(
            fn (OrderItem $orderItem) => $orderItem->product
        ) ?? collect();
        $membershipProducts = $orderItemProducts->filter(fn (Product $product) => $product->isMembershipProduct());
        if ($membershipProducts->isNotEmpty()) {
            // if there's only one result, use that
            if ($membershipProducts->count() == 1) {
                return floatval($membershipProducts->first()->price);
            }
            // if there are multiple, we can try to match the price to the line item's and use that if there's only one
            $pricedMembershipProducts = $orderItemProducts->filter(
                fn (Product $product) => floatval($product->price) == $lineItem->price
            );
            if ($pricedMembershipProducts->count() == 1) {
                return $lineItem->price;
            }
        }

        // if we couldn't find a singular product to match, then we have to throw the exception
        throw new Exception('No matching ecommerce product found for Subscription Payment. Unable to calculate cost.');
    }

    private function addPaymentTransactions(ShopifyOrderFix $fix): ShopifyOrderFix
    {
        $targetStatus = ShopifyOrderFix::STATUS_PAID;
        if ($this->isTargetStatusCompleted($fix, $targetStatus)) {
            return $fix;
        }

        // DEV NOTE: this is mostly copied from SyncOrdersToShopify and SyncSubscriptionPaymentsToShopifyOrders.
        // It wasn't worth the effort of trying to abstract this, since it's hopefully a one-time usage
        $this->getPaymentsData($fix)
            ->filter(function (array $paymentData) {
                return $paymentData['data']['amount'] > 0;
            })
            ->each(function (array $paymentData) use ($fix) {
                $paymentId = $paymentData['id'];
                if ($this->simulate) {
                    Log::info(
                        sprintf(
                            '%s: create order transaction for cloned Shopify Order %s. %s',
                            $this->getClassName(),
                            $fix->replacement_shopify_order_id,
                            print_r($paymentData['data'], true)
                        )
                    );
                } else {
                    $paymentResource = $this->shopify->createOrderTransaction(
                        $fix->replacement_shopify_order_id,
                        $paymentData['data']
                    );
                    $paymentShopifyId = $paymentResource->id;
                    $this->handleRateLimit();

                    // record the updated shopify_id
                    $record = $this->updatedRecords->where('class', Payment::class)
                        ->where('id', $paymentId)
                        ->first();
                    if ($record) {
                        $record->shopify_id = $paymentShopifyId;
                    }
                }
            });

        // update the ShopifyOrderFix entry
        $this->updateShopifyOrderFixRecord($fix, 'status', $targetStatus);
        return $fix;
    }

    /**
     * Helper function to get all payments for the ecommerce model that need to be added up to Shopify,
     * and transform the data into the format required by Shopify
     */
    private function getPaymentsData(ShopifyOrderFix $fix): Collection
    {
        /** @var EcommerceOrder|SubscriptionPayment $model */
        $model = $fix->ecommerceModelable;
        if ($model instanceof EcommerceOrder) {
            $payments = $model->payments->filter(fn (Payment $payment) => $payment->status === Payment::STATUS_PAID);
        } else {
            $payments = collect([$model->payment]);
        }

        $payments->each(function (Payment $payment) {
            $this->updatedRecords->push(new UpdatedEcommerceModel(get_class($payment), $payment->id));
        });

        return $payments->transform(function (Payment $payment) {
            return
                [
                    // this is a workaround to keep a reference to our ecommerce payment
                    "id" => $payment->id,
                    "data" =>
                        [
                            "amount" => number_format($payment->totalPaidAfterRefund, 2, '.', ''),
                            "kind" => "sale",
                            // DEV NOTE: this is not documented in Shopify, but it is required
                            "source" => "external"
                        ]
                ];
        });
    }

    /**
     * @throws Exception
     */
    private function addFulfillments(ShopifyOrderFix $fix): ShopifyOrderFix
    {
        $targetStatus = ShopifyOrderFix::STATUS_FULFILLED;
        if ($this->isTargetStatusCompleted($fix, $targetStatus)) {
            return $fix;
        }

        // create the fulfillment
        if ($this->simulate) {
            Log::info(
                sprintf(
                    '%s: create Shopify Fulfillments for replacement order %s. Process cannot be simulated.',
                    $this->getClassName(),
                    $fix->replacement_shopify_order_id
                )
            );
            // update the ShopifyOrderFix entry
            $this->updateShopifyOrderFixRecord($fix, 'status', $targetStatus);
            return $fix;
        }

        // get the original's fulfillments
        $originalOrderData = $this->getShopifyOrderModel($fix, true);
        $originalFulfillments = $originalOrderData->fulfillments;

        // get the order's fulfillment orders so that we can fulfill each one
        $replacementOrderFulfillmentOrders = $this->shopify->getOrderFulfillmentOrders(
            $fix->replacement_shopify_order_id
        );
        if ($replacementOrderFulfillmentOrders->isEmpty()) {
            throw new Exception(
                sprintf('No Order Fulfillment Orders for Replacement Order %s', $fix->replacement_shopify_order_id)
            );
        }

        $replacementOrderFulfillmentOrders->transform(function (ApiResource $resource) {
            return $resource->getAttributes();
        });

        $replacementOrderFulfillmentOrders->each(function (array $fulfillmentOrder) use ($fix, $originalFulfillments) {
            // make the best attempt at matching the original fulfillment (to get the tracking info), by finding the
            // fulfillment that contains the first line item, matched by variant id
            $firstLineItemVariantId = $fulfillmentOrder['line_items'][0]['variant_id'];
            /** @var Fulfillment $match */
            $originalFulfillmentMatch = $originalFulfillments->filter(
                fn (Fulfillment $fulfillment) => $fulfillment->lineItems->contains('variantId', $firstLineItemVariantId)
            )->first();

            $fulfillmentOrderId = $fulfillmentOrder['id'];
            $fulfillmentData = [
                "notify_customer" => false,
                "status" => $match->status ?? 'success',
            ];

            if ($originalFulfillmentMatch) {
                $trackingInfo = [];
                if ($originalFulfillmentMatch->trackingNumber) {
                    $trackingInfo['number'] = $originalFulfillmentMatch->trackingNumber;
                }
                if ($originalFulfillmentMatch->trackingCompany) {
                    $trackingInfo['company'] = $originalFulfillmentMatch->trackingCompany;
                }
                if (!empty($trackingInfo)) {
                    $fulfillmentData['tracking_info'] = $trackingInfo;
                }

                // check if we had the original fulfillment recorded, so we can update it
                $ecommerceFulfillments = OrderItemFulfillment::where('shopify_id', $originalFulfillmentMatch->id)->get(
                );
            } else {
                $ecommerceFulfillments = collect();
            }

            $fulfillmentOrderLineItems = collect($fulfillmentOrder['line_items'])->map(function (array $lineItem) {
                return [
                    'id' => $lineItem['id'],
                    'quantity' => $lineItem['quantity'],
                ];
            });

            $fulfillmentData['line_items_by_fulfillment_order'] = [
                [
                    'fulfillment_order_id' => $fulfillmentOrderId,
                    'fulfillment_order_line_items' => $fulfillmentOrderLineItems
                ]
            ];

            $cloneFulfillmentResponse = $this->shopify->createFulfillment($fulfillmentData);
            $fulfillmentClone = $cloneFulfillmentResponse->getAttributes();
            $fulfillmentCloneId = $fulfillmentClone['id'];

            // record the new fulfillment shopify_id, so we can update it later
            $ecommerceFulfillments->each(
                function (OrderItemFulfillment $ecommerceFulfillment) use ($fulfillmentCloneId) {
                    $this->updatedRecords->push(
                        new UpdatedEcommerceModel(
                            OrderItemFulfillment::class,
                            $ecommerceFulfillment->id,
                            $fulfillmentCloneId
                        )
                    );
                }
            );

            // mark the fulfillment as delivered
            $this->markFulfillmentAsDelivered($fix->replacement_shopify_order_id, $fulfillmentCloneId);
        });

        // do a safety check and fulfill anything that's left
        $replacementOrderData = $this->getShopifyOrderModel($fix, false);
        if ($replacementOrderData->fulfillmentStatus !== 'fulfilled') {
            // if the order isn't fulfilled, get any open order fulfillments and fulfill them with minimal data
            $openOrderFulfillmentOrders = $this->getOpenOrderFulfillmentOrders($replacementOrderData);
            $openOrderFulfillmentOrders->each(function ($openOrderFulfillmentOrder) {
                $this->completeShopifyFulfillmentOrderWithNoData($openOrderFulfillmentOrder);
            });

            // final safety check: throw an exception if it's still not fulfilled
            $replacementOrderData = $this->getShopifyOrderModel($fix, false);
            if ($replacementOrderData->fulfillmentStatus !== 'fulfilled') {
                throw new Exception(
                    sprintf('Replacement Shopify order %s was not fulfilled', $fix->replacement_shopify_order_id)
                );
            }
        }

        // update the ShopifyOrderFix entry
        $this->updateShopifyOrderFixRecord($fix, 'status', $targetStatus);
        return $fix;
    }

    /**
     * Helper function to mark a fulfillment as delivered
     *
     * @throws ValidationException
     */
    private function markFulfillmentAsDelivered(int $shopifyOrderId, int $shopifyFulfillmentId): void
    {
        if ($this->simulate) {
            Log::info(
                sprintf(
                    '%s: Mark fulfillment %s as delivered.',
                    $this->getClassName(),
                    $shopifyOrderId
                )
            );
            return;
        }

        $fulfillment = $this->shopify->getOrderFulfillment($shopifyOrderId, $shopifyFulfillmentId)->getAttributes();
        // make sure the fulfillment has at least one line item that requires shipping
        $lineItemsToShip = collect($fulfillment['line_items'])->filter(
            fn (array $lineItemData) => $lineItemData['requires_shipping'] == true
        );
        if ($lineItemsToShip->isNotEmpty()) {
            $this->shopifySyncService->markFulfillmentAsDelivered(
                $shopifyOrderId,
                $shopifyFulfillmentId
            );
            $this->handleRateLimit();
        }
    }

    /**
     * Helper function to get all order fulfillments that aren't complete
     */
    private function getOpenOrderFulfillmentOrders(Order $order): Collection
    {
        $fulfillmentOrders = $this->shopify->getOrderFulfillmentOrders($order->id);
        $this->handleRateLimit(true);

        $fulfillmentOrders->transform(function (ApiResource $resource) {
            return $resource->getAttributes();
        });

        // get the OrderFulfillmentOrders that are still open
        return $fulfillmentOrders->filter(function (array $attributes) {
            return $attributes['status'] == 'open' || $attributes['status'] == 'in_progress';
        });
    }

    /**
     * Helper function to create a fulfillment and mark it as delivered, for any open order fulfillments
     */
    private function completeShopifyFulfillmentOrderWithNoData(array $shopifyOrderFulfillmentOrderData): void
    {
        if ($this->simulate) {
            Log::error(
                sprintf(
                    "%s: cannot run completeShopifyFulfillmentOrderWithNoData in simulation mode",
                    $this->getClassName()
                )
            );
            return;
        }

        // go through each line item and fulfill it
        foreach ($shopifyOrderFulfillmentOrderData['line_items'] as $lineItem) {
            if ($lineItem['fulfillable_quantity']) {
                $fulfillmentData = [
                    "fulfillment" => [
                        "notify_customer" => false,
                        "status" => "success",
                    ],
                    "line_items_by_fulfillment_order" => [
                        [
                            "fulfillment_order_id" => $lineItem['fulfillment_order_id'],
                            "fulfillment_order_line_items" => [
                                [
                                    "id" => $lineItem['id'],
                                    "quantity" => $lineItem['fulfillable_quantity']
                                ]
                            ]
                        ]
                    ]
                ];

                $fulfillmentResult = $this->shopify->createFulfillment($fulfillmentData);
                $fulfillmentID = $fulfillmentResult->getAttributes()["id"];
                $this->handleRateLimit();

                $this->markFulfillmentAsDelivered($shopifyOrderFulfillmentOrderData['order_id'], $fulfillmentID);
                $this->handleRateLimit();
            }
        }
    }

    /**
     * Update our ecommerce models with the new Shopify IDs that have been recorded
     */
    private function updateEcommerceRecords(): void
    {
        if ($this->simulate) {
            $msg = Str::of(sprintf('%s: update local records.', $this->getClassName()));
            $this->updatedRecords->each(function (UpdatedEcommerceModel $record) use (&$msg) {
                $msg = $msg->newLine()->append($record->toString());
            });
            Log::info($msg);
        } else {
            $this->updatedRecords->each(function (UpdatedEcommerceModel $record) {
                $model = $record->class::find($record->id);
                $model->shopify_id = $record->shopify_id;
                $model->saveWithoutUpdatedAt();
            });
        }

        // clear out the record, just to be safe
        $this->updatedRecords = collect();
    }

    private function deleteOriginalShopifyOrder(ShopifyOrderFix $fix): bool
    {
        if ($this->simulate) {
            // no way to simulate this, so just act like it worked
            return true;
        }

        $this->shopify->deleteOrder($fix->original_shopify_order_id);

        // confirm that the deletion worked
        try {
            $this->shopify->getOrder($fix->original_shopify_order_id);
        } catch (NotFoundException $exception) {
            return true;
        }
        return false;
    }

    private function resyncCustomerPermissions(ShopifyOrderFix $fix): void
    {
        // get the associated user (if there is one)
        $user = $fix->user;
        if (is_null($user)) {
            return;
        }
        if ($this->simulate) {
            Log::info(
                sprintf(
                    '%s: syncCustomerByUser for user %s',
                    $this->getClassName(),
                    $user->id
                )
            );
            return;
        }
        $this->shopifySyncService->syncCustomerByUser($user, removeDeletedOrderPermissions: true);
    }

    public function getSkip(): int
    {
        return $this->skip;
    }

    public function getTake(): int
    {
        return $this->take;
    }

    public function getQuery(): Builder
    {
        return ShopifyOrderFix::query()
            ->toSyncWithShopify(startProcessedAt: $this->startProcessedAt, endProcessedAt: $this->endProcessedAt)
            ->orderBy('processed_at');
    }

    /**
     * @inheritDoc
     */
    protected function getIsSimulation(): bool
    {
        return false;
    }

}

/**
 * Helper class to structure a record of an ecommerce model that should be updated
 *
 * @noinspection PhpMultipleClassesDeclarationsInOneFile
 */
class UpdatedEcommerceModel
{
    public function __construct(public string $class, public int $id, public ?int $shopify_id = null)
    {
    }

    public function toString(): string
    {
        return sprintf(
            'class: %s. id: %s. shopify_id: %s',
            class_basename($this->class),
            $this->id,
            $this->shopify_id
        );
    }
}
