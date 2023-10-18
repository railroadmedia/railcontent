<?php

namespace App\Modules\Ecommerce\Jobs\Shopify;

use App\Modules\Ecommerce\Enums\ShopifyMetafieldKey;
use App\Modules\Ecommerce\Enums\ShopifyMetafieldNamespace;
use App\Modules\Ecommerce\Enums\ShopifyMetafieldTypes;
use App\Modules\Ecommerce\Enums\ShopifyPaymentSourceEnum;
use App\Modules\Ecommerce\Jobs\Shopify\Traits\HandlesMaskedEmailAddress;
use App\Modules\Ecommerce\Jobs\Shopify\Traits\HandlesShopifyRateLimit;
use App\Modules\Ecommerce\Jobs\Shopify\Traits\LogsShopify;
use App\Modules\Ecommerce\Jobs\Shopify\Traits\SyncsToShopify;
use Carbon\Carbon;
use Doctrine\ORM\EntityNotFoundException;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Tools\Pagination\Paginator;
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
use Modules\UserManagementSystem\Models\User;
use Railroad\Ecommerce\Entities\Payment;
use Railroad\Ecommerce\Entities\Refund;
use Railroad\Ecommerce\Entities\SubscriptionPayment;
use Railroad\Ecommerce\Managers\EcommerceEntityManager;
use Railroad\Ecommerce\Repositories\CustomerRepository;
use Railroad\Ecommerce\Repositories\RefundRepository;
use Railroad\Ecommerce\Repositories\RepositoryBase;
use Railroad\Ecommerce\Repositories\SubscriptionPaymentRepository;
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
    use SyncsToShopify;

    protected const SHOPIFY_FULFILLMENT_ID = "shopify_fulfillment_id";
    protected const DEFAULT_CURRENCY = "USD";
    protected const RESULTS_MESSAGE_TYPE = "message_type";
    protected const RESULTS_MESSAGE_TYPE_SUCCESS = "";
    protected const RESULTS_MESSAGE_TYPE_ERROR = "##ERROR## ";
    protected const RESULTS_MESSAGE_TYPE_WARNING = "##WARNING## ";
    protected const RESULTS_MODEL_TYPE = "model_type";
    protected const RESULTS_MODEL_TYPE_SUBSCRIPTION_PAYMENT = "Subscription Payment";
    protected const RESULTS_MODEL_TYPE_PAYMENT = "Payment";
    protected const RESULTS_MODEL_TYPE_REFUND = "Refund";
    protected const RESULTS_MODEL_TYPE_FULFILLMENT = "Fulfillment";
    protected const RESULTS_MODEL_ID = "model_id";
    protected const RESULTS_ACTION = "action";
    protected const RESULTS_AMOUNT = "amount";
    protected const RESULTS_SHOPIFY_ID = "shopify_id";
    protected const RESULTS_FAIL_MESSAGE = "failure_message";
    protected const FULFILLMENT_ITEM_ID = "item_id";

    /**
     * The number of seconds the job can run before timing out.
     *
     * @var int
     */
    public $timeout = 840;
    protected Shopify $shopify;
    protected CustomerRepository $customerRepository;
    protected RefundRepository $refundRepository;
    protected SubscriptionPaymentRepository $subscriptionPaymentRepository;

    protected EcommerceEntityManager $entityManager;
    protected Collection $shopifyIds;
    protected array $results = [];

    /**
     * Create a new job instance.
     */
    public function __construct(
        protected int $startAtId,
        protected int $endAtId,
        protected Carbon $lastSyncAt,
        protected bool $simulate,
        protected bool $fresh
    ) {
        $this->shopifyIds = collect();
    }

    public function middleware(): array
    {
        return [new SkipIfBatchCancelled];
    }

    /**
     * Execute the console command.
     *
     * @param Shopify $shopify
     * @param CustomerRepository $customerRepository
     * @param RefundRepository $refundRepository
     * @param SubscriptionPaymentRepository $subscriptionPaymentRepository
     * @param EcommerceEntityManager $entityManager
     * @return void
     */
    public function handle(
        Shopify $shopify,
        CustomerRepository $customerRepository,
        RefundRepository $refundRepository,
        SubscriptionPaymentRepository $subscriptionPaymentRepository,
        EcommerceEntityManager $entityManager
    ): void {
        // set DI instances that we'll need
        $this->shopify = $shopify;
        $this->customerRepository = $customerRepository;
        $this->refundRepository = $refundRepository;
        $this->subscriptionPaymentRepository = $subscriptionPaymentRepository;
        $this->entityManager = $entityManager;

        $this->logDebug(
            sprintf(
                "%s: running batch for subscription payments %s - %s",
                $this->getClassName(),
                $this->startAtId,
                $this->endAtId
            )
        );

        // DEV NOTE: we do not use the SyncsToShopify sync() here. With the huge number of Subscription Payments in our
        // database, we need to loop through in batches, instead of the usual process in SyncsToShopify.
        $this->notifyStartupStatus();
        $batchSize = 25;

        $this->loopSync($batchSize);
    }

    /**
     * @inheritDoc
     */
    protected function getClassName(): string
    {
        return "SyncSubscriptionPaymentsToShopifyOrders";
    }

    /**
     * Get all the Subscription Payments that need to be synced, and perform the sync action on each one
     *
     * @param int $batchSize
     * @return void
     */
    private function loopSync(int $batchSize): void
    {
        $fresh = $this->getIsFresh();

        // get the subscription payments, using pagination to keep from blowing up the memory usage
        $qb = $this->subscriptionPaymentRepository->createQueryBuilder('entity');

        // DEV NOTE: the subscription_payments table also has payments that are covered as orders.
        // To avoid duplications in the shopify sync, we need to restrict our query to only those that
        // are not for an initial_order type, and that are paid (so we don't try to sync up failed payments)
        $paymentQB = new QueryBuilder($this->entityManager);
        $qb->where($qb->expr()->between('entity.id', ':startingSubscriptionPaymentId', ':endingSubscriptionPaymentId'))
            ->andWhere(
                $qb->expr()->in(
                    "entity.payment",
                    $paymentQB->select("p.id")
                        ->from(Payment::class, "p")
                        ->where(
                            $paymentQB->expr()
                                ->eq("p.status", ":paidStatus")
                        )->andWhere(
                            $paymentQB->expr()
                                ->neq("p.type", ":initialOrderType")
                        )
                        ->getDQL()
                )
            )
            ->setParameter("startingSubscriptionPaymentId", $this->startAtId)
            ->setParameter("endingSubscriptionPaymentId", $this->endAtId)
            ->setParameter("paidStatus", Payment::STATUS_PAID)
            ->setParameter("initialOrderType", Payment::TYPE_INITIAL_ORDER);

        if (!$fresh) {
            $nullOrUpdated = $qb->expr()->orX();
            $nullOrUpdated->add($qb->expr()->isNull("entity.shopifyId"));
            $nullOrUpdated->add($qb->expr()->gt("entity.updatedAt", ":lastSyncAt"));
            $qb->andWhere($nullOrUpdated)->setParameter("lastSyncAt", $this->lastSyncAt);
        }

        $q = $qb->getQuery();
        $paginator = new Paginator($q);

        $totalCount = count($paginator);

        $infoString = "Found {$totalCount} subscription payments to be synced.";
        $infoString .= " Performing in batches of {$batchSize}.";
        $this->logInfo(sprintf("%s: %s", $this->getClassName(), $infoString));

        foreach ($paginator as $index => $subscriptionPayment) {
            // starting the batch
            if ($index % $batchSize === 0) {
                $this->shopifyIds = collect();
                $this->createSyncLogIfExecuting();
            }

            // TODO: remove this check once all users/customers have been synced
            $user = $subscriptionPayment->getSubscription()->getUser();
            $customer = $subscriptionPayment->getSubscription()->getCustomer();
            $skip = false;
            if (!is_null($user)) {
                // the user is returned with only their id and email, so get the id and get a fresh copy
                try {
                    $user = User::find($user->getId());
                    if (is_null($user->shopify_id)) {
                        $this->results[] = [
                            self::RESULTS_MESSAGE_TYPE => self::RESULTS_MESSAGE_TYPE_WARNING,
                            self::RESULTS_MODEL_TYPE => self::RESULTS_MODEL_TYPE_SUBSCRIPTION_PAYMENT,
                            self::RESULTS_MODEL_ID => $subscriptionPayment->getId(),
                            self::RESULTS_ACTION => "SKIPPED",
                            self::RESULTS_FAIL_MESSAGE => "User has not been synced to Shopify"
                        ];
                        $skip = true;
                    }
                } catch (ORMException $e) {
                    $this->logError(sprintf("%s: Could not find user by ID %s", $this->getClassName(), $user->getId()));
                    $this->results[] = [
                        self::RESULTS_MESSAGE_TYPE => self::RESULTS_MESSAGE_TYPE_WARNING,
                        self::RESULTS_MODEL_TYPE => self::RESULTS_MODEL_TYPE_SUBSCRIPTION_PAYMENT,
                        self::RESULTS_MODEL_ID => $subscriptionPayment->getId(),
                        self::RESULTS_ACTION => "SKIPPED",
                        self::RESULTS_FAIL_MESSAGE => "User not found"
                    ];
                    $skip = true;
                }
            } elseif (!is_null($customer)) {
                // the customer is returned with only their id and email, so get the id and get a fresh copy
                try {
                    $customer = $this->customerRepository->find($customer->getId());
                    if (is_null($customer->getShopifyId())) {
                        $this->results[] = [
                            self::RESULTS_MESSAGE_TYPE => self::RESULTS_MESSAGE_TYPE_WARNING,
                            self::RESULTS_MODEL_TYPE => self::RESULTS_MODEL_TYPE_SUBSCRIPTION_PAYMENT,
                            self::RESULTS_MODEL_ID => $subscriptionPayment->getId(),
                            self::RESULTS_ACTION => "SKIPPED",
                            self::RESULTS_FAIL_MESSAGE => "Customer has not been synced to Shopify"
                        ];
                        $skip = true;
                    }
                } catch (ORMException $e) {
                    $this->logError(
                        sprintf("%s: Could not find customer by ID %s", $this->getClassName(), $customer->getId())
                    );
                    $this->results[] = [
                        self::RESULTS_MESSAGE_TYPE => self::RESULTS_MESSAGE_TYPE_WARNING,
                        self::RESULTS_MODEL_TYPE => self::RESULTS_MODEL_TYPE_SUBSCRIPTION_PAYMENT,
                        self::RESULTS_MODEL_ID => $subscriptionPayment->getId(),
                        self::RESULTS_ACTION => "SKIPPED",
                        self::RESULTS_FAIL_MESSAGE => "Customer not found"
                    ];
                    $skip = true;
                }
            } else {
                // something went very wrong here
                $this->logError(
                    sprintf(
                        "%s: No user or customer found for Subscription Payment ID %s. Skipping order sync.",
                        $this->getClassName(),
                        $subscriptionPayment->getId()
                    )
                );
                $skip = true;
            }

            if (!$skip) {
                $wasSynced = $this->syncSubscriptionPayment($subscriptionPayment, $fresh);

                // safety check for the rate limit
                if ($wasSynced) {
                    $this->handleRateLimit();
                }
            }

            // batch has ended
            if (($index % $batchSize === $batchSize - 1) || $index + 1 === $totalCount) {
                // print the results
                $this->logInfo(
                    sprintf(
                        "%s: results for syncing orders to Shopify job %s of %s",
                        $this->getClassName(),
                        $this->batch()->processedJobs() + 1,
                        $this->batch()->totalJobs
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

                // finish the sync log
                $this->finishSyncLogIfExecuting($this->shopifyIds);
                // and clear the results for the next run
                $this->results = [];
            }
        }
    }

    /**
     * @inheritDoc
     */
    protected function getIsFresh(): bool
    {
        return $this->fresh;
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
                    $subscriptionPayment->getId(),
                    $e->getMessage()
                )
            );
            // record the failure in the results then exit out for this subscription payment
            $this->results[] = [
                self::RESULTS_MESSAGE_TYPE => self::RESULTS_MESSAGE_TYPE_ERROR,
                self::RESULTS_MODEL_TYPE => self::RESULTS_MODEL_TYPE_SUBSCRIPTION_PAYMENT,
                self::RESULTS_MODEL_ID => $subscriptionPayment->getId(),
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
                        $subscriptionPayment->getId(),
                        json_encode($postData)
                    )
                );
                // record the failure in the results then exit out for this subscription payment
                $this->results[] = [
                    self::RESULTS_MESSAGE_TYPE => self::RESULTS_MESSAGE_TYPE_ERROR,
                    self::RESULTS_MODEL_TYPE => self::RESULTS_MODEL_TYPE_SUBSCRIPTION_PAYMENT,
                    self::RESULTS_MODEL_ID => $subscriptionPayment->getId(),
                    self::RESULTS_ACTION => "FAILED",
                    self::RESULTS_FAIL_MESSAGE => $exception->getMessage()
                ];
                return false;
            }

            try {
                // record the shopify ID on the subscription payment
                if ($subscriptionPayment->getShopifyId() !== $orderShopifyId) {
                    // grab the eloquent model, so we can update it
                    $subscriptionPaymentModel = \App\Modules\Ecommerce\Models\SubscriptionPayment::find(
                        $subscriptionPayment->getId()
                    );
                    $subscriptionPaymentModel->shopify_id = $orderShopifyId;
                    $subscriptionPaymentModel->saveWithoutUpdatedAt();
                    // refresh the doctrine model to get the change
                    $this->entityManager->refresh($subscriptionPayment);
                }
                $this->shopifyIds->push($orderShopifyId);
                $this->results[] = [
                    self::RESULTS_MESSAGE_TYPE => self::RESULTS_MESSAGE_TYPE_SUCCESS,
                    self::RESULTS_MODEL_TYPE => self::RESULTS_MODEL_TYPE_SUBSCRIPTION_PAYMENT,
                    self::RESULTS_MODEL_ID => $subscriptionPayment->getId(),
                    self::RESULTS_SHOPIFY_ID => $orderShopifyId
                ];
            } catch (\Doctrine\ORM\Exception\ORMException $e) {
                $this->logError(
                    sprintf(
                        "%s: Failed to save shopify_id for SubscriptionPayment ID %s: %s",
                        $this->getClassName(),
                        $subscriptionPayment->getId(),
                        $e->getMessage()
                    )
                );
            }

            // STEP 4: add payments
            $this->sendPaymentsToShopify($subscriptionPayment);

            // STEP 5: add the Fulfillments and tracking
            $fulfillmentOrder = $this->getFulfillmentOrderResource($orderShopifyId);
            if (is_null($fulfillmentOrder)) {
                $this->logError(
                    sprintf(
                        "%s: Failed to retrieve Fulfillment Order Resource from Shopify for SubscriptionPayment ID %s",
                        $this->getClassName(),
                        $subscriptionPayment->getId()
                    )
                );
                // record the failure in the results then exit out for this subscription payment
                $this->results[] = [
                    self::RESULTS_MESSAGE_TYPE => self::RESULTS_MESSAGE_TYPE_ERROR,
                    self::RESULTS_MODEL_TYPE => self::RESULTS_MODEL_TYPE_SUBSCRIPTION_PAYMENT,
                    self::RESULTS_MODEL_ID => $subscriptionPayment->getId(),
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
                            $subscriptionPayment->getId(),
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
                self::RESULTS_MODEL_ID => $subscriptionPayment->getId(),
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
                            $subscriptionPayment->getId(),
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
     * @param SubscriptionPayment $subscriptionPayment
     * @return array
     * @throws ORMException
     * @throws Exception
     */
    private function createOrderData(SubscriptionPayment $subscriptionPayment): array
    {
        $payment = $subscriptionPayment->getPayment();
        $subscription = $subscriptionPayment->getSubscription();
        $product = $subscription->getProduct();
        // $subscription->getProduct() can be null, and we need the product in order to create the requisite line_items
        // so if we don't have a product, exit out now
        if (is_null($product)) {
            throw new Exception(sprintf("No product found for SubscriptionPayment %s", $subscriptionPayment->getId()));
        }

        // the user or customer is returned with only their id and email, so get the id and get a fresh copy
        if ($subscription->getUser()) {
            $purchaser = User::find($subscription->getUser()->getId());
            $purchaserId = $purchaser->shopify_id;
            $purchaserEmail = $purchaser->email;
        } else {
            $purchaser = $this->customerRepository->find($subscription->getCustomer()->getId());
            $purchaserId = $purchaser->getShopifyId();
            $purchaserEmail = $purchaser->getEmail();
        }

        // the payment and subscription can each have a note, so build one out of both
        $spNotes = [];
        if ($subscription->getNote()) {
            $spNotes[] = "Subscription: " . $subscription->getNote();
        }
        if ($payment->getNote()) {
            $spNotes[] = "Payment: " . $payment->getNote();
        }
        $note = implode(PHP_EOL, $spNotes) ?: null;
        /*
         * DEV NOTE: the documentation at https://shopify.dev/docs/api/admin-rest/2023-07/resources/order state that the
         * currency field is read-only, but it actually is still functional for legacy purposes (for now), and is currently
         * the only way to set the currency of an order through the Admin API. We need to set the currency on the order
         * so that any payments and/or refunds are handled in the appropriate currency.
         */
        // we need to know what currency was used, so get it from the payment
        $currency = $payment->getCurrency() ?? self::DEFAULT_CURRENCY;

        $orderData = [
            "currency" => $currency,
            "customer" => ["id" => $purchaserId],
            "email" => $this->getEmailForShopify($purchaserEmail),
            "processed_at" => (new Carbon($subscriptionPayment->getCreatedAt()))->toIso8601String(),
            // "tags" => "",
            // refer to https://shopify.dev/docs/apps/custom-data/metafields/types
            // we can use meta fields for stuff like our subscription payment id, etc
            "metafields" =>
                array(
                    [
                        "key" => ShopifyMetafieldKey::Id,
                        "value" => (string)$subscriptionPayment->getId(),
                        "type" => ShopifyMetafieldTypes::integer,
                        "namespace" => ShopifyMetafieldNamespace::Model_SubscriptionPayments
                    ],
                    [
                        "key" => ShopifyMetafieldKey::Brand,
                        "value" => $subscription->getBrand(),
                        "type" => ShopifyMetafieldTypes::single_line_text_field,
                        "namespace" => ShopifyMetafieldNamespace::Musora
                    ],
                    [
                        "key" => ShopifyMetafieldKey::PaymentSource,
                        "value" => $this->getPaymentSourceMetafieldValue($payment)->value,
                        "type" => ShopifyMetafieldTypes::single_line_text_field,
                        "namespace" => ShopifyMetafieldNamespace::Musora
                    ]
                )
        ];

        // record a note if there were any refunds
        $refundNotes = null;
        $refunds = $this->getRefundsForSubscriptionPayment($subscriptionPayment);
        $refundAmount = 0.0;
        if ($refunds->isNotEmpty()) {
            $currency = $refunds->first()->getPayment()?->getCurrency() ?? self::DEFAULT_CURRENCY;
            $refundAmount = $refunds->sum(fn(Refund $refund) => $refund->getRefundedAmount());
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
            if ($refundAmount > $subscription->getTotalPrice()) {
                $overageNote = sprintf(
                    "NOTE: The refund exceeded the item's payment by %s %s which cannot be accounted for in Shopify.",
                    number_format($refundAmount - $subscription->getTotalPrice(), 2),
                    $currency
                );
                $refundNotes = $refundNotes->newLine()->append($overageNote);
            }

            $allRefundNotes = $refunds->map(fn(Refund $refund) => $refund->getNote())->filter();

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

        if (empty($note)) {
            $note = $refundNotes;
        } else {
            $note = Str::of($note)->newLine()->append($refundNotes)->value();
        }

        if ($note) {
            $orderData["note"] = $note;
        }

        if ($subscription->getTax()) {
            $orderData["tax_lines"] = [
                ["price" => $subscription->getTax()]
            ];
        }

        // the proper addresses should already have been synced by the user/customer, so only use it if Shopify has it
        try {
            $address = $payment->getPaymentMethod()?->getBillingAddress() ?? null;
            if ($address?->getShopifyId()) {
                $orderData["billing_address"] = ["id" => $address->getShopifyId()];
            }
        } catch (EntityNotFoundException $e) {
            $this->logError(sprintf("%s: %s", $this->getClassName(), $e->getMessage()));
        }

        // Shopify expects a line item to represent the product purchased,
        // so build up the data for the subscription's product to simulate that
        $lineItem =
            [
                "fulfillable_quantity" => 1,
                "fulfillment_service" => "manual",
                "price" => number_format($subscription->getTotalPrice(), 2, '.', ''),
                "quantity" => 1,
                "requires_shipping" => false,
                "sku" => $product->getSku(),
                "title" => $product->getName(),
                "variant_id" => $product->getShopifyId(),
                "variant_inventory_management" => "shopify",
                "vendor" => $product->getBrand(),
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
            $amountToDiscount = min($refundAmount, $subscription->getTotalPrice());
            $discounts[] =
                [
                    "amount" => number_format($amountToDiscount, 2, '.', '')
                ];

            $lineItem["applied_discounts"] = $discounts;
        }

        // Shopify expects an array of line items so nest our data inside another array
        $orderData["line_items"] = array($lineItem);

        return $orderData;
    }

    /**
     * Get the value to use for the given payment's source
     *
     * @param Payment $payment
     * @return ShopifyPaymentSourceEnum
     */
    private function getPaymentSourceMetafieldValue(Payment $payment): ShopifyPaymentSourceEnum
    {
        return match ($payment->getType()) {
            Payment::TYPE_APPLE_SUBSCRIPTION_RENEWAL => ShopifyPaymentSourceEnum::Apple,
            Payment::TYPE_GOOGLE_SUBSCRIPTION_RENEWAL => ShopifyPaymentSourceEnum::Google,
            default => ShopifyPaymentSourceEnum::Web,
        };
    }

    /**
     * @inheritDoc
     */
    protected function getIsSimulation(): bool
    {
        return $this->simulate;
    }

    /**
     * Get the payment for this SubscriptionPayment, and send the data to Shopify to create a payment transaction,
     * recording the result's shopify_id
     *
     * @param SubscriptionPayment $subscriptionPayment
     * @return void
     */
    private function sendPaymentsToShopify(SubscriptionPayment $subscriptionPayment): void
    {
        $payment = $subscriptionPayment->getPayment();
        $amount = number_format($payment->getTotalPaid(), 2, '.', '');
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
                self::RESULTS_MODEL_ID => $payment->getId(),
                self::RESULTS_AMOUNT => $amount,
                self::RESULTS_SHOPIFY_ID => "---"
            ];
            return;
        }

        try {
            $paymentResource = $this->shopify->createOrderTransaction(
                $subscriptionPayment->getShopifyId(),
                $paymentData
            );
            $paymentShopifyId = $paymentResource->id;
            $this->handleRateLimit();

            // record the shopify ID on the Payment
            // grab the eloquent model, so we can update it
            $paymentModel = \App\Modules\Ecommerce\Models\Payment::find($payment->getId());
            $paymentModel->shopify_id = $paymentShopifyId;
            $paymentModel->saveWithoutUpdatedAt();
            // refresh the doctrine model to get the change
            $this->entityManager->refresh($payment);

            $this->shopifyIds->push($paymentShopifyId);
            $this->results[] = [
                self::RESULTS_MESSAGE_TYPE => self::RESULTS_MESSAGE_TYPE_SUCCESS,
                self::RESULTS_MODEL_TYPE => self::RESULTS_MODEL_TYPE_PAYMENT,
                self::RESULTS_MODEL_ID => $payment->getId(),
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
                    $subscriptionPayment->getId(),
                    json_encode($paymentData["data"])
                )
            );
            $this->results[] = [
                self::RESULTS_MESSAGE_TYPE => self::RESULTS_MESSAGE_TYPE_ERROR,
                self::RESULTS_MODEL_TYPE => self::RESULTS_MODEL_TYPE_PAYMENT,
                self::RESULTS_MODEL_ID => $payment->getId(),
                self::RESULTS_ACTION => "FAILED",
                self::RESULTS_FAIL_MESSAGE => $exception->getMessage()
            ];
        } catch (\Doctrine\ORM\Exception\ORMException $exception) {
            $this->logError(
                sprintf(
                    "%s: Failed to save shopify_id for payment ID %s: %s",
                    $this->getClassName(),
                    $payment->getId(),
                    $exception->getMessage()
                )
            );
            $this->results[] = [
                self::RESULTS_MESSAGE_TYPE => self::RESULTS_MESSAGE_TYPE_ERROR,
                self::RESULTS_MODEL_TYPE => self::RESULTS_MODEL_TYPE_PAYMENT,
                self::RESULTS_MODEL_ID => $payment->getId(),
                self::RESULTS_ACTION => "FAILED",
                self::RESULTS_FAIL_MESSAGE => $exception->getMessage()
            ];
        }
    }

    /**
     * Get the Fulfillment Order Resource from Shopify, for the given Shopify Order ID
     *
     * @param int $orderShopifyId
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
     * @param int $fulfillmentOrderId
     * @param int $fulfillmentOrderLineItemId
     * @param int $quantity
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
     * Get a collection of refunds for this subscription payment
     *
     * @param SubscriptionPayment $subscriptionPayment
     * @return Collection
     */
    private function getRefundsForSubscriptionPayment(SubscriptionPayment $subscriptionPayment): Collection
    {
        $refunds = $this->refundRepository->getPaymentsRefunds([$subscriptionPayment->getPayment()]);
        if (empty($refunds)) {
            return collect();
        }

        return collect($refunds);
    }

    /**
     * @inheritDoc
     */
    protected function getLimit(): ?int
    {
        // limits were already applied in the initial command
        return null;
    }

    /**
     * @inheritDoc
     */
    protected function getSyncResource(): string
    {
        return "subscription_payment";
    }

    /**
     * @inheritDoc
     */
    protected function getEcommerceEntityRepository(): RepositoryBase
    {
        return $this->subscriptionPaymentRepository;
    }

    /**
     * @inheritDoc
     */
    protected function syncResource(bool $simulate, bool $fresh): Collection
    {
        // we do not use the SyncsToShopify sync() here. We have too many Subscription Payments to complete in a single run,
        // and so the logic had to be split up and chunked.
        // All of that is done in the handle function, and so this function is never used.
        return collect();
    }

    /**
     * @inheritDoc
     */
    protected function getIsUsingMask(): bool
    {
        return !app()->isProduction();
    }

    /**
     * @inheritDoc
     */
    protected function getLastSyncAtOverride(): null|Carbon
    {
        return $this->lastSyncAt;
    }
}
