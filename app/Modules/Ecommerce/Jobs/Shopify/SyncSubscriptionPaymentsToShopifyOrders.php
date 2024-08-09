<?php

namespace App\Modules\Ecommerce\Jobs\Shopify;

use App\Models\ShopifySync;
use App\Modules\Ecommerce\Enums\ShopifyMetafieldKey;
use App\Modules\Ecommerce\Enums\ShopifyMetafieldNamespace;
use App\Modules\Ecommerce\Enums\ShopifyMetafieldTypes;
use App\Modules\Ecommerce\Enums\ShopifyPaymentSourceEnum;
use App\Modules\Ecommerce\Jobs\Shopify\Traits\HandlesMaskedEmailAddress;
use App\Modules\Ecommerce\Jobs\Shopify\Traits\HandlesShopifyRateLimit;
use App\Modules\Ecommerce\Jobs\Shopify\Traits\LogsShopify;
use App\Modules\Ecommerce\Models\Address;
use App\Modules\Ecommerce\Models\OrderItem;
use App\Modules\Ecommerce\Models\Payment;
use App\Modules\Ecommerce\Models\Product;
use App\Modules\Ecommerce\Models\Refund;
use App\Modules\Ecommerce\Models\Subscription;
use App\Modules\Ecommerce\Models\SubscriptionPayment;
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

class SyncSubscriptionPaymentsToShopifyOrders implements ShouldQueue
{
    use Batchable;
    use Dispatchable;
    use HandlesMaskedEmailAddress;
    use HandlesShopifyRateLimit;
    use InteractsWithQueue;
    use LogsShopify;
    use Queueable;
    use SerializesModels;

    protected const FULFILLMENT_ITEM_ID = "item_id";
    protected const SHOPIFY_FULFILLMENT_ID = "shopify_fulfillment_id";
    protected const DEFAULT_CURRENCY = "USD";
    protected const RESULTS_MESSAGE_TYPE = "message_type";
    protected const RESULTS_MESSAGE_TYPE_SUCCESS = "";
    protected const RESULTS_MESSAGE_TYPE_ERROR = "##ERROR## ";
    protected const RESULTS_MESSAGE_TYPE_WARNING = "##WARNING## ";
    protected const RESULTS_MODEL_TYPE = "model_type";
    protected const RESULTS_MODEL_TYPE_SUBSCRIPTION_PAYMENT = "Subscription Payment";
    protected const RESULTS_MODEL_TYPE_PAYMENT = "Payment";
    protected const RESULTS_MODEL_TYPE_FULFILLMENT = "Fulfillment";
    protected const RESULTS_MODEL_ID = "model_id";
    protected const RESULTS_ACTION = "action";
    protected const RESULTS_AMOUNT = "amount";
    protected const RESULTS_SHOPIFY_ID = "shopify_id";
    protected const RESULTS_FAIL_MESSAGE = "failure_message";

    /**
     * The number of seconds the job can run before timing out.
     *
     * @var int
     */
    public $timeout = 840;
    public $tries = 5;
    protected Shopify $shopify;
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
                "resource" => 'subscription_payment',
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
     * Execute the console command.
     *
     * @param  Shopify  $shopify
     * @param  TaxService  $taxService
     * @return void
     */
    public function handle(
        Shopify $shopify,
        TaxService $taxService
    ): void {
        // set DI instances that we'll need
        $this->shopify = $shopify;
        $this->taxService = $taxService;

        $this->logDebug(
            sprintf(
                "%s: running batch for subscription payments %s - %s",
                $this->getClassName(),
                $this->startAtId,
                $this->endAtId
            )
        );

        // get the subscription payments, using pagination to keep from blowing up the memory usage
        $subscriptionPayments = SubscriptionPayment::toSyncWithShopify(
            startingId: $this->startAtId,
            endingId: $this->endAtId,
            fresh: $this->fresh
        )
            // eager load the necessary relationships
            ->with(
                [
                    'subscription',
                    'subscription.user',
                    'subscription.customer',
                    'subscription.product',
                    'subscription.order',
                    'payment',
                    'payment.refunds',
                ]
            );

        $batchSize = 25;

        $totalCount = $subscriptionPayments->count();
        $infoString = "Found {$totalCount} subscription payments to be synced.";
        $infoString .= " Performing in batches of {$batchSize}.";
        $this->logInfo(sprintf("%s: %s", $this->getClassName(), $infoString));

        $subscriptionPayments->chunkById($batchSize, function (Collection $orderChunk) use (&$jobs) {
            try {
                $this->loopSync($orderChunk);
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
        return "SyncSubscriptionPaymentsToShopifyOrders";
    }

    /**
     * Perform the sync action on each subscription payment in the collection
     *
     * @param  Collection<SubscriptionPayment>  $subscriptionPayments
     * @return void
     */
    private function loopSync(Collection $subscriptionPayments): void
    {
        $subscriptionPayments->each(function (SubscriptionPayment $subscriptionPayment) {
            // safety check that the user/customer exist
            $skip = false;

            // we already check for this in our query, but we need the user or customer,
            // so do a safety check and skip if there isn't one
            if (is_null($subscriptionPayment->subscription->user) && is_null(
                $subscriptionPayment->subscription->customer
            )) {
                // something went very wrong here
                $this->logError(
                    sprintf(
                        "%s: No user or customer found for Subscription Payment ID %s. Skipping order sync.",
                        $this->getClassName(),
                        $subscriptionPayment->id
                    )
                );
                $skip = true;
            }

            if (!$skip) {
                $wasSynced = $this->syncSubscriptionPayment($subscriptionPayment);

                // safety check for the rate limit
                if ($wasSynced) {
                    $this->handleRateLimit();
                }
            }
        });
    }

    /**
     * Sync the syncSubscriptionPayment up to Shopify as an order
     *
     * @param  SubscriptionPayment  $subscriptionPayment
     * @return bool whether the order was synced or not
     */
    private function syncSubscriptionPayment(SubscriptionPayment $subscriptionPayment): bool
    {
        // STEP 1: build up the data structure
        try {
            $postData = $this->createOrderData($subscriptionPayment);
        } catch (Exception $e) {
            $this->logError(
                sprintf(
                    "%s: Failed to create order data for subscription payment %s: %s",
                    $this->getClassName(),
                    $subscriptionPayment->id,
                    $e->getMessage()
                )
            );
            // record the failure in the results then exit out for this subscription payment
            $this->results[] = [
                self::RESULTS_MESSAGE_TYPE => self::RESULTS_MESSAGE_TYPE_ERROR,
                self::RESULTS_MODEL_TYPE => self::RESULTS_MODEL_TYPE_SUBSCRIPTION_PAYMENT,
                self::RESULTS_MODEL_ID => $subscriptionPayment->id,
                self::RESULTS_ACTION => "FAILED",
                self::RESULTS_FAIL_MESSAGE => $e->getMessage()
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
                        "%s: Validation failed when sending subscription payment data to Shopify: %s",
                        $this->getClassName(),
                        $exception->getMessage()
                    )
                );
                $this->logError(
                    sprintf(
                        "%s: Please investigate for SubscriptionPayment ID %s. Attempted order data: %s",
                        $this->getClassName(),
                        $subscriptionPayment->id,
                        json_encode($postData)
                    )
                );
                // record the failure in the results then exit out for this subscription payment
                $this->results[] = [
                    self::RESULTS_MESSAGE_TYPE => self::RESULTS_MESSAGE_TYPE_ERROR,
                    self::RESULTS_MODEL_TYPE => self::RESULTS_MODEL_TYPE_SUBSCRIPTION_PAYMENT,
                    self::RESULTS_MODEL_ID => $subscriptionPayment->id,
                    self::RESULTS_ACTION => "FAILED",
                    self::RESULTS_FAIL_MESSAGE => $exception->getMessage()
                ];
                return false;
            }

            // record the shopify ID on the subscription payment
            $subscriptionPayment->shopify_id = $orderShopifyId;
            $subscriptionPayment->saveWithoutUpdatedAt();
            $this->shopifyIds->push($orderShopifyId);
            $this->results[] = [
                self::RESULTS_MESSAGE_TYPE => self::RESULTS_MESSAGE_TYPE_SUCCESS,
                self::RESULTS_MODEL_TYPE => self::RESULTS_MODEL_TYPE_SUBSCRIPTION_PAYMENT,
                self::RESULTS_MODEL_ID => $subscriptionPayment->id,
                self::RESULTS_SHOPIFY_ID => $orderShopifyId
            ];

            // STEP 4: add payments
            $this->sendPaymentsToShopify($subscriptionPayment);

            // STEP 5: add the Fulfillments and tracking
            $fulfillmentOrder = $this->getFulfillmentOrderResource($orderShopifyId);
            if (is_null($fulfillmentOrder)) {
                $this->logError(
                    sprintf(
                        "%s: Failed to retrieve Fulfillment Order Resource from Shopify for SubscriptionPayment ID %s",
                        $this->getClassName(),
                        $subscriptionPayment->id
                    )
                );
                // record the failure in the results then exit out for this subscription payment
                $this->results[] = [
                    self::RESULTS_MESSAGE_TYPE => self::RESULTS_MESSAGE_TYPE_ERROR,
                    self::RESULTS_MODEL_TYPE => self::RESULTS_MODEL_TYPE_SUBSCRIPTION_PAYMENT,
                    self::RESULTS_MODEL_ID => $subscriptionPayment->id,
                    self::RESULTS_ACTION => "FAILED",
                    self::RESULTS_FAIL_MESSAGE => "No Fulfillment Order Resource"
                ];
                return false;
            }
            // get each line item from the fulfillment order
            $lineItems = $fulfillmentOrder->getAttributes()["line_items"];
            // and for each line item...
            foreach ($lineItems as $lineItemData) {
                try {
                    $fulfillmentRecords = $this->fulfillDigitalProduct(
                        $lineItemData["fulfillment_order_id"],
                        $lineItemData["id"],
                        1
                    );
                    // ... record the fulfillment(s) made for the line item
                    if ($fulfillmentRecords) {
                        foreach ($fulfillmentRecords as $fulfillmentRecord) {
                            // record any fulfillments
                            $this->results[] = [
                                self::RESULTS_MESSAGE_TYPE => self::RESULTS_MESSAGE_TYPE_SUCCESS,
                                self::RESULTS_MODEL_TYPE => self::RESULTS_MODEL_TYPE_FULFILLMENT,
                                self::RESULTS_MODEL_ID => $fulfillmentRecord[self::FULFILLMENT_ITEM_ID],
                                self::RESULTS_SHOPIFY_ID => $fulfillmentRecord[self::SHOPIFY_FULFILLMENT_ID]
                            ];
                        }
                    }
                } catch (Exception $e) {
                    $this->logError(
                        sprintf(
                            "%s: Failed to send fulfillments data to Shopify for SubscriptionPayment ID %s: %s",
                            $this->getClassName(),
                            $subscriptionPayment->id,
                            $e->getMessage()
                        )
                    );
                }
            }
        } else {
            // simulating
            $this->results[] = [
                self::RESULTS_MESSAGE_TYPE => self::RESULTS_MESSAGE_TYPE_SUCCESS,
                self::RESULTS_MODEL_TYPE => self::RESULTS_MODEL_TYPE_SUBSCRIPTION_PAYMENT,
                self::RESULTS_MODEL_ID => $subscriptionPayment->id,
                self::RESULTS_SHOPIFY_ID => "---"
            ];

            // simulate sending the payments
            $this->sendPaymentsToShopify($subscriptionPayment);

            // simulate getting each line item from the fulfillment order
            $lineItems = $postData["line_items"];

            foreach ($lineItems as $idx => $lineItemData) {
                // get or fake the shopify id for the fulfillment order
                $fulfillmentOrderId = $idx + 5;
                // get or fake the shopify id for the fulfillment order line item
                $fulfillmentOrderLineItemId = $idx + 10;
                try {
                    $fulfillmentRecords = $this->fulfillDigitalProduct(
                        $fulfillmentOrderId,
                        $fulfillmentOrderLineItemId,
                        1
                    );

                    // record the fulfillment(s) made for the line item
                    if ($fulfillmentRecords) {
                        foreach ($fulfillmentRecords as $fulfillmentRecord) {
                            // record any fulfillments
                            $this->results[] = [
                                self::RESULTS_MESSAGE_TYPE => self::RESULTS_MESSAGE_TYPE_SUCCESS,
                                self::RESULTS_MODEL_TYPE => self::RESULTS_MODEL_TYPE_FULFILLMENT,
                                self::RESULTS_MODEL_ID => $fulfillmentRecord[self::FULFILLMENT_ITEM_ID],
                                self::RESULTS_SHOPIFY_ID => "---"
                            ];
                        }
                    }
                } catch (Exception $e) {
                    $this->logError(
                        sprintf(
                            "%s: Failed to send fulfillments data to Shopify for Subscription Payment ID %s: %s",
                            $this->getClassName(),
                            $subscriptionPayment->id,
                            $e->getMessage()
                        )
                    );
                }
            }
        }

        return true;
    }

    /**
     * Create the data to post to Shopify to create an Order
     *
     * @param  SubscriptionPayment  $subscriptionPayment
     * @return array
     * @throws Exception
     */
    private function createOrderData(SubscriptionPayment $subscriptionPayment): array
    {
        $payment = $subscriptionPayment->payment;
        $subscription = $subscriptionPayment->subscription;
        $product = $subscription->product;

        // there are many applicable subscriptions that don't have the product set, so try to get it from
        // the linked order, if possible
        if (is_null($product)) {
            $this->logDebug(sprintf("No product found for SubscriptionPayment %s. Checking Order ...", $subscriptionPayment->id));
            $orderItemProducts = $subscription->order?->orderItems->map(fn (OrderItem $orderItem) => $orderItem->product) ?? collect();
            $membershipProducts = $orderItemProducts->filter(fn (Product $product) => $product->isMembershipProduct());
            if ($membershipProducts->isNotEmpty()) {
                if ($membershipProducts->count() === 1) {
                    $product = $membershipProducts->first();
                } else {
                    // if there are multiple, we can try to match the price to the payment and use that if there's only one
                    $pricedMembershipProducts = $membershipProducts->filter(fn (Product $product) => $product->price == $payment->total_paid);
                    if ($pricedMembershipProducts->count() === 1) {
                        $product = $pricedMembershipProducts->first();
                        $this->logDebug(sprintf("Matched on price for product %s for SubscriptionPayment %s via order ...", $product->id, $subscriptionPayment->id));
                    }
                }
                // if we still couldn't set it, then there are too many options, so we can't reliably match the product
                if (is_null($product)) {
                    throw new Exception(sprintf("Multiple products found for SubscriptionPayment %s's linked order", $subscriptionPayment->id));
                } else {
                    $this->logDebug(sprintf("Found for product %s for SubscriptionPayment %s via order ...", $product->id, $subscriptionPayment->id));
                }
            }
        }

        // we need the product in order to create the requisite line_items, so exit out now if there still isn't one
        if (is_null($product)) {
            throw new Exception(sprintf("No product found for SubscriptionPayment %s", $subscriptionPayment->id));
        }

        // DEV NOTE: if the subscription payment is using a trial product (the user started a trial and continued it),
        // then we need to use the corresponding full product
        if ($product->isTrial()) {
            $product = $product->getFullProductForTrial();
        }

        // there can be a user or a customer, so simplify the logic to use a "purchaser"
        $purchaser = $subscription->user ?? $subscription->customer;
        $purchaserId = $purchaser->shopify_id;
        $purchaserEmail = $purchaser->email;

        // the payment and subscription can each have a note, but we don't want to duplicate subscription notes across
        // all entries, so only include the payment note
        $spNotes = [];
        if ($payment->note) {
            $spNotes[] = "Payment: ".$payment->note;
        }
        $spNote = implode(PHP_EOL, $spNotes) ?: null;
        /*
         * DEV NOTE: the documentation at https://shopify.dev/docs/api/admin-rest/2023-07/resources/order state that the
         * currency field is read-only, but it actually is still functional for legacy purposes (for now), and is currently
         * the only way to set the currency of an order through the Admin API. We need to set the currency on the order
         * so that any payments and/or refunds are handled in the appropriate currency.
         */
        // we need to know what currency was used, so get it from the payment
        $currency = $payment->currency ?? self::DEFAULT_CURRENCY;

        $orderData = [
            "currency" => $currency,
            "customer" => ["id" => $purchaserId],
            "email" => $this->getEmailForShopify($purchaserEmail),
            "processed_at" => $payment->created_at->toIso8601String(),
            // "tags" => "",
            // refer to https://shopify.dev/docs/apps/custom-data/metafields/types
            // we can use meta fields for stuff like our subscription payment id, etc
            "metafields" =>
                [
                    [
                        "key" => ShopifyMetafieldKey::Id->value,
                        "value" => (string)$subscriptionPayment->id,
                        "type" => ShopifyMetafieldTypes::integer->value,
                        "namespace" => ShopifyMetafieldNamespace::Model_SubscriptionPayments->value
                    ],
                    [
                        "key" => ShopifyMetafieldKey::Brand->value,
                        "value" => $subscription->brand,
                        "type" => ShopifyMetafieldTypes::single_line_text_field->value,
                        "namespace" => ShopifyMetafieldNamespace::Musora->value
                    ],
                    [
                        "key" => ShopifyMetafieldKey::PaymentSource->value,
                        "value" => $this->getPaymentSourceMetafieldValue($payment)->value,
                        "type" => ShopifyMetafieldTypes::single_line_text_field->value,
                        "namespace" => ShopifyMetafieldNamespace::Musora->value
                    ]
                ]
        ];

        // record a note that this was migrated from the old system, including the subscription payment ID, and put it first
        $migrateNote = Str::of(
            sprintf(
                "Imported from the old ecommerce system: subscription payment ID %s.",
                $subscriptionPayment->id
            )
        );
        if (empty($spNote)) {
            $notesStr = $migrateNote;
        } else {
            $notesStr = $migrateNote->newLine()->append($spNote);
        }

        // record a note if there were any refunds
        $refundNotes = null;
        $refunds = $subscriptionPayment->payment->refunds;
        $refundAmount = 0.0;
        if ($refunds->isNotEmpty()) {
            $currency = $refunds->first()->payment?->currency ?? self::DEFAULT_CURRENCY;
            $refundAmount = $refunds->sum(fn (Refund $refund) => $refund->refunded_amount);
            $refundNotes = Str::of(
                sprintf(
                    "%s %s %s applied to this subscription payment, totalling %s %s which has been discounted ".
                    "from the item in this order",
                    $refunds->count(),
                    Str::plural("refund", $refunds->count()),
                    $refunds->count() == 1 ? "was" : "were",
                    number_format($refundAmount, 2),
                    $currency
                )
            );

            // if the refunded amount exceeds the price of the product, make a special note about the loss
            if ($refundAmount > $subscription->total_price) {
                $overageNote = sprintf(
                    "NOTE: The refund exceeded the item's payment by %s %s which cannot be accounted for in Shopify.",
                    number_format($refundAmount - $subscription->total_price, 2),
                    $currency
                );
                $refundNotes = $refundNotes->newLine()->append($overageNote);
            }

            $allRefundNotes = $refunds->map(fn (Refund $refund) => $refund->note)->filter();

            if ($allRefundNotes->isNotEmpty()) {
                $refundNotes = $refundNotes->newLine()->append("Refund Notes:");
                $allRefundNotes->each(function (?string $refundNote) use (&$refundNotes) {
                    if (!empty($refundNote)) {
                        $refundNotes = $refundNotes->newLine()->append($refundNote, PHP_EOL);
                    }
                });
            }

            $refundNotes = $refundNotes->value();
        }

        $notesStr = $notesStr->newLine()->append($refundNotes);

        $orderData["note"] = $notesStr->value();

        // the proper addresses should already have been synced by the user/customer, so only use it if Shopify has it
        $address = $payment->paymentMethod?->address ?? null;
        if ($address?->shopify_id) {
            $orderData["billing_address"] = ["id" => $address->shopify_id];
        }

        // Shopify expects a line item to represent the product purchased,
        // so build up the data for the subscription's product to simulate that
        $lineItem =
            [
                "fulfillable_quantity" => 1,
                "fulfillment_service" => "manual",
                "price" => number_format($subscription->total_price, 2, '.', ''),
                "quantity" => 1,
                "requires_shipping" => false,
                "sku" => $product->sku,
                "title" => $product->name,
                "variant_id" => $product->shopify_id,
                "variant_inventory_management" => "shopify",
                "vendor" => $product->brand,
            ];

        // DEV NOTE:
        // Some of our refunds exceed the amount paid for their linked payments. This is usually because there
        // were multiple payments and the refund was simply applied to the latest payment, but it could be for
        // any reason. Shopify has strict settings to only allow a refund if the linked payment will allow it.
        // To get around this, we will not add refunds to our orders in Shopify, and instead create discounts to
        // compensate for the refunded amount.
        // If the refund exceeds the amount available by the order items, we'll just silently ignore the
        // over-refund, aside from the note handled above.
        // We only have one payment and one item, so we'll apply the discount to the one and only line item, as much
        // as we can.
        if ($refundAmount) {
            $amountToDiscount = min($refundAmount, $subscription->total_price);
            $discounts[] =
                [
                    "amount" => number_format($amountToDiscount, 2, '.', '')
                ];

            $lineItem["applied_discounts"] = $discounts;
        }

        $taxesData = $this->getTaxesData($subscription, $address);
        if (!empty($taxesData)) {
            $lineItem["tax_lines"] = [$taxesData];
        }

        // Shopify expects an array of line items so nest our data inside another array
        $orderData["line_items"] = [$lineItem];

        return $orderData;
    }

    /**
     * Get the value to use for the given payment's source
     *
     * @param  Payment  $payment
     * @return ShopifyPaymentSourceEnum
     */
    private function getPaymentSourceMetafieldValue(Payment $payment): ShopifyPaymentSourceEnum
    {
        return match ($payment->type) {
            Payment::TYPE_APPLE_SUBSCRIPTION_RENEWAL => ShopifyPaymentSourceEnum::Apple,
            Payment::TYPE_GOOGLE_SUBSCRIPTION_RENEWAL => ShopifyPaymentSourceEnum::Google,
            default => ShopifyPaymentSourceEnum::Web,
        };
    }

    /**
     * Build the array of the taxes data for the subscription's line item
     *
     * @param  Subscription  $subscription
     * @param  Address|null  $address
     * @return array
     * @throws Exception
     */
    protected function getTaxesData(Subscription $subscription, ?Address $address): array
    {
        // we need to use the Ecommerce package's tax service, which expects an Ecommerce Address Structure,
        // so create one out of our address
        $addressStruct = new AddressStructure($address?->country, $address?->region);

        // using the logic from vendor/railroad/ecommerce/src/Transformers/SubscriptionTransformer.php
        $subscriptionPricePerPayment = round($subscription->total_price, 2);
        // if it's a payment plan, remove the finance charge per payment, so it doesn't get taxed
        if (!empty($subscription->order) &&
            $subscription->type == Subscription::TYPE_PAYMENT_PLAN &&
            $subscription->total_cycles_due >= 1) {
            $price = round(($subscription->order->finance_due / $subscription->total_cycles_due), 2);
        } else {
            $price = $subscriptionPricePerPayment;
        }

        $taxPrice = $this->taxService->getTaxesDueTotal(
            $price,
            $order->shipping_due ?? 0.0,
            $addressStruct
        );

        $taxRate = $this->taxService->getProductTaxRate($addressStruct);
        if (!$taxPrice) {
            return [];
        }

        return [
            "price" => number_format($taxPrice, 2, '.', ''),
            "rate" => $taxRate
        ];
    }

    /**
     * Get the payment for this SubscriptionPayment, and send the data to Shopify to create a payment transaction,
     * recording the result's shopify_id
     *
     * @param  SubscriptionPayment  $subscriptionPayment
     * @return void
     */
    private function sendPaymentsToShopify(SubscriptionPayment $subscriptionPayment): void
    {
        $payment = $subscriptionPayment->payment;
        $amount = number_format($payment->total_paid, 2, '.', '');
        // format the data for the payment
        $paymentData =
            [
                "amount" => $amount,
                "kind" => "sale",
                // DEV NOTE: this is not documented in Shopify, but it is required
                "source" => "external"
            ];

        if ($this->getIsSimulation()) {
            $this->results[] = [
                self::RESULTS_MESSAGE_TYPE => self::RESULTS_MESSAGE_TYPE_SUCCESS,
                self::RESULTS_MODEL_TYPE => self::RESULTS_MODEL_TYPE_PAYMENT,
                self::RESULTS_MODEL_ID => $payment->id,
                self::RESULTS_AMOUNT => $amount,
                self::RESULTS_SHOPIFY_ID => "---"
            ];
            return;
        }

        try {
            $paymentResource = $this->shopify->createOrderTransaction(
                $subscriptionPayment->shopify_id,
                $paymentData
            );
            $paymentShopifyId = $paymentResource->id;
            $this->handleRateLimit();

            // record the shopify ID on the Payment
            $payment->shopify_id = $paymentShopifyId;
            $payment->saveWithoutUpdatedAt();

            $this->results[] = [
                self::RESULTS_MESSAGE_TYPE => self::RESULTS_MESSAGE_TYPE_SUCCESS,
                self::RESULTS_MODEL_TYPE => self::RESULTS_MODEL_TYPE_PAYMENT,
                self::RESULTS_MODEL_ID => $payment->id,
                self::RESULTS_AMOUNT => $amount,
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
                    "%s: Please investigate for SubscriptionPayment ID %s. Attempted order data: %s",
                    $this->getClassName(),
                    $subscriptionPayment->id,
                    json_encode($paymentData["data"])
                )
            );
            $this->results[] = [
                self::RESULTS_MESSAGE_TYPE => self::RESULTS_MESSAGE_TYPE_ERROR,
                self::RESULTS_MODEL_TYPE => self::RESULTS_MODEL_TYPE_PAYMENT,
                self::RESULTS_MODEL_ID => $payment->id,
                self::RESULTS_ACTION => "FAILED",
                self::RESULTS_FAIL_MESSAGE => $exception->getMessage()
            ];
        }
    }

    /**
     * Get the Fulfillment Order Resource from Shopify, for the given Shopify Order ID
     *
     * @param  int  $orderShopifyId
     * @return ApiResource|null
     */
    private function getFulfillmentOrderResource(int $orderShopifyId): ?ApiResource
    {
        $fulfillmentOrders = null;

        // get the fulfillment order and its status, so we can update it with our data
        if (!$this->getIsSimulation()) {
            // Shopify created an Order Fulfillment for our Order when they created it, so we need to grab that from them
            $fulfillmentOrders = $this->shopify->getOrderFulfillmentOrders($orderShopifyId);
            $this->handleRateLimit();
        }

        // there can be multiple fulfillment orders (but realistically, there will most likely only be one), so grab the last entry
        return $fulfillmentOrders?->last() ?? null;
    }

    /**
     * Handle fulfilling an order item in Shopify for a digital product.
     *
     * @param  int  $fulfillmentOrderId
     * @param  int  $fulfillmentOrderLineItemId
     * @param  int  $quantity
     * @return array<array> array of result arrays
     */
    private function fulfillDigitalProduct(
        int $fulfillmentOrderId,
        int $fulfillmentOrderLineItemId,
        int $quantity
    ): array {
        $fulfillmentRecords = [];
        $record = [
            self::FULFILLMENT_ITEM_ID => "N/A",
        ];

        $fulfillmentData = [
            "fulfillment" => [
                "notify_customer" => false
            ],
            "line_items_by_fulfillment_order" => [
                [
                    "fulfillment_order_id" => $fulfillmentOrderId,
                    "fulfillment_order_line_items" => [
                        [
                            "id" => $fulfillmentOrderLineItemId,
                            "quantity" => $quantity
                        ]
                    ]
                ]
            ]
        ];

        if ($this->getIsSimulation()) {
            $record[self::SHOPIFY_FULFILLMENT_ID] = "---";
        } else {
            $fulfillmentResult = $this->shopify->createFulfillment($fulfillmentData);
            $record[self::SHOPIFY_FULFILLMENT_ID] = $fulfillmentResult->getAttributes()["id"];
            $this->handleRateLimit();
        }
        $fulfillmentRecords[] = $record;

        return $fulfillmentRecords;
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
                "%s: results for syncing subscription payments to Shopify job %s of %s",
                $this->getClassName(),
                $this->batch()->processedJobs(),
                $this->batch()->totalJobs - 1
            )
        );

        foreach ($this->results as $result) {
            $endResult = isset($result[self::RESULTS_SHOPIFY_ID]) ? sprintf(
                "Shopify ID %s",
                $result[self::RESULTS_SHOPIFY_ID]
            ) : sprintf("%s %s", $result[self::RESULTS_ACTION], $result[self::RESULTS_FAIL_MESSAGE]);

            $amountResult = isset($result[self::RESULTS_AMOUNT]) ? sprintf(
                "Amount: %s. ",
                $result[self::RESULTS_AMOUNT]
            ) : '';

            if ($result[self::RESULTS_MESSAGE_TYPE] === self::RESULTS_MESSAGE_TYPE_ERROR) {
                $this->logError(
                    sprintf(
                        "%s%s ID: %s. %s%s",
                        $result[self::RESULTS_MESSAGE_TYPE],
                        $result[self::RESULTS_MODEL_TYPE],
                        $result[self::RESULTS_MODEL_ID],
                        $amountResult,
                        $endResult
                    )
                );
            } else {
                $this->logInfo(
                    sprintf(
                        "%s%s ID: %s. %s%s",
                        $result[self::RESULTS_MESSAGE_TYPE],
                        $result[self::RESULTS_MODEL_TYPE],
                        $result[self::RESULTS_MODEL_ID],
                        $amountResult,
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
