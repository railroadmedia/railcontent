<?php

namespace App\Modules\Ecommerce\Jobs\Shopify;

use App\Models\ShopifySync;
use App\Modules\Ecommerce\Enums\ShopifyMetafieldKey;
use App\Modules\Ecommerce\Enums\ShopifyMetafieldNamespace;
use App\Modules\Ecommerce\Enums\ShopifyMetafieldTypes;
use App\Modules\Ecommerce\Jobs\Shopify\Traits\HandlesMaskedEmailAddress;
use App\Modules\Ecommerce\Jobs\Shopify\Traits\HandlesShopifyRateLimit;
use App\Modules\Ecommerce\Jobs\Shopify\Traits\LogsShopify;
use App\Modules\Ecommerce\Jobs\Shopify\Traits\SyncsToShopify;
use Carbon\Carbon;
use Doctrine\ORM\EntityRepository;
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
use Railroad\Ecommerce\Entities\Order;
use Railroad\Ecommerce\Entities\OrderItem;
use Railroad\Ecommerce\Entities\OrderItemFulfillment;
use Railroad\Ecommerce\Entities\Payment;
use Railroad\Ecommerce\Entities\Product;
use Railroad\Ecommerce\Entities\Refund;
use Railroad\Ecommerce\Managers\EcommerceEntityManager;
use Railroad\Ecommerce\Repositories\CustomerRepository;
use Railroad\Ecommerce\Repositories\OrderItemRepository;
use Railroad\Ecommerce\Repositories\OrderRepository;
use Railroad\Ecommerce\Repositories\PaymentRepository;
use Railroad\Ecommerce\Repositories\ProductRepository;
use Railroad\Ecommerce\Repositories\RefundRepository;
use Railroad\Ecommerce\Repositories\RepositoryBase;
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
    use SyncsToShopify;

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
    protected const RESULTS_MODEL_TYPE_REFUND = "Refund";
    protected const RESULTS_MODEL_ID = "model_id";
    protected const RESULTS_ACTION = "action";
    protected const RESULTS_SHOPIFY_ID = "shopify_id";
    protected const RESULTS_FAIL_MESSAGE = "failure_message";
    protected const FULFILLMENT_ITEM_ID = "item_id";
    protected const SHOPIFY_FULFILLMENT_ID = "shopify_fulfillment_id";
    protected const FULFILLMENT_ACTION = "order_item_fulfillment_action";
    /**
     * The number of seconds the job can run before timing out.
     *
     * @var int
     */
    public $timeout = 840;
    protected CustomerRepository $customerRepository;
    protected OrderRepository $orderRepository;
    protected OrderItemRepository $orderItemRepository;
    protected ProductRepository $productRepository;
    protected PaymentRepository $paymentRepository;
    protected RefundRepository $refundRepository;

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
     * Execute the job
     *
     * @param  Shopify  $shopify
     * @param  CustomerRepository  $customerRepository
     * @param  OrderRepository  $orderRepository
     * @param  OrderItemRepository  $orderItemRepository
     * @param  PaymentRepository  $paymentRepository
     * @param  ProductRepository  $productRepository
     * @param  RefundRepository  $refundRepository
     * @param  EcommerceEntityManager  $entityManager
     * @return void
     * @throws Exception
     */
    public function handle(
        Shopify $shopify,
        CustomerRepository $customerRepository,
        OrderRepository $orderRepository,
        OrderItemRepository $orderItemRepository,
        PaymentRepository $paymentRepository,
        ProductRepository $productRepository,
        RefundRepository $refundRepository,
        EcommerceEntityManager $entityManager
    ): void {
        // set DI instances that we'll need
        $this->shopify = $shopify;
        $this->customerRepository = $customerRepository;
        $this->orderRepository = $orderRepository;
        $this->orderItemRepository = $orderItemRepository;
        $this->paymentRepository = $paymentRepository;
        $this->productRepository = $productRepository;
        $this->refundRepository = $refundRepository;
        $this->entityManager = $entityManager;

        $this->logDebug(
            sprintf("%s: running batch for orders %s - %s", $this->getClassName(), $this->startAtId, $this->endAtId)
        );

        // DEV NOTE: we do not use the SyncsToShopify sync() here. With the huge number of Orders in our
        // database, we need to loop through in batches, instead of the usual process in SyncsToShopify.
        $this->notifyStartupStatus();
        $batchSize = 25;
        $this->loopOrdersSync($batchSize);
    }

    /**
     * @inheritDoc
     */
    protected function getClassName(): string
    {
        return "SyncOrdersToShopify";
    }

    /**
     * Get all the orders that need to be synced, and perform the sync action on each one
     *
     * @param  int  $batchSize
     * @return void
     */
    private function loopOrdersSync(int $batchSize): void
    {
        $fresh = $this->getIsFresh();

        // get the orders, using pagination to keep from blowing up the memory usage
        $qb = $this->orderRepository->createQueryBuilder('entity');
        if (!$fresh) {
            // we also need to check if any of the order's order items or order item fulfillments need to be synced,
            // so create query builders for each of those
            $orderItemQB = new QueryBuilder($this->entityManager);
            $orderItemFulfillmentQB = new QueryBuilder($this->entityManager);
            $qb->where($qb->expr()->between('entity.id', ':startingOrderId', ':endingOrderId'))
                ->andWhere(
                    $qb->expr()->orX(
                        $qb->expr()->isNull("entity.shopifyId"),
                        $qb->expr()->gt("entity.updatedAt", ":lastSyncAt"),
                        $qb->expr()->in(
                            "entity.id",
                            $orderItemQB->select("oi.orderId")
                                ->from(OrderItem::class, "oi")
                                ->where(
                                    $orderItemQB->expr()
                                        ->isNull("oi.shopifyId")
                                )->orWhere(
                                    $orderItemQB->expr()
                                        ->gt("oi.updatedAt", ":lastSyncAt")
                                )
                                ->getDQL()
                        ),
                        $qb->expr()->in(
                            "entity.id",
                            $orderItemFulfillmentQB->select("oif.orderId")
                                ->from(OrderItemFulfillment::class, "oif")
                                ->where(
                                    $orderItemQB->expr()
                                        ->isNull("oif.shopifyId")
                                )->orWhere(
                                    $orderItemQB->expr()
                                        ->gt("oif.updatedAt", ":lastSyncAt")
                                )
                                ->getDQL()
                        )
                    )
                )
                ->setParameter("lastSyncAt", $this->lastSyncAt)
                ->setParameter('startingOrderId', $this->startAtId)
                ->setParameter('endingOrderId', $this->endAtId);
        }

        $q = $qb->getQuery();
        $paginator = new Paginator($q);

        $totalCount = count($paginator);

        $infoString = "Found {$totalCount} orders to be synced.";
        $infoString .= " Performing in batches of {$batchSize}.";
        $this->logInfo(sprintf("%s: %s", $this->getClassName(), $infoString));

        foreach ($paginator as $index => $order) {
            // starting the batch
            if ($index % $batchSize === 0) {
                $this->shopifyIds = collect();
                $this->createSyncLogIfExecuting();
            }

            // TODO: remove this check once all users/customers have been synced
            $skip = false;
            if (!is_null($order->getUser())) {
                // the user is returned with only their id and email, so get the id and get a fresh copy
                try {
                    $user = User::find($order->getUser()->getId());
                    if (is_null($user->shopify_id)) {
                        $this->results[] = [
                            self::RESULTS_MESSAGE_TYPE => self::RESULTS_MESSAGE_TYPE_WARNING,
                            self::RESULTS_MODEL_TYPE => self::RESULTS_MODEL_TYPE_ORDER,
                            self::RESULTS_MODEL_ID => $order->getId(),
                            self::RESULTS_ACTION => "SKIPPED",
                            self::RESULTS_FAIL_MESSAGE => "User has not been synced to Shopify"
                        ];
                        $skip = true;
                    }
                } catch (ORMException $e) {
                    $this->logError(
                        sprintf("%s: Could not find user by ID %s", $this->getClassName(), $order->getUser()->getId())
                    );
                    $this->results[] = [
                        self::RESULTS_MESSAGE_TYPE => self::RESULTS_MESSAGE_TYPE_WARNING,
                        self::RESULTS_MODEL_TYPE => self::RESULTS_MODEL_TYPE_ORDER,
                        self::RESULTS_MODEL_ID => $order->getId(),
                        self::RESULTS_ACTION => "SKIPPED",
                        self::RESULTS_FAIL_MESSAGE => "User not found"
                    ];
                    $skip = true;
                }
            } elseif (!is_null($order->getCustomer())) {
                // the customer is returned with only their id and email, so get the id and get a fresh copy
                try {
                    $customer = $this->customerRepository->find($order->getCustomer()->getId());
                    if (is_null($customer->getShopifyId())) {
                        $this->results[] = [
                            self::RESULTS_MESSAGE_TYPE => self::RESULTS_MESSAGE_TYPE_WARNING,
                            self::RESULTS_MODEL_TYPE => self::RESULTS_MODEL_TYPE_ORDER,
                            self::RESULTS_MODEL_ID => $order->getId(),
                            self::RESULTS_ACTION => "SKIPPED",
                            self::RESULTS_FAIL_MESSAGE => "Customer has not been synced to Shopify"
                        ];
                        $skip = true;
                    }
                } catch (ORMException $e) {
                    $this->logError(
                        sprintf(
                            "%s: Could not find customer by ID %s",
                            $this->getClassName(),
                            $order->getCustomer()->getId()
                        )
                    );
                    $this->results[] = [
                        self::RESULTS_MESSAGE_TYPE => self::RESULTS_MESSAGE_TYPE_WARNING,
                        self::RESULTS_MODEL_TYPE => self::RESULTS_MODEL_TYPE_ORDER,
                        self::RESULTS_MODEL_ID => $order->getId(),
                        self::RESULTS_ACTION => "SKIPPED",
                        self::RESULTS_FAIL_MESSAGE => "Customer not found"
                    ];
                    $skip = true;
                }
            } else {
                // something went very wrong here
                $this->logError(
                    sprintf(
                        "%s: No user or customer found for Order ID %s. Skipping order sync.",
                        $this->getClassName(),
                        $order->getId()
                    )
                );
                $skip = true;
            }

            if (!$skip) {
                $wasSynced = $this->syncOrder($order, $fresh, $index + 1);

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
     * Sync the order up to Shopify
     *
     * @param  Order  $order
     * @param  bool  $fresh
     * @param  int|null  $simulatedShopifyId
     * @return bool whether the order was synced or not
     */
    private function syncOrder(Order $order, bool $fresh, ?int $simulatedShopifyId): bool
    {
        // safety check: we have many bad entries carried over from the old ecommerce system, that don't have any
        // order items, which is invalid in Shopify. If we don't have any order items, skip this order
        if ($order->getOrderItems()->isEmpty()) {
            $this->results[] = [
                self::RESULTS_MESSAGE_TYPE => self::RESULTS_MESSAGE_TYPE_WARNING,
                self::RESULTS_MODEL_TYPE => self::RESULTS_MODEL_TYPE_ORDER,
                self::RESULTS_MODEL_ID => $order->getId(),
                self::RESULTS_ACTION => "SKIPPED",
                self::RESULTS_FAIL_MESSAGE => "No Order Items"
            ];
            return false;
        }

        // STEP 1: determine if updating or creating
        $isCreating = $fresh || is_null($order->getShopifyId());
        if ($isCreating) {
            $needsToUpdate = false;
        } else {
            $needsToUpdate = $this->doesOrderNeedToSync($order);
        }

        // STEP 2: build up the data structure, if the order needs to be updated
        try {
            $postData = $this->createOrderData($order, $isCreating);
        } catch (Exception $e) {
            $this->logError(
                sprintf(
                    "%s: Failed to find User or Customer for Order ID %s",
                    $this->getClassName(),
                    $order->getId()
                )
            );
            // record the failure in the results then exit out for this order
            $this->results[] = [
                self::RESULTS_MESSAGE_TYPE => self::RESULTS_MESSAGE_TYPE_ERROR,
                self::RESULTS_MODEL_TYPE => self::RESULTS_MODEL_TYPE_ORDER,
                self::RESULTS_MODEL_ID => $order->getId(),
                self::RESULTS_ACTION => "FAILED",
                self::RESULTS_FAIL_MESSAGE => sprintf("%s", $e->getMessage())
            ];
            return false;
        }

        // STEP 3: send the data to Shopify
        if (!$this->getIsSimulation()) {
            try {
                // STEP 4a: create the Order in Shopify
                if ($isCreating) {
                    $orderResource = $this->shopify->createOrder($postData);
                    $orderShopifyId = $orderResource->id;
                    $this->handleRateLimit();
                } else {
                    if ($needsToUpdate) {
                        $orderResource = $this->shopify->updateOrder($order->getShopifyId(), $postData);
                        $this->handleRateLimit();
                    } else {
                        $orderResource = null;
                        $this->results[] = [
                            self::RESULTS_MESSAGE_TYPE => self::RESULTS_MESSAGE_TYPE_SUCCESS,
                            self::RESULTS_MODEL_TYPE => self::RESULTS_MODEL_TYPE_ORDER,
                            self::RESULTS_MODEL_ID => $order->getId(),
                            self::RESULTS_ACTION => "Skipped",
                            self::RESULTS_SHOPIFY_ID => $order->getShopifyId()
                        ];
                    }
                    $orderShopifyId = $order->getShopifyId();
                }
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
                        $order->getId(),
                        json_encode($postData)
                    )
                );
                // record the failure in the results then exit out for this order
                $this->results[] = [
                    self::RESULTS_MESSAGE_TYPE => self::RESULTS_MESSAGE_TYPE_ERROR,
                    self::RESULTS_MODEL_TYPE => self::RESULTS_MODEL_TYPE_ORDER,
                    self::RESULTS_MODEL_ID => $order->getId(),
                    self::RESULTS_ACTION => "FAILED",
                    self::RESULTS_FAIL_MESSAGE => $exception->getMessage()
                ];
                return false;
            }

            try {
                // record the shopify ID on the Order
                if ($order->getShopifyId() !== $orderShopifyId) {
                    // grab the eloquent model, so we can update it
                    $orderModel = \App\Modules\Ecommerce\Models\Order::find($order->getId());
                    $orderModel->shopify_id = $orderShopifyId;
                    $orderModel->saveWithoutUpdatedAt();
                    // refresh the doctrine model to get the change
                    $this->entityManager->refresh($order);
                }
                $this->shopifyIds->push($orderShopifyId);
                $this->results[] = [
                    self::RESULTS_MESSAGE_TYPE => self::RESULTS_MESSAGE_TYPE_SUCCESS,
                    self::RESULTS_MODEL_TYPE => self::RESULTS_MODEL_TYPE_ORDER,
                    self::RESULTS_MODEL_ID => $order->getId(),
                    self::RESULTS_ACTION => $isCreating ? "Created" : "Updated",
                    self::RESULTS_SHOPIFY_ID => $orderShopifyId
                ];
            } catch (\Doctrine\ORM\Exception\ORMException $e) {
                $this->logError(
                    sprintf(
                        "%s: Failed to save shopify_id for order ID %s: %s",
                        $this->getClassName(),
                        $order->getId(),
                        $e->getMessage()
                    )
                );
            }

            // STEP 4b: record the Shopify Order's Line Items as our Order Items
            if (!is_null($orderResource)) {
                $resourceLineItems = $orderResource->getAttributes()["line_items"];
                $sentLineItems = $postData["line_items"];
                foreach ($resourceLineItems as $idx => $resourceLineItem) {
                    try {
                        // grab the shopify id
                        $lineItemShopifyId = $resourceLineItem["id"];
                        // get our corresponding line item data
                        $sentLineItem = $sentLineItems[$idx];
                        // and get our Order Item for it
                        $lineItem = $this->orderItemRepository->find($sentLineItem["ecommerce_order_item_id"]);
                        // and finally, save the shopify id on it
                        $isCreatedLineItem = false;
                        if ($lineItem->getShopifyId() !== $lineItemShopifyId) {
                            $isCreatedLineItem = true;
                            // grab the eloquent model, so we can update it
                            $orderItemModel = \App\Modules\Ecommerce\Models\OrderItem::find($lineItem->getId());
                            $orderItemModel->shopify_id = $lineItemShopifyId;
                            $orderItemModel->saveWithoutUpdatedAt();
                            // refresh the doctrine model to get the change
                            $this->entityManager->refresh($lineItem);
                        }
                        $this->results[] = [
                            self::RESULTS_MESSAGE_TYPE => self::RESULTS_MESSAGE_TYPE_SUCCESS,
                            self::RESULTS_MODEL_TYPE => self::RESULTS_MODEL_TYPE_ORDER_ITEM,
                            self::RESULTS_MODEL_ID => $sentLineItem["ecommerce_order_item_id"],
                            self::RESULTS_ACTION => $isCreatedLineItem ? "Created" : "Updated",
                            self::RESULTS_SHOPIFY_ID => $lineItemShopifyId
                        ];
                    } catch (\Doctrine\ORM\Exception\ORMException $e) {
                        $this->logError(
                            sprintf(
                                "%s: Failed to save shopify_id for order item ID %s: %s",
                                $this->getClassName(),
                                $sentLineItem["ecommerce_order_item_id"],
                                $e->getMessage()
                            )
                        );
                    } catch (ORMException $e) {
                        $this->logError(
                            sprintf(
                                "%s: Could not find order item with ID %s: %s",
                                $this->getClassName(),
                                $sentLineItem["ecommerce_order_item_id"],
                                $e->getMessage()
                            )
                        );
                    }
                }
            }

            // STEP 5: add payments
            $this->sendPaymentsForOrderToShopify($order);

            // STEP 6: add the Fulfillments and tracking
            $fulfillmentOrder = $this->getFulfillmentOrderResource($order);
            if (is_null($fulfillmentOrder)) {
                $this->logError(
                    sprintf(
                        "%s: Failed to retrieve Fulfillment Order Resource from Shopify for Order ID %s",
                        $this->getClassName(),
                        $order->getId()
                    )
                );
                // record the failure in the results then exit out for this order
                $this->results[] = [
                    self::RESULTS_MESSAGE_TYPE => self::RESULTS_MESSAGE_TYPE_ERROR,
                    self::RESULTS_MODEL_TYPE => self::RESULTS_MODEL_TYPE_ORDER,
                    self::RESULTS_MODEL_ID => $order->getId(),
                    self::RESULTS_ACTION => "FAILED",
                    self::RESULTS_FAIL_MESSAGE => "No Fulfillment Order Resource"
                ];
                return false;
            }
            $fulfillmentOrderStatus = $fulfillmentOrder->getAttributes()["status"];

            // get each line item from the fulfillment order
            $lineItems = $fulfillmentOrder->getAttributes()["line_items"];
            // and for each line item...
            foreach ($lineItems as $lineItemData) {
                try {
                    $fulfillmentRecords = $this->sendFulfillmentsForOrderItemToShopify(
                        $lineItemData["fulfillment_order_id"],
                        $lineItemData["line_item_id"],
                        $lineItemData["id"],
                        $fulfillmentOrderStatus
                    );
                    // ... record the fulfillment(s) made for the line item
                    if ($fulfillmentRecords) {
                        foreach ($fulfillmentRecords as $fulfillmentRecord) {
                            // print any records for fulfillments
                            $this->results[] = [
                                self::RESULTS_MESSAGE_TYPE => self::RESULTS_MESSAGE_TYPE_SUCCESS,
                                self::RESULTS_MODEL_TYPE => self::RESULTS_MODEL_TYPE_ORDER_ITEM_FULFILLMENT,
                                self::RESULTS_MODEL_ID => $fulfillmentRecord[self::FULFILLMENT_ITEM_ID],
                                self::RESULTS_ACTION => $fulfillmentRecord[self::FULFILLMENT_ACTION],
                                self::RESULTS_SHOPIFY_ID => $fulfillmentRecord[self::SHOPIFY_FULFILLMENT_ID]
                            ];
                        }
                    }
                } catch (Exception $e) {
                    $this->logError(
                        sprintf(
                            "%s: Failed to send fulfillments data to Shopify for order ID %s: %s",
                            $this->getClassName(),
                            $order->getId(),
                            $e->getMessage()
                        )
                    );
                }
            }
        } else {
            // simulating
            $orderShopifyId = $order->getShopifyId() ?? $simulatedShopifyId;
            // record the action for the order
            if ($isCreating) {
                $action = "Created";
            } elseif ($needsToUpdate) {
                $action = "Updated";
            } else {
                $action = "Skipped";
            }
            $this->results[] = [
                self::RESULTS_MESSAGE_TYPE => self::RESULTS_MESSAGE_TYPE_SUCCESS,
                self::RESULTS_MODEL_TYPE => self::RESULTS_MODEL_TYPE_ORDER,
                self::RESULTS_MODEL_ID => $order->getId(),
                self::RESULTS_ACTION => $action,
                self::RESULTS_SHOPIFY_ID => $orderShopifyId
            ];

            // record the payment creations, but we won't actually do it
            $payments = $this->getPaymentsDataToSync($order);
            $payments->each(fn(array $paymentData) => $this->results[] = [
                self::RESULTS_MESSAGE_TYPE => self::RESULTS_MESSAGE_TYPE_SUCCESS,
                self::RESULTS_MODEL_TYPE => self::RESULTS_MODEL_TYPE_PAYMENT,
                self::RESULTS_MODEL_ID => $paymentData["id"],
                self::RESULTS_ACTION => "Created",
                self::RESULTS_SHOPIFY_ID => $orderShopifyId + $paymentData["id"]
            ]);

            $fulfillmentOrder = $this->getFulfillmentOrderResource($order);
            if (!is_null($fulfillmentOrder)) {
                $fulfillmentOrderStatus = $fulfillmentOrder->getAttributes()["status"];
            } else {
                $fulfillmentOrderStatus = $isCreating ? "open" : "closed";
            }

            // simulate getting each line item from the fulfillment order
            $lineItems = $postData["line_items"];
            foreach ($lineItems as $idx => $lineItemData) {
                // get or fake the shopify id for the line item
                $lineItemShopifyId = $lineItemData["shopify_id"] ?? $orderShopifyId + $idx;
                // get or fake the shopify id for the fulfillment order line item
                $fulfillmentOrderLineItemId = $lineItemData["id"] ?? $orderShopifyId + 10;
                // record the Shopify Order's Line Items as our Order Items
                $this->results[] = [
                    self::RESULTS_MESSAGE_TYPE => self::RESULTS_MESSAGE_TYPE_SUCCESS,
                    self::RESULTS_MODEL_TYPE => self::RESULTS_MODEL_TYPE_ORDER_ITEM,
                    self::RESULTS_MODEL_ID => $lineItemData["ecommerce_order_item_id"],
                    self::RESULTS_ACTION => $lineItemData["shopify_id"] ? "Updated" : "Created",
                    self::RESULTS_SHOPIFY_ID => $lineItemShopifyId
                ];

                try {
                    $fulfillmentRecords = $this->sendFulfillmentsForOrderItemToShopify(
                        $lineItemData["ecommerce_order_item_id"],
                        $lineItemShopifyId,
                        $fulfillmentOrderLineItemId,
                        $fulfillmentOrderStatus
                    );
                    // record the fulfillment(s) made for the line item
                    if ($fulfillmentRecords) {
                        foreach ($fulfillmentRecords as $fulfillmentRecord) {
                            // print any records for fulfillments
                            $this->results[] = [
                                self::RESULTS_MESSAGE_TYPE => self::RESULTS_MESSAGE_TYPE_SUCCESS,
                                self::RESULTS_MODEL_TYPE => self::RESULTS_MODEL_TYPE_ORDER_ITEM_FULFILLMENT,
                                self::RESULTS_MODEL_ID => $fulfillmentRecord[self::FULFILLMENT_ITEM_ID],
                                self::RESULTS_ACTION => $fulfillmentRecord[self::FULFILLMENT_ACTION],
                                self::RESULTS_SHOPIFY_ID => $fulfillmentRecord[self::SHOPIFY_FULFILLMENT_ID]
                            ];
                        }
                    }
                } catch (Exception $e) {
                    $this->logError(
                        sprintf(
                            "%s: Failed to send fulfillments data to Shopify for order ID %s: %s",
                            $this->getClassName(),
                            $order->getId(),
                            $e->getMessage()
                        )
                    );
                }
            }
        }

        return true;
    }

    /**
     * This order could be in our data set to sync either because it needs to be synced up with Shopify,
     * or because its order item(s) or order item fulfillment(s) need to be synced. This function checks if the
     * order itself needs to be synced or not.
     *
     * @param  Order  $order
     * @return bool
     */
    private function doesOrderNeedToSync(Order $order): bool
    {
        return is_null($order->getShopifyId()) || $this->lastSyncAt->isBefore($order->getUpdatedAt());
    }

    /**
     * Create the data to post to Shopify to create an Order
     *
     * @param  Order  $order
     * @param  bool  $withMetafields
     * @return array
     * @throws ORMException
     * @throws Exception
     */
    private function createOrderData(Order $order, bool $withMetafields): array
    {
        // the user or customer is returned with only their id and email, so get the id and get a fresh copy
        if ($order->getUser()) {
            $purchaser = User::find($order->getUser()->getId());
            $purchaserId = $purchaser->shopify_id;
            $purchaserEmail = $purchaser->email;
        } else {
            $purchaser = $this->customerRepository->find($order->getCustomer()->getId());
            $purchaserId = $purchaser->getShopifyId();
            $purchaserEmail = $purchaser->getEmail();
        }

        /*
         * DEV NOTE: the documentation at https://shopify.dev/docs/api/admin-rest/2023-07/resources/order state that the
         * currency field is read-only, but it actually is still functional for legacy purposes (for now), and is currently
         * the only way to set the currency of an order through the Admin API. We need to set the currency on the order
         * so that any payments and/or refunds are handled in the appropriate currency.
         */
        // we need to know what currency was used, so try to find any payments for this order
        $currency = self::DEFAULT_CURRENCY;
        $payments = collect($order->getPayments()->toArray());
        if ($payments->isNotEmpty()) {
            $currencies = $payments->map(fn(Payment $payment) => $payment->getCurrency())->unique();
            // we should only have one payment per order, but do a safety check here just in case
            if ($currencies->count() > 1) {
                throw new Exception(sprintf("Multiple currencies found for Order %s. ", $order->getId()));
            }
            $currency = $currencies->first();
        }

        $orderData = [
            "currency" => $currency,
            "customer" => ["id" => $purchaserId],
            "email" => $this->getEmailForShopify($purchaserEmail),
            "processed_at" => (new Carbon($order->getCreatedAt()))->toIso8601String(),
            // "tags" => "",
        ];

        // record a note if there were any refunds
        $refundNotes = null;
        $refunds = $this->getRefundsForOrder($order);
        $refundAmount = 0.0;
        if ($refunds->isNotEmpty()) {
            $refundAmount = $refunds->sum(fn(Refund $refund) => $refund->getRefundedAmount());
            $refundNotes = Str::of(
                sprintf(
                    "%s %s %s applied to this order, totalling %s %s which has been discounted ".
                    "from the item(s) purchased",
                    $refunds->count(),
                    Str::plural("refund", $refunds->count()),
                    $refunds->count() == 1 ? "was" : "were",
                    number_format($refundAmount, 2),
                    $refunds->first()->getPayment()?->getCurrency() ?? self::DEFAULT_CURRENCY
                )
            );
            $notes = $refunds->map(fn(Refund $refund) => $refund->getNote())->filter();

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
        if (empty($order->getNote())) {
            $notes = $refundNotes;
        } else {
            $notes = Str::of($order->getNote())->newLine()->append($refundNotes)->value();
        }

        if ($notes) {
            $orderData["note"] = $notes;
        }

        if ($withMetafields) {
            // refer to https://shopify.dev/docs/apps/custom-data/metafields/types
            // we can use meta fields for stuff like our order id, etc
            $orderData["metafields"] = [
                [
                    "key" => ShopifyMetafieldKey::Id->value,
                    "value" => $order->getId(),
                    "type" => ShopifyMetafieldTypes::integer->value,
                    "namespace" => ShopifyMetafieldNamespace::Model_Orders->value
                ],
                [
                    "key" => ShopifyMetafieldKey::Brand->value,
                    "value" => $order->getBrand(),
                    "type" => ShopifyMetafieldTypes::single_line_text_field->value,
                    "namespace" => ShopifyMetafieldNamespace::Musora->value
                ],
            ];
        }

        if ($order->getTaxesDue()) {
            $orderData["tax_lines"] = [
                ["price" => number_format($order->getTaxesDue(), 2, '.', '')]
            ];
        }

        // the proper addresses should already have been synced by the user/customer, so only use it if Shopify has it
        if ($order->getBillingAddress()?->getShopifyId()) {
            $orderData["billing_address"] = ["id" => $order->getBillingAddress()->getShopifyId()];
        }
        if ($order->getShippingAddress()?->getShopifyId()) {
            $orderData["shipping_address"] = ["id" => $order->getShippingAddress()->getShopifyId()];
        }

        $orderData["line_items"] = $this->createOrderItems($order, $refundAmount);

        return $orderData;
    }

    /**
     * Get a collection of refunds that for this order
     *
     * @param  Order  $order
     * @return Collection
     */
    private function getRefundsForOrder(Order $order): Collection
    {
        // we get an ArrayCollection from doctrine, so just take the normal array from that
        /** @var Payment[] $payments */
        $payments = $order->getPayments()->toArray();
        if (empty($payments)) {
            return collect();
        }
        $refunds = $this->refundRepository->getPaymentsRefunds($payments);
        if (empty($refunds)) {
            return collect();
        }

        return collect($refunds);
    }

    /**
     * Create the data required for all Order Items of the Order
     *
     * @param  Order  $order
     * @param  float  $refundAmount
     * @return array
     */
    private function createOrderItems(Order $order, float $refundAmount): array
    {
        $orderItemsData = [];

        // Doctrine for some reason performs db queries to get the order items' attributes
        // which is causing a bottleneck, so we'll get the Eloquent models
        $orderModel = \App\Modules\Ecommerce\Models\Order::query()
            ->with("orderItems", "orderItems.product")
            ->find($order->getId());
        $orderModel->orderItems->each(
            function (\App\Modules\Ecommerce\Models\OrderItem $orderItem) use (
                $orderModel,
                &$orderItemsData,
                &$refundAmount
            ) {
                $data = [
                    // include the shopify_id, if we have one, so we know if we're updating or creating - shopify will just ignore this
                    "shopify_id" => $orderItem->shopify_id,
                    // include our internal id, so we can reference it to update - shopify will just ignore this
                    "ecommerce_order_item_id" => $orderItem->id,
                    "fulfillable_quantity" => $orderItem->quantity,
                    "fulfillment_service" => "manual",
                    "price" => number_format($orderItem->initial_price ?? 0, 2, '.', ''),
                    "quantity" => $orderItem->quantity,
                    "requires_shipping" => $orderItem->weight > 0,
                    "sku" => $orderItem->product->sku,
                    "title" => $orderItem->product->name,
                    "variant_id" => $orderItem->product->shopify_id,
                    "variant_inventory_management" => "shopify",
                    "vendor" => $orderModel->brand,
                ];

                $hasDiscounts = false;
                $discounts = [];

                if ($orderItem->total_discounted > 0) {
                    $discounts[] =
                        [
                            "amount" => number_format($orderItem->total_discounted, 2, '.', '')
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
                    $availableBalance = $orderItem->initial_price - $orderItem->total_discounted;
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

                $orderItemsData[] = $data;
            }
        );


        return $orderItemsData;
    }

    /**
     * @inheritDoc
     */
    protected function getIsSimulation(): bool
    {
        return $this->simulate;
    }

    /**
     * Get the unsynced payments for this order, and send the data to Shopify to create a payment transaction
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
                $paymentResource = $this->shopify->createOrderTransaction($order->getShopifyId(), $paymentData["data"]);
                $paymentShopifyId = $paymentResource->id;
                $this->handleRateLimit();

                // record the shopify ID on the Payment
                $payment = $this->paymentRepository->find($paymentId);
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
                        $order->getId(),
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
            } catch (\Doctrine\ORM\Exception\ORMException $exception) {
                $this->logError(
                    sprintf(
                        "%s: Failed to save shopify_id for payment ID %s: %s",
                        $this->getClassName(),
                        $paymentId,
                        $exception->getMessage()
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
        // we get an ArrayCollection from doctrine, so just take the normal array from that
        /** @var Payment[] $payments */
        $payments = $order->getPayments()->toArray();
        if (empty($payments)) {
            return collect();
        }
        $payments = collect($payments)
            ->filter(
                fn(Payment $payment) => is_null($payment->getShopifyId()) && $payment->getStatus(
                    ) === Payment::STATUS_PAID
            );

        return $payments->transform(function (Payment $payment) {
            return
                [
                    "id" => $payment->getId(),
                    "data" =>
                        [
                            "amount" => number_format($payment->getTotalPaid(), 2, '.', ''),
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
     * @return ApiResource|null
     */
    private function getFulfillmentOrderResource(Order $order): ?ApiResource
    {
        $orderShopifyId = $order->getShopifyId();
        $fulfillmentOrders = null;

        // get the fulfillment order and its status, so we can update it with our data
        if (!$this->getIsSimulation()) {
            // Shopify created an Order Fulfillment for our Order when they created it, so we need to grab that from them
            $fulfillmentOrders = $this->shopify->getOrderFulfillmentOrders($orderShopifyId);
            $this->handleRateLimit();
        } elseif (!is_null($orderShopifyId)) {
            // if we're simulating, try to get the order's fulfillment orders from shopify, if we have a real shopify id
            $fulfillmentOrders = $this->shopify->getOrderFulfillmentOrders($orderShopifyId);
            $this->handleRateLimit();
        }

        // there can be multiple fulfillment orders (but realistically, there will most likely only be one), so grab the last entry
        return $fulfillmentOrders?->last() ?? null;
    }

    /**
     * Using the Shopify Order Line Item's ID, get our related Order Item and create a fulfillment record for it in
     * Shopify for each of our fulfillments for it, and provide the status and tracking information, if available.
     * Returning a formatted array of the Order Item Fulfillment ID and the corresponding Shopify ID.
     *
     * @param  int  $fulfillmentOrderId  the Shopify ID of the Fulfillment Order we're fulfilling
     * @param  int  $orderItemShopifyId  the Shopify ID of the line item being filled (used to find our corresponding OrderItem)
     * @param  int  $fulfillmentOrderLineItemId  the Shopify ID of the fulfillment's line item, needed to tell Shopify which item we're fulfilling
     * @param  string  $fulfillmentOrderStatus  the status of the Order's Fulfillment Order in Shopify
     * @return array|null
     * @throws Exception
     */
    private function sendFulfillmentsForOrderItemToShopify(
        int $fulfillmentOrderId,
        int $orderItemShopifyId,
        int $fulfillmentOrderLineItemId,
        string $fulfillmentOrderStatus
    ): ?array {
        if ($this->getIsSimulation()) {
            // if we're simulating, we passed in the order item's ID as the $fulfillmentOrderId
            $orderItem = $this->orderItemRepository->find($fulfillmentOrderId);
        } else {
            $orderItem = $this->orderItemRepository->getByShopifyId($orderItemShopifyId);
        }
        if (is_null($orderItem)) {
            throw new Exception(
                sprintf(
                    "No ecommerce Order Item found for shopify_id %s. Skipping fulfillment process with Shopify.",
                    $orderItemShopifyId
                )
            );
        }

        // get the product, so we can see how to handle its fulfillment
        if ($productEntity = $orderItem->getProduct()) {
            // the product might be inactive, so use the id to get a fresh copy with all its data
            $product = $this->productRepository->findProduct($productEntity->getId(), [0, 1]);

            if ($product->getType() === Product::TYPE_DIGITAL_SUBSCRIPTION || $product->getType(
                ) === Product::TYPE_DIGITAL_ONE_TIME) {
                return $this->fulfillDigitalProduct(
                    $fulfillmentOrderId,
                    $fulfillmentOrderLineItemId,
                    $orderItem->getQuantity() ?? 0,
                    $fulfillmentOrderStatus
                );
            } elseif ($product->getType() === Product::TYPE_PHYSICAL_ONE_TIME) {
                return $this->fulfillPhysicalProduct($fulfillmentOrderId, $fulfillmentOrderLineItemId, $orderItem);
            } else {
                throw new Exception(
                    sprintf(
                        "Unknown product type %s. Cannot create Shopify Fulfillment.",
                        $product->getType()
                    )
                );
            }
        }
        return [];
    }

    /**
     * Handle fulfilling an order item in Shopify for a digital product.
     *
     * @param  int  $fulfillmentOrderId
     * @param  int  $fulfillmentOrderLineItemId
     * @param  int  $quantity
     * @param  string  $fulfillmentOrderStatus
     * @return array<array> array of result arrays
     */
    private function fulfillDigitalProduct(
        int $fulfillmentOrderId,
        int $fulfillmentOrderLineItemId,
        int $quantity,
        string $fulfillmentOrderStatus
    ): array {
        $fulfillmentRecords = [];
        $record = [
            self::FULFILLMENT_ITEM_ID => "N/A for digital product",
        ];

        // digital products don't have fulfillments in Musora, so just create an empty one in Shopify to mark
        // it as fulfilled, if we haven't already
        if ($fulfillmentOrderStatus === "closed") {
            // if the fulfillment order is already closed, there's nothing for us to do here
            $record[self::SHOPIFY_FULFILLMENT_ID] = $fulfillmentOrderLineItemId;
            $record[self::FULFILLMENT_ACTION] = "Skipped";
            $fulfillmentRecords[] = $record;
            return $fulfillmentRecords;
        }

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

        $record[self::FULFILLMENT_ACTION] = "Created";
        if ($this->getIsSimulation()) {
            $record[self::SHOPIFY_FULFILLMENT_ID] = $fulfillmentOrderLineItemId;
        } else {
            $fulfillmentResult = $this->shopify->createFulfillment($fulfillmentData);
            $record[self::SHOPIFY_FULFILLMENT_ID] = $fulfillmentResult->getAttributes()["id"];
            $this->handleRateLimit();
        }
        $fulfillmentRecords[] = $record;

        return $fulfillmentRecords;
    }

    /**
     * Handle fulfilling an order item in Shopify for a physical product, including its tracking information,
     * if applicable
     *
     * @param  int  $fulfillmentOrderId
     * @param  int  $fulfillmentOrderLineItemId
     * @param  OrderItem  $orderItem
     * @return array<array> array of result arrays
     */
    private function fulfillPhysicalProduct(
        int $fulfillmentOrderId,
        int $fulfillmentOrderLineItemId,
        OrderItem $orderItem
    ): array {
        $fulfillmentRecords = [];
        // physical products might have fulfillments, so check for any
        $fulfillments = collect($orderItem->getOrderItemFulfillments());

        if ($fulfillments->isEmpty()) {
            $resultRecord = [
                self::FULFILLMENT_ITEM_ID => "No fulfillments for order item",
                self::SHOPIFY_FULFILLMENT_ID => "N/A",
                self::FULFILLMENT_ACTION => "Skipped"
            ];
            $fulfillmentRecords[] = $resultRecord;
            return $fulfillmentRecords;
        }

        // and create a fulfillment in Shopify for each one that hasn't already been done
        $fulfillments->each(function (OrderItemFulfillment $fulfillment, int $idx)
        use (
            $orderItem,
            $fulfillmentOrderLineItemId,
            $fulfillmentOrderId,
            &$fulfillmentRecords
        ) {
            $isNewFulFillment = is_null($fulfillment->getShopifyId());
            $fulfillmentData = [
                "fulfillment" => [
                    "notify_customer" => false,
                    "status" => $fulfillment->getStatus() == "fulfilled" ? "success" : "open"
                ],
                "line_items_by_fulfillment_order" => [
                    [
                        "fulfillment_order_id" => $fulfillmentOrderId,
                        "fulfillment_order_line_items" => [
                            [
                                "id" => $fulfillmentOrderLineItemId,
                                "quantity" => $orderItem->getQuantity() ?? 0
                            ]
                        ]
                    ]
                ]
            ];

            if ($this->getIsSimulation()) {
                $resultRecord = [
                    self::FULFILLMENT_ITEM_ID => $fulfillment->getId(),
                    self::SHOPIFY_FULFILLMENT_ID => $orderItem->getShopifyId()."-fulfil".$idx,
                    self::FULFILLMENT_ACTION => $isNewFulFillment ? "Created" : "Updated"
                ];
                $fulfillmentRecords[] = $resultRecord;
                if (!is_null($fulfillment->getTrackingNumber())) {
                    $fulfillmentRecords[] = $this->sendTrackingInfoForFulfillmentToShopify($fulfillment, []);
                }
            } else {
                // we only need to create new fulfillments
                if ($isNewFulFillment) {
                    $fulfillmentResult = $this->shopify->createFulfillment($fulfillmentData);
                    $this->handleRateLimit();
                    $fulfillmentShopifyId = $fulfillmentResult->getAttributes()["id"];
                    $resultRecord = [
                        self::FULFILLMENT_ITEM_ID => $fulfillment->getId(),
                        self::SHOPIFY_FULFILLMENT_ID => $fulfillmentShopifyId,
                        self::FULFILLMENT_ACTION => "Created"
                    ];
                    $fulfillmentRecords[] = $resultRecord;

                    // record the result's id as the shopify_id on our fulfillment
                    try {
                        if ($fulfillment->getShopifyId() !== $fulfillmentShopifyId) {
                            // grab the eloquent model, so we can update it
                            $fulfillmentModel = \App\Modules\Ecommerce\Models\OrderItemFulfillment::find(
                                $fulfillment->getId()
                            );
                            $fulfillmentModel->shopify_id = $fulfillmentShopifyId;
                            $fulfillmentModel->saveWithoutUpdatedAt();
                            // refresh the doctrine model to get the change
                            $this->entityManager->refresh($fulfillment);
                        }
                    } catch (\Doctrine\ORM\Exception\ORMException $e) {
                        $this->logError(
                            sprintf(
                                "%s: Failed to save shopify_id for order item fulfillment ID %s: %s",
                                $this->getClassName(),
                                $fulfillment->getId(),
                                $e->getMessage()
                            )
                        );
                    }
                } else {
                    // retrieve the fulfillment data from Shopify, so we can handle its tracking information
                    $fulfillmentResult = $this->shopify->getOrderFulfillment(
                        $orderItem->getOrder()->getShopifyId(),
                        $fulfillment->getShopifyId()
                    );
                    $this->handleRateLimit();
                    $resultRecord = [
                        self::FULFILLMENT_ITEM_ID => $fulfillment->getId(),
                        self::SHOPIFY_FULFILLMENT_ID => $fulfillment->getShopifyId(),
                        self::FULFILLMENT_ACTION => "Skipped"
                    ];
                }

                $fulfillmentRecords[] = $resultRecord;

                if (!is_null($fulfillment->getTrackingNumber())) {
                    $fulfillmentRecords[] = $this->sendTrackingInfoForFulfillmentToShopify(
                        $fulfillment,
                        $fulfillmentResult->getAttributes()
                    );
                }
            }
        });

        return $fulfillmentRecords;
    }

    /**
     * Get our tracking information for the given Order Item Fulfillment, and update the Shopify fulfillment with
     * the tracking information, if it's different.
     *
     * @param  OrderItemFulfillment  $fulfillment
     * @param  array  $shopifyFulfillmentAttributes
     * @return string[] array of result data to display in the table
     */
    private function sendTrackingInfoForFulfillmentToShopify(
        OrderItemFulfillment $fulfillment,
        array $shopifyFulfillmentAttributes
    ): array {
        $resultRecord = [
            self::FULFILLMENT_ITEM_ID => $fulfillment->getId()." tracking",
            self::SHOPIFY_FULFILLMENT_ID => "N/A",
        ];

        if ($this->getIsSimulation()) {
            // if we're simulating, we don't have a real $shopifyFulfillmentAttributes because we didn't send the data
            // to Shopify, so get the fulfillment data if it exists
            if (!is_null($fulfillment->getShopifyId())) {
                $orderFulfillmentResource = $this->shopify->getOrderFulfillment(
                    $fulfillment->getOrder()->getShopifyId(),
                    $fulfillment->getShopifyId()
                );
                $this->handleRateLimit();
                $shopifyFulfillmentAttributes = $orderFulfillmentResource->getAttributes();
            } else {
                // otherwise, just fake creating a new one
                $resultRecord [self::FULFILLMENT_ACTION] = "Created";
                return $resultRecord;
            }
        }
        $isCreating = is_null($shopifyFulfillmentAttributes["tracking_number"]);

        // if the tracking number already exists, make sure we have a change that needs to be sent
        if ($shopifyFulfillmentAttributes["tracking_number"] === $fulfillment->getTrackingNumber() &&
            $shopifyFulfillmentAttributes["tracking_company"] === $fulfillment->getCompany()) {
            $resultRecord [self::FULFILLMENT_ACTION] = "Skipped";
            return $resultRecord;
        }

        // update the fulfillment order with tracking info, if we have some
        $trackingData = [
            "fulfillment" => [
                "notify_customer" => false,
                "tracking_info" => [
                    "company" => $fulfillment->getCompany(),
                    "number" => $fulfillment->getTrackingNumber()
                ]
            ],
        ];

        if (!$this->getIsSimulation()) {
            $this->shopify->updateTrackingForFulfillment($shopifyFulfillmentAttributes["id"], $trackingData);
            $this->handleRateLimit();
        }
        $resultRecord [self::FULFILLMENT_ACTION] = $isCreating ? "Created" : "Updated";
        return $resultRecord;
    }

    /**
     * @inheritDoc
     */
    protected function getSyncResource(): string
    {
        return ShopifySync::RESOURCE_ORDER;
    }

    /**
     * @inheritDoc
     */
    protected function syncResource(bool $simulate, bool $fresh): Collection
    {
        // we do not use the SyncsToShopify sync() here. We have too many Orders to complete in a single run,
        // and so the logic had to be split up and chunked.
        // All of that is done in the handle function, and so this function is never used.
        return collect();
    }

    /**
     * @inheritDoc
     */
    protected function getEcommerceEntityRepository(): RepositoryBase|EntityRepository
    {
        return $this->orderRepository;
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
    protected function getLastSyncAtOverride(): null|Carbon
    {
        return $this->lastSyncAt;
    }
}
