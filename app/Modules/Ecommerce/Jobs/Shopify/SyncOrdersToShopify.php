<?php

namespace App\Modules\Ecommerce\Jobs\Shopify;

use App\Models\ShopifySync;
use App\Modules\Ecommerce\Enums\ShopifyMetafieldKey;
use App\Modules\Ecommerce\Enums\ShopifyMetafieldNamespace;
use App\Modules\Ecommerce\Enums\ShopifyMetafieldTypes;
use App\Modules\Ecommerce\Jobs\Shopify\Traits\HandlesMaskedEmailAddress;
use App\Modules\Ecommerce\Jobs\Shopify\Traits\HandlesShopifyRateLimit;
use App\Modules\Ecommerce\Jobs\Shopify\Traits\LogsShopify;
use App\Modules\Ecommerce\Models\Order;
use App\Modules\Ecommerce\Models\OrderItem;
use App\Modules\Ecommerce\Models\OrderItemFulfillment;
use App\Modules\Ecommerce\Models\Payment;
use App\Modules\Ecommerce\Models\Refund;
use App\Modules\Ecommerce\Services\ShopifySyncService;
use Carbon\Carbon;
use Exception;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\Middleware\SkipIfBatchCancelled;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Railroad\Ecommerce\Entities\Structures\Address as AddressStructure;
use Railroad\Ecommerce\Services\TaxService;
use Signifly\Shopify\Exceptions\TooManyRequestsException;
use Signifly\Shopify\Exceptions\ValidationException;
use Signifly\Shopify\REST\Resources\ApiResource;
use Signifly\Shopify\Shopify;

class SyncOrdersToShopify implements ShouldQueue
{
    use Batchable;
    use Dispatchable;
    use HandlesMaskedEmailAddress;
    use HandlesShopifyRateLimit;
    use InteractsWithQueue;
    use LogsShopify;
    use Queueable;
    use SerializesModels;

    protected const DEFAULT_CURRENCY = "USD";
    protected const RESULTS_MESSAGE_TYPE = "message_type";
    protected const RESULTS_MESSAGE_TYPE_SUCCESS = "";
    protected const RESULTS_MESSAGE_TYPE_ERROR = "##ERROR## ";
    protected const RESULTS_MESSAGE_TYPE_WARNING = "##WARNING## ";
    protected const RESULTS_MODEL_TYPE = "model_type";
    protected const RESULTS_MODEL_TYPE_ORDER = "Order";
    protected const RESULTS_MODEL_TYPE_ORDER_ITEM = "Order Item";
    protected const RESULTS_MODEL_TYPE_ORDER_ITEM_FULFILLMENT = "Order Item Fulfillment";
    protected const RESULTS_MODEL_TYPE_PAYMENT = "Payment";
    protected const RESULTS_MODEL_ID = "model_id";
    protected const RESULTS_ACTION = "action";
    protected const RESULTS_SHOPIFY_ID = "shopify_id";
    protected const RESULTS_FAIL_MESSAGE = "failure_message";
    /**
     * The number of seconds the job can run before timing out.
     *
     * @var int
     */
    public $timeout = 840;
    public $tries = 5;
    protected ShopifySyncService $shopifySyncService;
    protected TaxService $taxService;
    protected Collection $shopifyIds;
    protected array $results = [];
    private ?ShopifySync $shopifySync;

    /**
     * Create a new job instance.
     */
    public function __construct(
        protected int $startAtId,
        protected int $endAtId,
        protected bool $simulate,
        protected bool $fresh
    ) {
        $this->shopifyIds = collect();
        $this->shopifySync = $this->createSyncLogIfExecuting();
    }

    /**
     * Create a ShopifySync log, if we're executing
     *
     * @return ShopifySync|null
     */
    protected function createSyncLogIfExecuting(): ?ShopifySync
    {
        if (!$this->getIsSimulation()) {
            return ShopifySync::create([
                "resource" => 'order',
                "started_at" => Carbon::now()
            ]);
        }
        return null;
    }

    /**
     * @inheritDoc
     */
    protected function getIsSimulation(): bool
    {
        return $this->simulate;
    }

    public function middleware(): array
    {
        return [new SkipIfBatchCancelled()];
    }

    /**
     * Execute the job
     *
     * @param  Shopify  $shopify
     * @param  ShopifySyncService  $shopifySyncService
     * @param  TaxService  $taxService
     * @return void
     */
    public function handle(
        Shopify $shopify,
        ShopifySyncService $shopifySyncService,
        TaxService $taxService,
    ): void {
        // set DI instances that we'll need
        $this->shopify = $shopify;
        $this->shopifySyncService = $shopifySyncService;
        $this->taxService = $taxService;

        $this->logDebug(
            sprintf("%s: running batch for orders %s - %s", $this->getClassName(), $this->startAtId, $this->endAtId)
        );

        // get the orders, using pagination to keep from blowing up the memory usage
        $orders = Order::toSyncWithShopify(
            startingId: $this->startAtId,
            endingId: $this->endAtId,
            fresh: $this->fresh
        )
            // eager load the necessary relationships
            ->with(
                [
                    'user',
                    'customer',
                    'orderItems',
                    'orderItems.product',
                    'orderItemFulfillments',
                    'orderItemFulfillments.orderItem'
                ]
            );

        $batchSize = 25;
        $totalCount = $orders->count();
        $infoString = "Found {$totalCount} orders to be synced.";
        $infoString .= " Performing in batches of {$batchSize}.";
        $this->logInfo(sprintf("%s: %s", $this->getClassName(), $infoString));

        $orders->chunkById($batchSize, function (Collection $orderChunk, int $chunkIndex) use (&$jobs) {
            try {
                $this->loopOrdersSync($orderChunk);
            } catch (TooManyRequestsException $exception) {
                if (app()->environment('local')) {
                    $this->logWarning('Too many requests. Sleeping for 10s...');
                    sleep(10);
                    $this->release();
                } else {
                    throw $exception;
                }
            }
        });
        $this->printResults();
        $this->finishSyncLogIfExecuting($this->shopifyIds);
    }

    /**
     * @inheritDoc
     */
    protected function getClassName(): string
    {
        return "SyncOrdersToShopify";
    }

    /**
     * Perform the sync action on each order in the collection
     *
     * @param  Collection<Order>  $orders
     * @return void
     */
    private function loopOrdersSync(Collection $orders): void
    {
        $orders->each(function (Order $order) {
            $skip = false;
            if (is_null($order->user) && is_null($order->customer)) {
                // something went very wrong here
                $this->logError(
                    sprintf(
                        "%s: No user or customer found for Order ID %s. Skipping order sync.",
                        $this->getClassName(),
                        $order->id
                    )
                );
                $skip = true;
            } else {
                $purchaser = $order->user ?? $order->customer;
                if (empty($purchaser->email)) {
                    $this->logError(
                        sprintf(
                            "%s: Purchaser has no email address for Order ID %s. Skipping order sync.",
                            $this->getClassName(),
                            $order->id
                        )
                    );
                    $skip = true;
                }
            }

            if (!$skip) {
                $wasSynced = $this->syncOrder($order);

                // safety check for the rate limit
                if ($wasSynced) {
                    $this->handleRateLimit();
                }
            }
        });
    }

    /**
     * Sync the order up to Shopify
     *
     * @param  Order  $order
     * @return bool if the order was synced with Shopify or not
     */
    private function syncOrder(Order $order): bool
    {
        // safety check: we have many bad entries carried over from the old ecommerce system, that don't have any
        // order items, which is invalid in Shopify. If we don't have any order items, skip this order
        if ($order->orderItems->isEmpty()) {
            $this->results[] = [
                self::RESULTS_MESSAGE_TYPE => self::RESULTS_MESSAGE_TYPE_WARNING,
                self::RESULTS_MODEL_TYPE => self::RESULTS_MODEL_TYPE_ORDER,
                self::RESULTS_MODEL_ID => $order->id,
                self::RESULTS_ACTION => "SKIPPED",
                self::RESULTS_FAIL_MESSAGE => "No Order Items"
            ];
            return false;
        }

        // STEP 1: build up the data structure
        try {
            $postData = $this->createOrderData($order, true);
        } catch (Exception $e) {
            $this->logError(
                sprintf(
                    "%s: Failed to find User or Customer for Order ID %s",
                    $this->getClassName(),
                    $order->id
                )
            );
            // record the failure in the results then exit out for this order
            $this->results[] = [
                self::RESULTS_MESSAGE_TYPE => self::RESULTS_MESSAGE_TYPE_ERROR,
                self::RESULTS_MODEL_TYPE => self::RESULTS_MODEL_TYPE_ORDER,
                self::RESULTS_MODEL_ID => $order->id,
                self::RESULTS_ACTION => "FAILED",
                self::RESULTS_FAIL_MESSAGE => sprintf("%s", $e->getMessage())
            ];
            return false;
        }

        // STEP 2: send the data to Shopify
        if (!$this->getIsSimulation()) {
            try {
                // STEP 3a: create the Order in Shopify
                $orderResource = $this->shopify->createOrder($postData);
                $orderShopifyId = $orderResource->id;
                $this->handleRateLimit();
            } catch (ValidationException $exception) {
                $this->logError(
                    sprintf(
                        "%s: Validation failed when sending order data to Shopify: %s",
                        $this->getClassName(),
                        $exception->getMessage()
                    )
                );
                $this->logError(
                    sprintf(
                        "%s: Please investigate for Order ID %s. Attempted order data: %s",
                        $this->getClassName(),
                        $order->id,
                        json_encode($postData)
                    )
                );
                // record the failure in the results then exit out for this order
                $this->results[] = [
                    self::RESULTS_MESSAGE_TYPE => self::RESULTS_MESSAGE_TYPE_ERROR,
                    self::RESULTS_MODEL_TYPE => self::RESULTS_MODEL_TYPE_ORDER,
                    self::RESULTS_MODEL_ID => $order->id,
                    self::RESULTS_ACTION => "FAILED",
                    self::RESULTS_FAIL_MESSAGE => $exception->getMessage()
                ];
                return false;
            }

            // record the shopify ID on the Order
            $order->shopify_id = $orderShopifyId;
            $order->saveWithoutUpdatedAt();
            $this->shopifyIds->push($orderShopifyId);
            $this->results[] = [
                self::RESULTS_MESSAGE_TYPE => self::RESULTS_MESSAGE_TYPE_SUCCESS,
                self::RESULTS_MODEL_TYPE => self::RESULTS_MODEL_TYPE_ORDER,
                self::RESULTS_MODEL_ID => $order->id,
                self::RESULTS_ACTION => "Created",
                self::RESULTS_SHOPIFY_ID => $orderShopifyId
            ];

            // STEP 4b: record the Shopify Order's Line Items as our Order Items
            $resourceLineItems = $orderResource->getAttributes()["line_items"];
            $sentLineItems = $postData["line_items"];
            foreach ($resourceLineItems as $idx => $resourceLineItem) {
                // grab the shopify id
                $lineItemShopifyId = $resourceLineItem["id"];
                // get our corresponding line item data
                $sentLineItem = $sentLineItems[$idx];
                // and get our Order Item for it
                $orderItem = OrderItem::find($sentLineItem["ecommerce_order_item_id"]);
                // and finally, save the shopify id on it
                $orderItem->shopify_id = $lineItemShopifyId;
                $orderItem->saveWithoutUpdatedAt();

                $this->results[] = [
                    self::RESULTS_MESSAGE_TYPE => self::RESULTS_MESSAGE_TYPE_SUCCESS,
                    self::RESULTS_MODEL_TYPE => self::RESULTS_MODEL_TYPE_ORDER_ITEM,
                    self::RESULTS_MODEL_ID => $sentLineItem["ecommerce_order_item_id"],
                    self::RESULTS_ACTION => "Created",
                    self::RESULTS_SHOPIFY_ID => $lineItemShopifyId
                ];
            }

            // STEP 5: add payments
            $this->sendPaymentsForOrderToShopify($order);

            // STEP 6: add the Fulfillments and tracking
            $fulfillmentOrderData = $this->getFulfillmentOrder($order);
            if (!empty($fulfillmentOrderData)) {
                $this->createShopifyFulfillmentForOrder(
                    $order,
                    $orderShopifyId,
                    $fulfillmentOrderData
                );
            } else {
                // TODO: we need to create a basic fulfillment in this case, so that we don't have any old orders
                // causing issues with ShipStation where the automation creates a fulfillment request. Refer to
                // FulfillOrdersImportedIntoShopify's completeShopifyFulfillmentOrderWithNoData for an example,
                // and be sure to mark them as delivered
                $this->logError(
                    sprintf(
                        "%s: Implement function to create basic fulfillments",
                        $this->getClassName()
                    )
                );
                return false;
            }
        } else {
            // simulating
            $order->shopify_id = $this->generateRandomId(10);
            // record the action for the order
            $this->results[] = [
                self::RESULTS_MESSAGE_TYPE => self::RESULTS_MESSAGE_TYPE_SUCCESS,
                self::RESULTS_MODEL_TYPE => self::RESULTS_MODEL_TYPE_ORDER,
                self::RESULTS_MODEL_ID => $order->id,
                self::RESULTS_ACTION => "Created",
                self::RESULTS_SHOPIFY_ID => $order->shopify_id
            ];

            // record the payment creations, but we won't actually do it
            $payments = $this->getPaymentsDataToSync($order);
            $payments->each(fn (array $paymentData) => $this->results[] = [
                self::RESULTS_MESSAGE_TYPE => self::RESULTS_MESSAGE_TYPE_SUCCESS,
                self::RESULTS_MODEL_TYPE => self::RESULTS_MODEL_TYPE_PAYMENT,
                self::RESULTS_MODEL_ID => $paymentData["id"],
                self::RESULTS_ACTION => "Created",
                self::RESULTS_SHOPIFY_ID => $order->shopify_id + $paymentData["id"]
            ]);

            $fulfillmentOrderData = $this->getFulfillmentOrder($order);

            if (!empty($fulfillmentOrderData)) {
                $this->createShopifyFulfillmentForOrder(
                    $order,
                    $order->shopify_id,
                    $fulfillmentOrderData
                );
            }
        }

        return true;
    }

    /**
     * Create the data to post to Shopify to create an Order
     *
     * @param  Order  $order
     * @param  bool  $withMetafields
     * @return array
     * @throws Exception
     */
    private function createOrderData(Order $order, bool $withMetafields): array
    {
        $purchaser = $order->user ?? $order->customer;

        /*
         * DEV NOTE: the documentation at https://shopify.dev/docs/api/admin-rest/2023-07/resources/order state that the
         * currency field is read-only, but it actually is still functional for legacy purposes (for now), and is currently
         * the only way to set the currency of an order through the Admin API. We need to set the currency on the order
         * so that any payments and/or refunds are handled in the appropriate currency.
         */
        // we need to know what currency was used, so try to find any payments for this order
        $currency = self::DEFAULT_CURRENCY;
        if ($order->payments->isNotEmpty()) {
            $currencies = $order->payments->map(fn (Payment $payment) => $payment->currency)->unique();
            // we should only have one payment per order, but do a safety check here just in case
            if ($currencies->count() > 1) {
                throw new Exception(sprintf("Multiple currencies found for Order %s. ", $order->id));
            }
            $currency = $currencies->first();
        }

        $orderData = [
            "currency" => $currency,
            "email" => $this->getEmailForShopify($purchaser->email),
            "processed_at" => $order->created_at->toIso8601String(),
            // "tags" => "",
        ];

        // only apply the Shopify customer ID if we have one
        if ($purchaser->shopify_id) {
            $orderData["customer"] = ["id" => $purchaser->shopify_id];
        }

        // record a note that this order was migrated from the old system, including the order ID, and put it first
        $migrateNote = Str::of(
            sprintf("Imported from the old ecommerce system: order ID %s.", $order->id)
        );
        if (empty($order->note)) {
            $notesStr = $migrateNote;
        } else {
            $notesStr = $migrateNote->newLine()->append($order->note);
        }

        // record a note if there were any refunds
        $refundNotes = null;

        $refunds = $order->refunds;
        $refundAmount = 0.0;
        if ($refunds->isNotEmpty()) {
            $refundAmount = $refunds->sum(fn (Refund $refund) => $refund->refunded_amount);
            $refundNotes = Str::of(
                sprintf(
                    "%s %s %s applied to this order, totalling %s %s which has been discounted ".
                    "from the item(s) purchased",
                    $refunds->count(),
                    Str::plural("refund", $refunds->count()),
                    $refunds->count() == 1 ? "was" : "were",
                    number_format($refundAmount, 2),
                    $refunds->first()->payment?->currency ?? self::DEFAULT_CURRENCY
                )
            );
            $notes = $refunds->map(fn (Refund $refund) => $refund->note)->filter();

            if ($notes->isNotEmpty()) {
                $refundNotes = $refundNotes->newLine()->append("Refund Notes:");
                $notes->each(function (?string $refundNote) use (&$refundNotes) {
                    if (!empty($refundNote)) {
                        $refundNotes = $refundNotes->newLine()->append($refundNote, PHP_EOL);
                    }
                });
            }

            $refundNotes = $refundNotes->value();
        }

        $notesStr = $notesStr->newLine()->append($refundNotes);

        $orderData["note"] = $notesStr->value();

        if ($withMetafields) {
            // refer to https://shopify.dev/docs/apps/custom-data/metafields/types
            // we can use meta fields for stuff like our order id, etc
            $orderData["metafields"] = [
                [
                    "key" => ShopifyMetafieldKey::Id->value,
                    "value" => $order->id,
                    "type" => ShopifyMetafieldTypes::integer->value,
                    "namespace" => ShopifyMetafieldNamespace::Model_Orders->value
                ],
                [
                    "key" => ShopifyMetafieldKey::Brand->value,
                    "value" => $order->brand,
                    "type" => ShopifyMetafieldTypes::single_line_text_field->value,
                    "namespace" => ShopifyMetafieldNamespace::Musora->value
                ],
            ];
        }

        if ($order->shipping_due) {
            $orderData["shipping_lines"] = [
                [
                    "code" => "N/A",
                    "title" => "MC Shipping",
                    "price" => number_format($order->shipping_due, 2, '.', '')
                ]
            ];
        }

        // the proper addresses should already have been synced by the user/customer, so only use it if Shopify has it
        if ($order->billing_address?->shopify_id) {
            $orderData["billing_address"] = ["id" => $order->billing_address->shopify_id];
        }
        if ($order->shipping_address?->shopify_id) {
            $orderData["shipping_address"] = ["id" => $order->shipping_address->shopify_id];
        }

        $orderData["line_items"] = $this->createOrderItems($order, $refundAmount);

        return $orderData;
    }

    /**
     * Create the data required for all Order Items of the Order
     *
     * @param  Order  $order
     * @param  float  $refundAmount
     * @return array
     * @throws Exception
     */
    private function createOrderItems(Order $order, float $refundAmount): array
    {
        $orderItemsData = [];
        $order->orderItems->each(
            function (OrderItem $orderItem) use (
                $order,
                &$orderItemsData,
                &$refundAmount
            ) {
                $unitPrice = $orderItem->product->isTrial() ? 0 : $orderItem->initial_price ?? 0;
                $linePrice = $unitPrice * $orderItem->quantity;
                $data = [
                    // include the shopify_id, if we have one, so we know if we're updating or creating - shopify will just ignore this
                    "shopify_id" => $orderItem->shopify_id,
                    // include our internal id, so we can reference it to update - shopify will just ignore this
                    "ecommerce_order_item_id" => $orderItem->id,
                    "fulfillable_quantity" => $orderItem->quantity,
                    "fulfillment_service" => "manual",
                    "price" => number_format($unitPrice, 2, '.', ''),
                    "quantity" => $orderItem->quantity,
                    "requires_shipping" => $orderItem->weight > 0,
                    "sku" => $orderItem->product->sku,
                    "title" => $orderItem->product->name,
                    "variant_id" => $orderItem->product->shopify_id,
                    "variant_inventory_management" => "shopify",
                    "vendor" => $order->brand,
                ];

                $hasDiscounts = false;
                $discounts = [];

                // DEV NOTE:
                // we originally made the mistake of reducing total_discounted from initial_price, but in truth our real
                // "final price" that customers paid, could be very different from this. So instead, we'll calculate a
                // discount amount by subtracting the final_price from the initial_price (or 0 for trials, so n/a).
                // Also note that the final_price is sometimes <0 (somehow?) so handle that too
                $finalPrice = max($orderItem->final_price, 0);
                $discountedAmount = $linePrice - $finalPrice;
                if ($discountedAmount > 0) {
                    $discounts[] =
                        [
                            "amount" => number_format($discountedAmount, 2, '.', '')
                        ];
                    $hasDiscounts = true;
                }

                // DEV NOTE:
                // Some of our refunds exceed the amount paid for their linked payments. This is usually because there
                // were multiple payments and the refund was simply applied to the latest payment, but it could be for
                // any reason. Shopify has strict settings to only allow a refund if the linked payment will allow it.
                // To get around this, we will not add refunds to our orders in Shopify, and instead create discounts to
                // compensate for the refunded amount.
                // If the refund exceeds the amount available by the order items, we'll just silently ignore the
                // over-refund.
                // Since payments, and refunds, aren't for specific items, we'll simply loop through the order items and
                // apply as much of the refund as possible. This may result in the refund amount spread across several items
                if ($refundAmount) {
                    $availableBalance = $linePrice - $discountedAmount;
                    if ($availableBalance) {
                        $amountToDiscount = min($refundAmount, $availableBalance);

                        $discounts[] =
                            [
                                "amount" => number_format($amountToDiscount, 2, '.', '')
                            ];

                        // reduce the amount to refund by the amount we're applying here
                        $refundAmount -= $amountToDiscount;
                    }

                    $hasDiscounts = true;
                }

                if ($hasDiscounts) {
                    $data["applied_discounts"] = $discounts;
                }

                $taxesData = $this->getTaxesData($order, $linePrice);
                if (!empty($taxesData)) {
                    $data["tax_lines"] = [$taxesData];
                }

                $orderItemsData[] = $data;
            }
        );

        return $orderItemsData;
    }

    /**
     * Build the array of the taxes data for the order
     *
     * @param  Order  $order
     * @param  float  $price
     * @return array
     * @throws Exception
     */
    protected function getTaxesData(Order $order, float $price): array
    {
        // we need to use the Ecommerce package's tax service, which expects an Ecommerce Address Structure,
        // so create one out of our billing address
        $address = new AddressStructure($order->billing_address?->country, $order->billing_address?->region);

        $taxPrice = $this->taxService->getTaxesDueTotal(
            $price,
            $order->shipping_due ?? 0.0,
            $address
        );

        $taxRate = $this->taxService->getProductTaxRate($address);
        if (!$taxPrice) {
            return [];
        }

        return [
            "price" => number_format($taxPrice, 2, '.', ''),
            "rate" => $taxRate
        ];
    }

    /**
     * Get the payments for this order, and send the data to Shopify to create a payment transaction
     * for each one, recording the result's shopify_id
     *
     * @param  Order  $order
     * @return void
     */
    private function sendPaymentsForOrderToShopify(Order $order): void
    {
        $this->getPaymentsDataToSync($order)->each(function (array $paymentData) use ($order) {
            $paymentId = $paymentData["id"];
            try {
                $paymentResource = $this->shopify->createOrderTransaction($order->shopify_id, $paymentData["data"]);
                $paymentShopifyId = $paymentResource->id;
                $this->handleRateLimit();

                // record the shopify ID on the Payment
                $paymentModel = Payment::find($paymentId);
                $paymentModel->shopify_id = $paymentShopifyId;
                $paymentModel->saveWithoutUpdatedAt();

                $this->results[] = [
                    self::RESULTS_MESSAGE_TYPE => self::RESULTS_MESSAGE_TYPE_SUCCESS,
                    self::RESULTS_MODEL_TYPE => self::RESULTS_MODEL_TYPE_PAYMENT,
                    self::RESULTS_MODEL_ID => $paymentId,
                    self::RESULTS_ACTION => "Created",
                    self::RESULTS_SHOPIFY_ID => $paymentShopifyId
                ];
            } catch (ValidationException $exception) {
                $this->logError(
                    sprintf(
                        "%s: Validation failed when sending order transaction to Shopify: %s",
                        $this->getClassName(),
                        $exception->getMessage()
                    )
                );
                $this->logError(
                    sprintf(
                        "%s: Please investigate for Order ID %s. Attempted order data: %s",
                        $this->getClassName(),
                        $order->id,
                        json_encode($paymentData["data"])
                    )
                );
                $this->results[] = [
                    self::RESULTS_MESSAGE_TYPE => self::RESULTS_MESSAGE_TYPE_ERROR,
                    self::RESULTS_MODEL_TYPE => self::RESULTS_MODEL_TYPE_PAYMENT,
                    self::RESULTS_MODEL_ID => $paymentId,
                    self::RESULTS_ACTION => "FAILED",
                    self::RESULTS_FAIL_MESSAGE => sprintf("%s", $exception->getMessage())
                ];
            }
        });
    }

    /**
     * Get all payments for this order that need to be synced up to Shopify, and transform the data into the
     * format required by Shopify
     *
     * @param  Order  $order
     * @return Collection
     */
    private function getPaymentsDataToSync(Order $order): Collection
    {
        $payments = $order->payments->filter(fn (Payment $payment) => $payment->status === Payment::STATUS_PAID);
        if (!$this->fresh) {
            $payments = $order->payments->filter(fn (Payment $payment) => is_null($payment->shopify_id));
        }

        return $payments->transform(function (Payment $payment) {
            return
                [
                    "id" => $payment->id,
                    "data" =>
                        [
                            "amount" => number_format($payment->total_paid, 2, '.', ''),
                            "kind" => "sale",
                            // DEV NOTE: this is not documented in Shopify, but it is required
                            "source" => "external"
                        ]
                ];
        });
    }

    /**
     * Get the Fulfillment Order Resource from Shopify, for this Order
     *
     * @param  Order  $order
     * @return ?array
     */
    private function getFulfillmentOrder(Order $order): ?array
    {
        // if we're simulating, create a response that would be like what Shopify provides
        if ($this->getIsSimulation()) {
            // build up the key pieces we care about
            $fulfillment_order_id = $this->generateRandomId(10);
            $shop_id = $this->generateRandomId(10);
            $response = [
                'id' => $fulfillment_order_id,
                'shop_id' => $shop_id,
                'order_id' => $this->generateRandomId(10),
                'assigned_location_id' => $this->generateRandomId(10),
                'status' => "open",
            ];
            $lineItems = [];
            $order->orderItems->each(
                function (OrderItem $orderItem) use ($fulfillment_order_id, $shop_id, &$lineItems) {
                    $lineItems[] = [
                        "id" => $this->generateRandomId(10),
                        "shop_id" => $shop_id,
                        "fulfillment_order_id" => $fulfillment_order_id,
                        "quantity" => $orderItem->quantity,
                        "line_item_id" => $orderItem->id,
                        "fulfillable_quantity" => $orderItem->quantity,
                    ];
                }
            );
            $response['line_items'] = $lineItems;
            return $response;
        }

        $orderShopifyId = $order->shopify_id;

        // Shopify created an Order Fulfillment for our Order when they created it. We need to grab that from them, so we can update it with our data
        $fulfillmentOrders = $this->shopify->getOrderFulfillmentOrders($orderShopifyId);
        $this->handleRateLimit();

        // an order can have 1 or more (should never have 0, but handle it just in case)
        if ($fulfillmentOrders->isEmpty()) {
            $this->logError(
                sprintf(
                    "%s: Failed to retrieve Fulfillment Order Resource from Shopify for Order ID %s",
                    $this->getClassName(),
                    $order->id
                )
            );
            $this->results[] = [
                self::RESULTS_MESSAGE_TYPE => self::RESULTS_MESSAGE_TYPE_ERROR,
                self::RESULTS_MODEL_TYPE => self::RESULTS_MODEL_TYPE_ORDER,
                self::RESULTS_MODEL_ID => $order->id,
                self::RESULTS_ACTION => "FAILED",
                self::RESULTS_FAIL_MESSAGE => "No Fulfillment Order Resource"
            ];
            return null;
        }

        $fulfillmentOrders->transform(function (ApiResource $resource) {
            return $resource->getAttributes();
        });

        // get the OrderFulfillmentOrders that are still open
        $openFulFillmentOrders = $fulfillmentOrders->filter(function (array $attributes) {
            return $attributes['status'] == 'open' || $attributes['status'] == 'in_progress';
        });

        // realistically, we only expect one open fulfillment. If there are multiple, just flag it to be done manually
        if ($openFulFillmentOrders->count() > 1) {
            $this->results[] = [
                self::RESULTS_MESSAGE_TYPE => self::RESULTS_MESSAGE_TYPE_ERROR,
                self::RESULTS_MODEL_TYPE => self::RESULTS_MODEL_TYPE_ORDER,
                self::RESULTS_MODEL_ID => $order->id,
                self::RESULTS_ACTION => "FAILED",
                self::RESULTS_FAIL_MESSAGE => "Multiple open Order Fulfillment Orders"
            ];
            return null;
        }

        return $openFulFillmentOrders->first();
    }

    /**
     * Generate a random string of numbers, to replicate an ID
     *
     * @param  int  $numDigits
     * @return int
     */
    private function generateRandomId(int $numDigits): int
    {
        $number = "";
        for ($i = 0; $i < $numDigits; $i++) {
            $min = ($i == 0) ? 1 : 0;
            $number .= mt_rand($min, 9);
        }
        return intval($number);
    }

    /**
     * Get all applicable fulfillments for the given order, and send the data to Shopify to have it create
     * a fulfillment with the information for our own fulfillments.
     *
     * @param  Order  $order
     * @param  string  $shopifyOrderNumber
     * @param  array  $shopifyOrderFulfillmentOrderData
     * @return void
     */
    private function createShopifyFulfillmentForOrder(
        Order $order,
        string $shopifyOrderNumber,
        array $shopifyOrderFulfillmentOrderData
    ): void {
        $fulfillmentOrderId = $shopifyOrderFulfillmentOrderData['id'];
        $shopifyOrderId = $shopifyOrderFulfillmentOrderData['order_id'];

        // our order item fulfillments for this order, that need to be synced.
        // Keep a collection of them all, so we can group them by the tracking information, instead of creating a new
        // Shopify fulfillment for each one.
        $orderItemFulfillmentsToSync = collect();

        // we recorded the shopify id of the line_item on our ecommerce_order_items, so we can match them here
        foreach ($shopifyOrderFulfillmentOrderData['line_items'] as $shopifyOrderFulfillmentLineItemData) {
            // the id of the fulfillment order line item (the fulfillment for the line item)
            $fulfillmentOrderLineItemId = $shopifyOrderFulfillmentLineItemData['id'];

            // we've recorded this on our line_item, so use it to find ours
            if ($this->getIsSimulation()) {
                // in the simulated response for the getFulfillmentOrder, we set the line_item_id to be our internal ID, instead of Shopify's
                $orderItem = OrderItem::find($shopifyOrderFulfillmentLineItemData['line_item_id']);
            } else {
                $orderItem = OrderItem::firstWhere('shopify_id', $shopifyOrderFulfillmentLineItemData['line_item_id']);
            }
            // check if the order item is for a digital product, because we don't have fulfillments for them
            if ($orderItem->product->isDigital() ?? false) {
                $fakedFulfillment = new OrderItemFulfillment();
                $fakedFulfillment->order_id = $order->id;
                $fakedFulfillment->order_item_id = $orderItem->id;
                $fakedFulfillment->company = null;
                $fakedFulfillment->tracking_number = null;
                $fakedFulfillment->fulfillmentOrderLineItemId = $fulfillmentOrderLineItemId;
                // DEV NOTE: don't save! We're just faking this in-memory
                $orderItemFulfillmentsToSync->push($fakedFulfillment);
            } else {
                $orderItemFulfillments = $order->orderItemFulfillments;
                // we'll need the fulfillmentOrderLineItemId when we build the payload, so add it to each order item fulfillment
                $orderItemFulfillments->each(
                    fn (
                        OrderItemFulfillment $fulfillment
                    ) => $fulfillment->fulfillmentOrderLineItemId = $fulfillmentOrderLineItemId
                );
                $orderItemFulfillments->each(
                    fn (OrderItemFulfillment $fulfillment) => $orderItemFulfillmentsToSync->push($fulfillment)
                );
            }
        }

        if ($orderItemFulfillmentsToSync->isEmpty()) {
            return;
        }
        // we have some order item fulfillments to sync, so group them by the tracking information,
        // and create fulfillment data for each grouping
        $grouped = $orderItemFulfillmentsToSync->groupBy(
            fn ($fulfillment) => "$fulfillment->company-$fulfillment->tracking_number"
        );

        $grouped->each(
            function (Collection $fulfillments) use ($shopifyOrderNumber, $shopifyOrderId, $fulfillmentOrderId) {
                $shopifyFulfillmentData = [
                    "notify_customer" => false,
                    "status" => "success",
                ];

                // only add tracking info if there is some
                if ($fulfillments->first()->company || $fulfillments->first()->tracking_number) {
                    $shopifyFulfillmentData["tracking_info"] = [
                        "company" => $fulfillments->first()->company,
                        "number" => $fulfillments->first()->tracking_number
                    ];
                }

                // array for the line_items_by_fulfillment_order data
                $lineItemData = [];
                // keep track of the order item fulfillments, so we can apply the shopify id to it after creating the fulfillment
                $orderItemFulfillmentsToUpdate = [];

                $fulfillments->each(function (OrderItemFulfillment $orderItemFulfillment) use (
                    $shopifyOrderId,
                    $shopifyOrderNumber,
                    $fulfillmentOrderId,
                    &$lineItemData,
                    &$orderItemFulfillmentsToUpdate
                ) {
                    $lineItemData[] = [
                        "fulfillment_order_id" => $fulfillmentOrderId,
                        "fulfillment_order_line_items" => [
                            [
                                'id' => $orderItemFulfillment->fulfillmentOrderLineItemId,
                                'quantity' => $orderItemFulfillment->orderItem->quantity
                            ]
                        ]
                    ];

                    // remove the temp storage of fulfillmentOrderLineItemId
                    unset($orderItemFulfillment->fulfillmentOrderLineItemId);

                    $orderItemFulfillmentsToUpdate[] = $orderItemFulfillment;
                });

                $shopifyFulfillmentData['line_items_by_fulfillment_order'] = $lineItemData;

                if ($this->simulate) {
                    // record the faked fulfillments
                    $fulfillments->each(function (OrderItemFulfillment $orderItemFulfillment) {
                        $this->results[] = [
                            self::RESULTS_MESSAGE_TYPE => self::RESULTS_MESSAGE_TYPE_SUCCESS,
                            self::RESULTS_MODEL_TYPE => self::RESULTS_MODEL_TYPE_ORDER_ITEM_FULFILLMENT,
                            self::RESULTS_MODEL_ID => $orderItemFulfillment->id ?? "N/A for digital product",
                            self::RESULTS_ACTION => "Created",
                            self::RESULTS_SHOPIFY_ID => "---"
                        ];
                    });
                } else {
                    $fulfillmentResult = $this->shopify->createFulfillment($shopifyFulfillmentData);
                    $this->handleRateLimit();

                    $fulfillmentId = $fulfillmentResult->getAttributes()["id"];
                    // store the shopify id on our order item fulfillment
                    foreach ($orderItemFulfillmentsToUpdate as $orderItemFulfillment) {
                        // only add if it's an existing order item fulfillment (not one of our fakes)
                        if ($orderItemFulfillment->id) {
                            $orderItemFulfillment->shopify_id = $fulfillmentId;
                            $orderItemFulfillment->saveWithoutUpdatedAt();
                        }

                        // and record the result
                        $this->results[] = [
                            self::RESULTS_MESSAGE_TYPE => self::RESULTS_MESSAGE_TYPE_SUCCESS,
                            self::RESULTS_MODEL_TYPE => self::RESULTS_MODEL_TYPE_ORDER_ITEM_FULFILLMENT,
                            self::RESULTS_MODEL_ID => $orderItemFulfillment->id ?? "N/A for digital product",
                            self::RESULTS_ACTION => "Created",
                            self::RESULTS_SHOPIFY_ID => $fulfillmentId
                        ];
                    }

                    try {
                        $this->shopifySyncService->markFulfillmentAsDelivered($shopifyOrderId, $fulfillmentId);
                    } catch (ValidationException|Exception $e) {
                        $this->logError(
                            sprintf(
                                "%s: %s",
                                $this->getClassName(),
                                $e->getMessage()
                            )
                        );
                    }
                    $this->handleRateLimit();
                }
            }
        );
    }



    /**
     * Print out the results in an Info log
     *
     * @return void
     */
    protected function printResults(): void
    {
        // print the results
        $this->logInfo(
            sprintf(
                "%s: results for syncing orders to Shopify job %s of %s",
                $this->getClassName(),
                $this->batch()->processedJobs(),
                $this->batch()->totalJobs - 1
            )
        );

        foreach ($this->results as $result) {
            $endResult = isset($result[self::RESULTS_SHOPIFY_ID]) ? sprintf(
                "Shopify ID %s",
                $result[self::RESULTS_SHOPIFY_ID]
            ) : $result[self::RESULTS_FAIL_MESSAGE];

            if ($result[self::RESULTS_MESSAGE_TYPE] === self::RESULTS_MESSAGE_TYPE_ERROR) {
                $this->logError(
                    sprintf(
                        "%s%s ID: %s. %s %s",
                        $result[self::RESULTS_MESSAGE_TYPE],
                        $result[self::RESULTS_MODEL_TYPE],
                        $result[self::RESULTS_MODEL_ID],
                        $result[self::RESULTS_ACTION],
                        $endResult
                    )
                );
            } else {
                $this->logInfo(
                    sprintf(
                        "%s%s ID: %s. %s %s",
                        $result[self::RESULTS_MESSAGE_TYPE],
                        $result[self::RESULTS_MODEL_TYPE],
                        $result[self::RESULTS_MODEL_ID],
                        $result[self::RESULTS_ACTION],
                        $endResult
                    )
                );
            }
        }
    }

    /**
     * Finish the sync log and store the Shopify IDs
     *
     * @param  Collection  $shopifyIds
     * @return void
     */
    protected function finishSyncLogIfExecuting(Collection $shopifyIds): void
    {
        if (!$this->getIsSimulation()) {
            $this->shopifySync->update([
                "finished_at" => Carbon::now(),
                "shopify_ids" => $shopifyIds->toArray()
            ]);
        }
    }
}
