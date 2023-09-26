<?php

namespace App\Modules\Ecommerce\Console\Commands;

use App\Console\Commands\Traits\SyncsToShopify;
use App\Modules\Ecommerce\Jobs\Shopify\Traits\HandlesMaskedEmailAddress;
use Carbon\Carbon;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
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
use Signifly\Shopify\REST\Resources\OrderResource;
use Signifly\Shopify\Shopify;

class SyncOrdersToShopify extends Command
{
    use SyncsToShopify, HandlesMaskedEmailAddress;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'shopify:sync-orders
                            {--limit= : (Optional) The number of order to limit this run to}
                            {--fresh : Sync all orders, not just those that need it}
                            {--execute : Execute this sync to Shopify. Without this flag, it will be simulated. }';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync our orders up to Shopify';

    protected Shopify $shopify;
    protected CustomerRepository $customerRepository;
    protected OrderRepository $orderRepository;
    protected OrderItemRepository $orderItemRepository;
    protected ProductRepository $productRepository;
    protected PaymentRepository $paymentRepository;
    protected RefundRepository $refundRepository;
    protected EcommerceEntityManager $entityManager;

    // the date and time that the last sync for this entity was performed
    protected Carbon $lastSyncAt;

    // running collection of the Shopify IDs returned in this run, so we can record it
    protected Collection $shopifyIds;

    // rows for displaying the results in a table
    protected array $tableRows = [];

    // constants for tracking results of creating fulfillments
    const TABLE_ITEM_ID = "item_id";
    const TABLE_SHOPIFY_FULFILLMENT_ID = "shopify_fulfillment_id";
    const TABLE_ITEM_ACTION = "order_item_fulfillment_action";
    const DEFAULT_CURRENCY = "USD";

    /**
     * Execute the console command.
     *
     * @param Shopify $shopify
     * @param CustomerRepository $customerRepository
     * @param OrderRepository $orderRepository
     * @param OrderItemRepository $orderItemRepository
     * @param PaymentRepository $paymentRepository
     * @param ProductRepository $productRepository
     * @param RefundRepository $refundRepository
     * @param EcommerceEntityManager $entityManager
     * @return int
     */
    public function handle(Shopify $shopify,
                           CustomerRepository $customerRepository,
                           OrderRepository $orderRepository,
                           OrderItemRepository $orderItemRepository,
                           PaymentRepository $paymentRepository,
                           ProductRepository $productRepository,
                           RefundRepository $refundRepository,
                           EcommerceEntityManager $entityManager): int
    {
        $this->shopify = $shopify;
        $this->customerRepository = $customerRepository;
        $this->orderRepository = $orderRepository;
        $this->orderItemRepository = $orderItemRepository;
        $this->paymentRepository = $paymentRepository;
        $this->productRepository = $productRepository;
        $this->refundRepository = $refundRepository;
        $this->entityManager = $entityManager;

        // record this as a class variable so that it doesn't get updated with each loop of the users
        $this->lastSyncAt = $this->getDateTimeOfLastSync();

        // DEV NOTE: we do not use the SyncsToShopify sync() here. With the huge number of Orders in our
        // database, we need to loop through in batches, instead of the usual process in SyncsToShopify.
        $this->notifyStartupStatus();
        $batchSize = 50;
        $this->loopOrdersSync($batchSize);

        return self::SUCCESS;
    }
    /**
     * Get all the orders that need to be synced, and perform the sync action on each one
     *
     * @param int $batchSize
     * @return void
     */
    private function loopOrdersSync(int $batchSize): void
    {
        $fresh = $this->getIsFresh();
        $limit = $this->getLimit();
        $tableHeader = [
            "Order ID",
            "Order Item ID",
            "Payment ID",
            "Order Item Fulfillment ID",
            "Refund ID",
            "Action",
            "Shopify ID"
        ];
        $this->tableRows = [];

        // get the orders, using pagination to keep from blowing up the memory usage
        $qb = $this->orderRepository->createQueryBuilder('entity');
        if (!$fresh) {
            $this->info(
                sprintf("Retrieving all orders that have not been synced, or have been updated since %s ...",
                    $this->lastSyncAt->toString())
            );

            // we also need to check if any of the order's order items or order item fulfillments need to be synced,
            // so create query builders for each of those
            $orderItemQB = new QueryBuilder($this->entityManager);
            $orderItemFulfillmentQB = new QueryBuilder($this->entityManager);

            $qb->where(
                $qb->expr()
                    ->isNull("entity.shopifyId")
            )->orWhere(
                $qb->expr()
                    ->gt("entity.updatedAt", ":lastSyncAt")
            )->orWhere(
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
                )
            )->orWhere(
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
            )->setParameter("lastSyncAt", $this->lastSyncAt);
        }

        if ($limit) {
            $qb->setMaxResults($limit);
        }
        $q = $qb->getQuery();
        $paginator = new Paginator($q);

        $totalCount = count($paginator);

        $infoString = "Found {$totalCount} orders to be synced.";
        if ($limit) {
            $infoString .= " Limiting to {$limit}.";
        }
        $infoString .= " Performing in batches of {$batchSize}.";
        $this->info($infoString);

        $batchRun = 0;
        $totalCountForRun = is_null($limit) ? $totalCount : min($totalCount, $limit);
        $totalBatchesToRun = intval(ceil($totalCountForRun / $batchSize));
        $bar = $this->output->createProgressBar($batchSize);

        foreach ($paginator as $index => $order) {

            // starting the batch
            if ($index % $batchSize === 0) {
                // start the sync log and prep the progress bar and table
                ++$batchRun;
                $this->newLine();
                $this->info(sprintf("Running Orders batch %s of %s", $batchRun, $totalBatchesToRun));
                $this->shopifyIds = collect();
                $this->createSyncLogIfExecuting();
                // if this is the last run of the batches, set the progress bar's size
                if ($batchRun === $totalBatchesToRun)
                {
                    $bar = $this->output->createProgressBar($totalCountForRun % $batchSize);
                }
                $bar->start();
            }

            // TODO: remove this check once all users/customers have been synced
            $skip = false;
            if (!is_null($order->getUser())) {
                // the user is returned with only their id and email, so get the id and get a fresh copy
                try {
                    $user = User::find($order->getUser()->getId());
                    if (is_null($user->shopify_id)) {
                        $this->tableRows[] = [$order->getId(), "--", "--", "--", "--", "<error>SKIPPED</error>", "User has not been synced to Shopify"];
                        $skip = true;
                    }
                } catch (ORMException $e) {
                    $this->error(sprintf("Could not find user by ID %s", $order->getUser()->getId()));
                    $this->tableRows[] = [$order->getId(), "--", "--", "--", "--", "<error>SKIPPED</error>", "User not found"];
                    $skip = true;
                }
            } elseif (!is_null($order->getCustomer())) {
                // the customer is returned with only their id and email, so get the id and get a fresh copy
                try {
                    $customer = $this->customerRepository->find($order->getCustomer()->getId());
                    if (is_null($customer->getShopifyId())) {
                        $this->tableRows[] = [$order->getId(), "--", "--", "--", "--", "<error>SKIPPED</error>", "Customer has not been synced to Shopify"];
                        $skip = true;
                    }
                } catch (ORMException $e) {
                    $this->error(sprintf("Could not find customer by ID %s", $order->getCustomer()->getId()));
                    $this->tableRows[] = [$order->getId(), "--", "--", "--", "--", "<error>SKIPPED</error>", "Customer not found"];
                    $skip = true;
                }
            } else {
                // something went very wrong here
                $this->error(sprintf("No user or customer found for Order ID %s. Skipping order sync.", $order->getId()));
                $skip = true;
            }

            if (!$skip) {
                $this->syncOrder($order, $fresh, $index + 1);
                // safety check for the rate limit
                $this->handleRateLimit();
            }

            $bar->advance();

            // batch has ended
            if (($index % $batchSize === $batchSize-1) || $index+1 === $totalCountForRun) {
                // print progress bar and table
                $bar->finish();
                $this->newLine();
                $this->table($tableHeader, $this->tableRows);
                // finish the sync log
                $this->finishSyncLogIfExecuting($this->shopifyIds);
                // and clear the table rows for the next run
                $this->tableRows = [];
            }
        }
    }

    /**
     * Sync the order up to Shopify
     *
     * @param Order $order
     * @param bool $fresh
     * @param int|null $simulatedShopifyId
     * @return void
     */
    private function syncOrder(Order $order, bool $fresh, ?int $simulatedShopifyId): void
    {
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
            $this->error(sprintf("Failed to find User or Customer for Order ID %s",
                $order->getId()));
            // record the failure in the table then exit out for this order
            $this->tableRows[] = [$order->getId(), "--", "--", "--", "--", "<error>FAILED</error>", $e->getMessage()];
            return;
        }

        // STEP 3: send the data to Shopify
        if (!$this->getIsSimulation()) {
            try {
                // STEP 4a: create the Order in Shopify
                if ($isCreating) {
                    $orderResource = $this->shopify->createOrder($postData);
                    $orderShopifyId = $orderResource->id;
                } else {
                    if ($needsToUpdate) {
                        $orderResource = $this->shopify->updateOrder($order->getShopifyId(), $postData);
                    } else {
                        $orderResource = null;
                        $this->tableRows[] = [$order->getId(), "--", "--", "--", "--", "Skipped", $order->getShopifyId()];
                    }
                    $orderShopifyId = $order->getShopifyId();
                }
            } catch (ValidationException $exception) {
                $this->error(sprintf("Validation failed when sending order data to Shopify: %s",
                    $exception->getMessage()));
                $this->error(sprintf("Please investigate for Order ID %s. Attempted order data: %s",
                    $order->getId(), json_encode($postData)));
                // record the failure in the table then exit out for this order
                $this->tableRows[] = [$order->getId(), "--", "--", "--", "--", "<error>FAILED</error>", $exception->getMessage()];
                return;
            }

            try {
                // record the shopify ID on the Order
                if ($order->getShopifyId() !== $orderShopifyId) {
                    $order->setShopifyId($orderShopifyId);
                    $this->entityManager->persist($order);
                    $this->entityManager->flush();
                }
                $this->shopifyIds->push($orderShopifyId);
                $this->tableRows[] = [$order->getId(), "--", "--", "--", "--", $isCreating ? "Created" : "Updated", $orderShopifyId];
            } catch (\Doctrine\ORM\Exception\ORMException $e) {
                $this->error(sprintf("Failed to save shopify_id for order ID %s: %s",
                    $order->getId(), $e->getMessage()));
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
                            $lineItem->setShopifyId($lineItemShopifyId);
                            $this->entityManager->persist($lineItem);
                            $this->entityManager->flush();
                        }
                        $this->tableRows[] = [
                            $order->getId(),
                            $sentLineItem["ecommerce_order_item_id"],
                            "--",
                            "--",
                            "--",
                            $isCreatedLineItem ? "Created" : "Updated",
                            $lineItemShopifyId
                        ];
                    } catch (\Doctrine\ORM\Exception\ORMException $e) {
                        $this->error(sprintf("Failed to save shopify_id for order item ID %s: %s",
                            $sentLineItem["ecommerce_order_item_id"], $e->getMessage()));
                    } catch (ORMException $e) {
                        $this->error(sprintf("Could not find order item with ID %s: %s",
                            $sentLineItem["ecommerce_order_item_id"], $e->getMessage()));
                    }
                }
            }

            // STEP 5: add payments
            $this->sendPaymentsForOrderToShopify($order);

            // STEP 6: add the Fulfillments and tracking
            $fulfillmentOrder = $this->getFulfillmentOrderResource($order);
            if (is_null($fulfillmentOrder)) {
                $this->error(sprintf("Failed to retrieve Fulfillment Order Resource from Shopify for Order ID %s",
                    $order->getId()));
                // record the failure in the table then exit out for this order
                $this->tableRows[] = [$order->getId(), "--", "--", "--", "--", "<error>FAILED</error>", "No Fulfillment Order Resource"];
                return;
            }
            $fulfillmentOrderStatus = $fulfillmentOrder->getAttributes()["status"];

            // get each line item from the fulfillment order
            $lineItems = $fulfillmentOrder->getAttributes()["line_items"];
            // and for each line item...
            foreach ($lineItems as $lineItemData) {
                try {
                    $fulfillmentRecords = $this->sendFulfillmentsForOrderItemToShopify($lineItemData["fulfillment_order_id"],
                        $lineItemData["line_item_id"],
                        $lineItemData["id"],
                        $fulfillmentOrderStatus);
                    // ... record the fulfillment(s) made for the line item
                    if ($fulfillmentRecords) {
                        foreach ($fulfillmentRecords as $fulfillmentRecord) {
                            // print any records for fulfillments
                            $this->tableRows[] = [
                                $order->getId(),
                                "--",
                                "--",
                                $fulfillmentRecord[self::TABLE_ITEM_ID],
                                "--",
                                $fulfillmentRecord[self::TABLE_ITEM_ACTION],
                                $fulfillmentRecord[self::TABLE_SHOPIFY_FULFILLMENT_ID]
                            ];
                        }
                    }
                } catch (Exception $e) {
                    $this->error(sprintf("Failed to send fulfillments data to Shopify for order ID %s: %s",
                        $order->getId(), $e->getMessage()));
                }
            }
            // STEP 7: add any refunds
            $this->sendRefundsForOrderToShopify($order);
        } else {
            // simulating
            $orderShopifyId = $order->getShopifyId() ?? $simulatedShopifyId;
            // record the action for the order
            if ($isCreating) {
                $action = "Created";
            } elseif($needsToUpdate) {
                $action = "Updated";
            } else {
                $action = "Skipped";
            }
            $this->tableRows[] = [$order->getId(), "--", "--", "--", "--", $action, $orderShopifyId];

            // record the payment creations, but we won't actually do it
            $payments = $this->getPaymentsDataToSync($order);
            $payments->each(fn(array $paymentData)  => $this->tableRows[] = [
                $order->getId(),
                "--",
                $paymentData["id"],
                "--",
                "--",
                "Created",
                $orderShopifyId+$paymentData["id"]
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
                $this->tableRows[] = [
                    $order->getId(),
                    $lineItemData["ecommerce_order_item_id"],
                    "--",
                    "--",
                    "--",
                    $lineItemData["shopify_id"] ? "Updated" : "Created",
                    $lineItemShopifyId
                ];

                try {
                    $fulfillmentRecords = $this->sendFulfillmentsForOrderItemToShopify($lineItemData["ecommerce_order_item_id"],
                        $lineItemShopifyId,
                        $fulfillmentOrderLineItemId,
                        $fulfillmentOrderStatus
                    );
                    // record the fulfillment(s) made for the line item
                    if ($fulfillmentRecords) {
                        foreach ($fulfillmentRecords as $fulfillmentRecord) {
                            // print any records for fulfillments
                            $this->tableRows[] = [
                                $order->getId(),
                                "--",
                                $fulfillmentRecord[self::TABLE_ITEM_ID],
                                "--",
                                "--",
                                $fulfillmentRecord[self::TABLE_ITEM_ACTION],
                                $fulfillmentRecord[self::TABLE_SHOPIFY_FULFILLMENT_ID]
                            ];
                        }
                    }
                } catch (Exception $e) {
                    $this->error(sprintf("Failed to send fulfillments data to Shopify for order ID %s: %s",
                        $order->getId(), $e->getMessage()));
                }
            }
            // record the refunds, but we won't actually do it
            $refunds = $this->getRefundsToSync($order);
            $refunds->each(fn(Refund $refund)  => $this->tableRows[] = [
                $order->getId(),
                "--",
                "--",
                "--",
                $refund->getId(),
                "Created",
                $orderShopifyId+$refund->getId()
            ]);

        }
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
     * This order could be in our data set to sync either because it needs to be synced up with Shopify,
     * or because its order item(s) or order item fulfillment(s) need to be synced. This function checks if the
     * order itself needs to be synced or not.
     *
     * @param Order $order
     * @return bool
     */
    private function doesOrderNeedToSync(Order $order): bool
    {
        return is_null($order->getShopifyId()) || $this->lastSyncAt->isBefore($order->getUpdatedAt());
    }

    /**
     * Create the data to post to Shopify to create an Order
     *
     * @param Order $order
     * @param bool $withMetafields
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
            "note" => $order->getNote(),
            "processed_at" => $order->getCreatedAt()->toIso8601String(),
            "source_name" => $order->getBrand(),
            "subtotal_price" => number_format(($order->getProductDue()?? ($order->getTotalDue() - $order->getTaxesDue() - $order->getShippingDue())) ?? 0, 2),
            "total_outstanding" => number_format(($order->getTotalDue() - $order->getTotalPaid()) ?? 0, 2),
            "total_price" => number_format($order->getTotalDue() ?? 0, 2),
            "total_tax" => number_format($order->getTaxesDue() ?? 0, 2),
            // "tags" => "",
        ];

        if ($withMetafields) {
            // refer to https://shopify.dev/docs/apps/custom-data/metafields/types
            // we can use meta fields for stuff like our order id, etc
            $orderData["metafields"] = [
                [
                    "key" => "_id",
                    "value" => $order->getId(),
                    "type" => "number_integer",
                    "namespace" => "orders"
                ]
            ];
        }

        if ($order->getTaxesDue()) {
            $orderData["tax_lines"] = [
                [ "price" => $order->getTaxesDue()]
            ];
        }

        // the proper addresses should already have been synced by the user/customer, so only use it if Shopify has it
        if ($order->getBillingAddress()?->getShopifyId()) {
            $orderData["billing_address"] = [ "id" => $order->getBillingAddress()->getShopifyId()];
        }
        if ($order->getShippingAddress()?->getShopifyId()) {
            $orderData["shipping_address"] = [ "id" => $order->getShippingAddress()->getShopifyId()];
        }

        $orderData["line_items"] = $this->createOrderItems($order);

        return $orderData;
    }

    /**
     * Create the data required for all Order Items of the Order
     *
     * @param Order $order
     * @return array
     */
    private function createOrderItems(Order $order): array
    {
        $orderItemsData = [];
        collect($order->getOrderItems())->each(function (OrderItem $orderItem) use ($order, &$orderItemsData) {
            $data = [
                // include the shopify_id, if we have one, so we know if we're updating or creating - shopify will just ignore this
                "shopify_id" => $orderItem->getShopifyId(),
                // include our internal id, so we can reference it to update - shopify will just ignore this
                "ecommerce_order_item_id" => $orderItem->getId(),
                "fulfillable_quantity" => $orderItem->getQuantity(),
                "fulfillment_service" => "manual",
                "price" => number_format($orderItem->getFinalPrice() ?? 0, 2),
                "quantity" => $orderItem->getQuantity(),
                "requires_shipping" => $orderItem->getWeight() > 0,
                "sku" => $orderItem->getProduct()?->getSku(),
                "title" => $orderItem->getProduct()?->getName(),
                "variant_id" => $orderItem->getProduct()?->getShopifyId(),
                "variant_inventory_management" => "shopify",
                "vendor" => $order->getBrand(),
            ];

            if ($orderItem->getTotalDiscounted()) {
                $data["applied_discounts"] = [
                    [
                        "amount" =>  number_format($orderItem->getTotalDiscounted(), 2)
                    ]
                ];
            }

            /*
            // DEV NOTE: this seems to be nearly what we'd need to properly apply discounts to build up the discount process,
            // but we won't worry about that for these historical updates and will simply use the total_discounted on each
            // order item. Leaving this here for now, in case it's useful later on.
           if ($orderItem->getOrderItemDiscounts()) {
               // clean up bad data (there are some with discount id 0)
               $orderDiscounts = collect($orderItem->getOrderItemDiscounts())
                   ->filter(function (OrderDiscount $orderDiscount) {
                       return $orderDiscount->getDiscount()->getId();
                   }
                );

               $discountsData = [];
               $orderDiscounts->each(function (OrderDiscount $orderDiscount) use (&$discountsData) {
                       $discountsData[] = [ "amount" => $orderDiscount->getDiscount()?->getAmount()];
                   });
                $data["discount_allocations"] = $discountsData;
           }
            */
            $orderItemsData[] = $data;
        });

        return $orderItemsData;
    }


    /**
     * Get the unsynced payments for this order, and send the data to Shopify to create a payment transaction
     * for each one, recording the result's shopify_id
     *
     * @param Order $order
     * @return void
     */
    private function sendPaymentsForOrderToShopify(Order $order): void
    {
        $this->getPaymentsDataToSync($order)->each(function(array $paymentData) use ($order) {
            $paymentId = $paymentData["id"];
            try {
                $paymentResource = $this->shopify->createOrderTransaction($order->getShopifyId(), $paymentData["data"]);
                $paymentShopifyId = $paymentResource->id;

                // record the shopify ID on the Payment
                $payment = $this->paymentRepository->find($paymentId);
                $payment->setShopifyId($paymentShopifyId);
                $this->entityManager->persist($payment);
                $this->entityManager->flush();

                $this->shopifyIds->push($paymentShopifyId);
                $this->tableRows[] = [$order->getId(), "--", $paymentId, "--", "--", "Created" , $paymentShopifyId];

            } catch (ValidationException $exception) {
                $this->error(sprintf("Validation failed when sending order transaction to Shopify: %s",
                    $exception->getMessage()));
                $this->error(sprintf("Please investigate for Order ID %s. Attempted order data: %s",
                    $order->getId(), json_encode($paymentData["data"])));
                $this->tableRows[] = [$order->getId(), "--", $paymentId, "--", "--", "<error>FAILED</error>", $exception->getMessage()];
            } catch (\Doctrine\ORM\Exception\ORMException $exception) {
                $this->error(sprintf("Failed to save shopify_id for payment ID %s: %s",
                    $paymentId, $exception->getMessage()));
                $this->tableRows[] = [$order->getId(), "--", $paymentId, "--", "--", "<error>FAILED</error>", $exception->getMessage()];
            }
        });
    }

    /**
     * Get all payments for this order that need to be synced up to Shopify, and transform the data into the
     * format required by Shopify
     *
     * @param Order $order
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
            ->filter(fn(Payment $payment) => is_null($payment->getShopifyId()) && $payment->getStatus() === Payment::STATUS_PAID);

        return $payments->transform(function(Payment $payment) {
            return
                [
                    "id" => $payment->getId(),
                    "data" =>
                        [
                            "amount" => number_format($payment->getTotalPaid(), 2),
                            "kind" => "sale",
                            // DEV NOTE: this is not documented in Shopify, but it is required
                            "source" => "external"
                        ]
                ];
        });
    }

    /**
     * Get the unsynced refunds for this order, and complete the process to perform a refund in Shopify for each one,
     * recording the result's shopify_id
     *
     * @param Order $order
     * @return void
     */
    private function sendRefundsForOrderToShopify(Order $order): void
    {
        $orderShopifyId = $order->getShopifyId();
        // get any refunds that need to be sent
        $refunds = $this->getRefundsToSync($order);
        if ($refunds->isEmpty()) {
            return;
        }

        // 1. orders are automatically closed (or "archived", as it's also called), and refunds cannot be issued to
        // closed orders. So before we issue any, we need to check the status, and reopen the order, if it's closed
        $orderShopifyAttributes = $this->shopify->getOrder($orderShopifyId)->getAttributes();
        $wasReopened = false;

        if ($orderShopifyAttributes["closed_at"]) {
            $this->shopify->openOrder($orderShopifyId);
            $wasReopened = true;
        }

        $refunds->each(function (Refund $refund) use ($order, $orderShopifyId) {
            $paymentToRefund = $refund->getPayment();
            if (is_null($paymentToRefund)) {
                $this->error(sprintf("No payment found for Refund ID %s. Refund cannot be sent to Shopify",
                    $refund->getId()));
                $this->tableRows[] = [$order->getId(), "--", "--", "--", $refund->getId(), "<error>FAILED</error>", "Payment not found"];
                return;
            }

            // 2. use the calculate endpoint to initiate the process
            $currency = $paymentToRefund->getCurrency() ?? self::DEFAULT_CURRENCY;
            $calculateResponse = $this->shopify->calculateOrderRefund($orderShopifyId,
                [
                    "currency" => $currency
                ]
            );

            // check the transactions in the response, to make sure our payment is in there, so we can use its Shopify ID with the refund
            $transactionData = collect($calculateResponse->getAttributes()["transactions"])
                ->firstWhere("parent_id", $paymentToRefund->getShopifyId());

            if (is_null($transactionData)) {
                $this->error(sprintf("Shopify did not return a transaction for our Payment ID %s, attempting for Refund ID %s. Refund cannot be sent to Shopify",
                    $paymentToRefund->getId(), $refund->getId()));
                $this->tableRows[] = [$order->getId(), "--", "--", "--", $refund->getId(), "<error>FAILED</error>", "Payment not in calculated refund"];
                return;
            }

            // safety check that we're not trying to refund more than we're allowed
            if ($refund->getRefundedAmount() > floatval($transactionData["maximum_refundable"])) {
                $this->error(sprintf("Attempting to refund %s for Refund ID %s, which exceeds the maximum_refundable of %s. Refund cannot be sent to Shopify",
                    number_format($refund->getRefundedAmount(), 2), $refund->getId(), $transactionData["maximum_refundable"]));
                $this->tableRows[] = [$order->getId(), "--", "--", "--", $refund->getId(), "<error>FAILED</error>", "Refund amount too high"];
                return;
            }

            // 3. we can now make the actual refund
            $refundData = [
                "currency" => $currency,
                "notify" => false,
                "transactions" => [
                    [
                        "parent_id" => $paymentToRefund->getShopifyId(),
                        "amount" => $refund->getRefundedAmount(),
                        "kind" => "refund"
                    ]
                ]
            ];
            if ($refund->getNote()){
                $refundData["note"] = $refund->getNote();
            }

            $refundResource = $this->shopify->createOrderRefund($orderShopifyId, $refundData);
            $refundShopifyId = $refundResource->id;

            // record the shopify ID on the Refund
            $refund->setShopifyId($refundShopifyId);
            try {
                $this->entityManager->persist($refund);
                $this->entityManager->flush();

                $this->shopifyIds->push($refundShopifyId);
                $this->tableRows[] = [$order->getId(), "--", "--", "--", $refund->getId(), "Created" , $refundShopifyId];
            } catch (\Doctrine\ORM\Exception\ORMException $e) {
                $this->error(sprintf("Failed to save shopify_id for refund ID %s: %s",
                    $refund->getId(), $e->getMessage()));
            }
        });

        // 4. if we had to reopen the order, we need to close it again
        if ($wasReopened) {
            $this->shopify->closeOrder($orderShopifyId);
        }
    }

    /**
     * Get a collection of refunds that need to be synced for this order
     *
     * @param Order $order
     * @return Collection
     */
    private function getRefundsToSync(Order $order): Collection
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

        return collect($refunds)->filter(fn (Refund $refund) => is_null($refund->getShopifyId()));
    }

    /**
     * Using the Shopify Order Line Item's ID, get our related Order Item and create a fulfillment record for it in
     * Shopify for each of our fulfillments for it, and provide the status and tracking information, if available.
     * Returning a formatted array of the Order Item Fulfillment ID and the corresponding Shopify ID.
     *
     * @param int $fulfillmentOrderId the Shopify ID of the Fulfillment Order we're fulfilling
     * @param int $orderItemShopifyId the Shopify ID of the line item being filled (used to find our corresponding OrderItem)
     * @param int $fulfillmentOrderLineItemId the Shopify ID of the fulfillment's line item, needed to tell Shopify which item we're fulfilling
     * @param string $fulfillmentOrderStatus the status of the Order's Fulfillment Order in Shopify
     * @return array|null
     * @throws Exception
     */
    private function sendFulfillmentsForOrderItemToShopify(int $fulfillmentOrderId,
                                                           int $orderItemShopifyId,
                                                           int $fulfillmentOrderLineItemId,
                                                           string $fulfillmentOrderStatus): ?array
    {
        if ($this->getIsSimulation()) {
            // if we're simulating, we passed in the order item's ID as the $fulfillmentOrderId
            $orderItem = $this->orderItemRepository->find($fulfillmentOrderId);
        } else {
            $orderItem = $this->orderItemRepository->getByShopifyId($orderItemShopifyId);
        }
        if (is_null($orderItem)) {
            throw new Exception(sprintf("No ecommerce Order Item found for shopify_id %s. Skipping fulfillment process with Shopify.", $orderItemShopifyId));
        }

        // get the product, so we can see how to handle its fulfillment
        if ($productEntity = $orderItem->getProduct()) {
            // the product might be inactive, so use the id to get a fresh copy with all its data
            $product = $this->productRepository->findProduct($productEntity->getId(), [0,1]);

            if ($product->getType() === Product::TYPE_DIGITAL_SUBSCRIPTION || $product->getType() === Product::TYPE_DIGITAL_ONE_TIME){
                return $this->fulfillDigitalProduct($fulfillmentOrderId, $fulfillmentOrderLineItemId, $orderItem->getQuantity() ?? 0, $fulfillmentOrderStatus);
            } elseif($product->getType() === Product::TYPE_PHYSICAL_ONE_TIME) {
                return $this->fulfillPhysicalProduct($fulfillmentOrderId, $fulfillmentOrderLineItemId, $orderItem);
            } else {
                throw new Exception(sprintf("Unknown product type %s. Cannot create Shopify Fulfillment.",
                    $product->getType()));
            }
        }
        return [];
    }

    /**
     * Handle fulfilling an order item in Shopify for a physical product, including its tracking information,
     * if applicable
     *
     * @param int $fulfillmentOrderId
     * @param int $fulfillmentOrderLineItemId
     * @param OrderItem $orderItem
     * @return array<array> array of result arrays
     */
    private function fulfillPhysicalProduct(int $fulfillmentOrderId, int $fulfillmentOrderLineItemId, OrderItem $orderItem): array
    {
        $fulfillmentRecords = [];
        // physical products might have fulfillments, so check for any
        $fulfillments = collect($orderItem->getOrderItemFulfillments());

        if ($fulfillments->isEmpty()) {
            $resultRecord = [
                self::TABLE_ITEM_ID => "<bg=yellow;fg=black>No fulfillments for order item</bg=yellow;fg=black>",
                self::TABLE_SHOPIFY_FULFILLMENT_ID => "N/A",
                self::TABLE_ITEM_ACTION => "Skipped"
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
                    self::TABLE_ITEM_ID => $fulfillment->getId(),
                    self::TABLE_SHOPIFY_FULFILLMENT_ID => $orderItem->getShopifyId() . "-fulfil" . $idx,
                    self::TABLE_ITEM_ACTION => $isNewFulFillment ? "Created" : "Updated"
                ];
                $fulfillmentRecords[] = $resultRecord;
                if (!is_null($fulfillment->getTrackingNumber())) {
                    $fulfillmentRecords[] = $this->sendTrackingInfoForFulfillmentToShopify($fulfillment, []);
                }
            } else {
                // we only need to create new fulfillments
                if ($isNewFulFillment) {
                    $fulfillmentResult = $this->shopify->createFulfillment($fulfillmentData);
                    $fulfillmentShopifyId = $fulfillmentResult->getAttributes()["id"];
                    $resultRecord = [
                        self::TABLE_ITEM_ID => $fulfillment->getId(),
                        self::TABLE_SHOPIFY_FULFILLMENT_ID => $fulfillmentShopifyId,
                        self::TABLE_ITEM_ACTION => "Created"
                    ];
                    $fulfillmentRecords[] = $resultRecord;

                    // record the result's id as the shopify_id on our fulfillment
                    try {
                        if ($fulfillment->getShopifyId() !== $fulfillmentShopifyId) {
                            $fulfillment->setShopifyId($fulfillmentShopifyId);
                            $this->entityManager->persist($fulfillment);
                            $this->entityManager->flush();
                        }
                    } catch (\Doctrine\ORM\Exception\ORMException $e) {
                        $this->error(sprintf("Failed to save shopify_id for order item fulfillment ID %s: %s",
                            $fulfillment->getId(), $e->getMessage()));
                    }
                } else {
                    // retrieve the fulfillment data from Shopify, so we can handle its tracking information
                    $fulfillmentResult = $this->shopify->getOrderFulfillment($orderItem->getOrder()->getShopifyId(), $fulfillment->getShopifyId());
                    $resultRecord = [
                        self::TABLE_ITEM_ID => $fulfillment->getId(),
                        self::TABLE_SHOPIFY_FULFILLMENT_ID => $fulfillment->getShopifyId(),
                        self::TABLE_ITEM_ACTION => "Skipped"
                    ];
                }

                $fulfillmentRecords[] = $resultRecord;

                if (!is_null($fulfillment->getTrackingNumber())) {
                    $fulfillmentRecords[] = $this->sendTrackingInfoForFulfillmentToShopify($fulfillment, $fulfillmentResult->getAttributes());
                }
            }
        });

        return $fulfillmentRecords;
    }

    /**
     * Get our tracking information for the given Order Item Fulfillment, and update the Shopify fulfillment with
     * the tracking information, if it's different.
     *
     * @param OrderItemFulfillment $fulfillment
     * @param array $shopifyFulfillmentAttributes
     * @return string[] array of result data to display in the table
     */
    private function sendTrackingInfoForFulfillmentToShopify(OrderItemFulfillment $fulfillment, array $shopifyFulfillmentAttributes): array
    {
        $resultRecord = [
            self::TABLE_ITEM_ID => $fulfillment->getId() . " tracking",
            self::TABLE_SHOPIFY_FULFILLMENT_ID => "N/A",
        ];

        if ($this->getIsSimulation()) {
            // if we're simulating, we don't have a real $shopifyFulfillmentAttributes because we didn't send the data
            // to Shopify, so get the fulfillment data if it exists
            if (!is_null($fulfillment->getShopifyId())) {
                $orderFulfillmentResource = $this->shopify->getOrderFulfillment($fulfillment->getOrder()->getShopifyId(), $fulfillment->getShopifyId());
                $shopifyFulfillmentAttributes = $orderFulfillmentResource->getAttributes();
            } else {
                // otherwise, just fake creating a new one
                $resultRecord [self::TABLE_ITEM_ACTION] = "Created";
                return $resultRecord;
            }
        }
        $isCreating = is_null($shopifyFulfillmentAttributes["tracking_number"]);

        // if the tracking number already exists, make sure we have a change that needs to be sent
        if ($shopifyFulfillmentAttributes["tracking_number"] === $fulfillment->getTrackingNumber() &&
            $shopifyFulfillmentAttributes["tracking_company"] === $fulfillment->getCompany())
        {
            $resultRecord [self::TABLE_ITEM_ACTION] = "Skipped";
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
        }
        $resultRecord [self::TABLE_ITEM_ACTION] = $isCreating ? "Created" : "Updated";
        return $resultRecord;
    }

    /**
     * Handle fulfilling an order item in Shopify for a digital product.
     *
     * @param int $fulfillmentOrderId
     * @param int $fulfillmentOrderLineItemId
     * @param int $quantity
     * @param string $fulfillmentOrderStatus
     * @return array<array> array of result arrays
     */
    private function fulfillDigitalProduct(int $fulfillmentOrderId, int $fulfillmentOrderLineItemId, int $quantity, string $fulfillmentOrderStatus): array
    {
        $fulfillmentRecords = [];
        $record = [
            self::TABLE_ITEM_ID => "N/A for digital product",
        ];

        // digital products don't have fulfillments in Musora, so just create an empty one in Shopify to mark
        // it as fulfilled, if we haven't already
        if ($fulfillmentOrderStatus === "closed") {
            // if the fulfillment order is already closed, there's nothing for us to do here
            $record[self::TABLE_SHOPIFY_FULFILLMENT_ID] = $fulfillmentOrderLineItemId;
            $record[self::TABLE_ITEM_ACTION] = "Skipped";
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

        $record[self::TABLE_ITEM_ACTION] = "Created";
        if ($this->getIsSimulation()) {
            $record[self::TABLE_SHOPIFY_FULFILLMENT_ID] = $fulfillmentOrderLineItemId;
        } else {
            $fulfillmentResult = $this->shopify->createFulfillment($fulfillmentData);
            $record[self::TABLE_SHOPIFY_FULFILLMENT_ID] = $fulfillmentResult->getAttributes()["id"];
        }
        $fulfillmentRecords[] = $record;

        return $fulfillmentRecords;
    }

    /**
     * Get the Fulfillment Order Resource from Shopify, for this Order
     *
     * @param Order $order
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
        } else {
            // if we're simulating, try to get the order's fulfillment orders from shopify, if we have a real shopify id
            if (!is_null($orderShopifyId)) {
                $fulfillmentOrders = $this->shopify->getOrderFulfillmentOrders($orderShopifyId);
            }
        }

        // there can be multiple fulfillment orders (but realistically, there will most likely only be one), so grab the last entry
        return $fulfillmentOrders?->last() ?? null;
    }

    /**
     * @inheritDoc
     */
    protected function getShopifyResourceClass(): string
    {
        return OrderResource::class;
    }

    /**
     * @inheritDoc
     */
    protected function getSyncResource(): string
    {
        return "order";
    }

    /**
     * @inheritDoc
     */
    function getIsSimulation(): bool
    {
        return $this->option("execute") == false;
    }

    /**
     * @inheritDoc
     */
    function getIsFresh(): bool
    {
        return $this->option("fresh");
    }

    /**
     * @inheritDoc
     */
    function getLimit(): ?int
    {
        return $this->option("limit");
    }

    /**
     * @inheritDoc
     */
    protected function getEcommerceEntityRepository(): RepositoryBase
    {
        return $this->orderRepository;
    }

    /**
     * @inheritDoc
     */
    protected function getIsUsingMask(): bool
    {
        return !app()->isProduction();
    }
}
