<?php

namespace App\Modules\Ecommerce\Jobs\Shopify;

use App\Modules\Content\Services\ContentPermissionsService;
use App\Modules\Ecommerce\Enums\UserAccessPermissionsStatusEnum;
use App\Modules\Ecommerce\Jobs\Shopify\Traits\HandlesShopifyRateLimit;
use App\Modules\Ecommerce\Jobs\Shopify\Traits\LogsShopify;
use App\Modules\Ecommerce\Models\SubscriptionPayment;
use App\Modules\Ecommerce\Models\UserAccessPermission;
use App\Modules\Ecommerce\Services\UserAccessPermissionsService;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\Middleware\SkipIfBatchCancelled;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;
use Signifly\Shopify\Exceptions\NotFoundException;
use Signifly\Shopify\Exceptions\ValidationException;
use Signifly\Shopify\Shopify;

class CancelDuplicateSubscriptionPaymentOrders implements ShouldQueue
{
    use Batchable;
    use Dispatchable;
    use HandlesShopifyRateLimit;
    use InteractsWithQueue;
    use LogsShopify;
    use Queueable;
    use SerializesModels;

    protected const RESULTS_MESSAGE = "message";
    protected const RESULTS_MESSAGE_TYPE = "message_type";
    protected const RESULTS_MESSAGE_TYPE_SUCCESS = "success";
    protected const RESULTS_MESSAGE_TYPE_ERROR = "error";
    protected const RESULTS_MESSAGE_TYPE_WARNING = "warning";

    /**
     * The number of seconds the job can run before timing out.
     *
     * @var int
     */
    public $timeout = 840; // 14 minutes

    protected Shopify $shopify;
    protected UserAccessPermissionsService $userAccessPermissionsService;
    // rows for displaying the results in a table
    protected array $results = [];

    protected Collection $paymentIds;

    protected Collection $contentPermissionsLookup;

    protected string $mcUserLink = "";

    public function __construct(
        array $paymentIds,
        protected bool $simulate,
        protected int $batchIndex
    ) {
        $this->paymentIds = collect($paymentIds);
    }

    public function middleware(): array
    {
        return [new SkipIfBatchCancelled()];
    }

    /**
     * Execute the job
     *
     * @param  Shopify  $shopify
     * @param  UserAccessPermissionsService  $userAccessPermissionsService
     * @param  ContentPermissionsService  $contentPermissionsService
     * @return void
     */
    public function handle(
        Shopify $shopify,
        UserAccessPermissionsService $userAccessPermissionsService,
        ContentPermissionsService $contentPermissionsService
    ): void {
        // set DI instances that we'll need
        $this->shopify = $shopify;
        $this->userAccessPermissionsService = $userAccessPermissionsService;

        // get the content permissions lookup, so we can reference them later on
        $this->contentPermissionsLookup = $contentPermissionsService->getContentPermissionsLookup();

        // get the URL for Musora Center for this environment
        $this->mcUserLink = get_musora_brand_base_url()."/musora-center#/users/";

        $this->cancelDuplicateOrders();

        $this->logInfo(
            sprintf(
                "%s: Results for cancelling duplicated subscription payment orders for job %s of %s",
                $this->getClassName(),
                $this->batch()->processedJobs() + 1,
                $this->batch()->totalJobs
            )
        );

        foreach ($this->results as $result) {
            if ($result[self::RESULTS_MESSAGE_TYPE] === self::RESULTS_MESSAGE_TYPE_ERROR) {
                $this->logError(
                    sprintf(
                        "%s: %s",
                        $this->getClassName(),
                        $result[self::RESULTS_MESSAGE]
                    )
                );
            } elseif ($result[self::RESULTS_MESSAGE_TYPE] === self::RESULTS_MESSAGE_TYPE_WARNING) {
                $this->logWarning(
                    sprintf(
                        "%s: %s",
                        $this->getClassName(),
                        $result[self::RESULTS_MESSAGE]
                    )
                );
            } else {
                $this->logInfo(
                    sprintf(
                        "%s: %s",
                        $this->getClassName(),
                        $result[self::RESULTS_MESSAGE]
                    )
                );
            }
        }
    }

    /**
     * Cancel any duplicate orders in Shopify for payments in this job.
     * This will cancel any fulfillments, refund any payments, and then finally cancel the order.
     *
     * @return void
     */
    private function cancelDuplicateOrders(): void
    {
        $this->paymentIds->each(function (int $paymentId) {
            // get the extra subscription payments that we need to remove
            $subscriptionPaymentsToCancel = $this->getExtraSubscriptionPayments($paymentId);

            if ($subscriptionPaymentsToCancel->isEmpty()) {
                $this->results[] = [
                    self::RESULTS_MESSAGE_TYPE => self::RESULTS_MESSAGE_TYPE_WARNING,
                    self::RESULTS_MESSAGE => sprintf(
                        "SKIPPED No extra subscription payments to cancel with Payment ID %s",
                        $paymentId
                    )
                ];
                return;
            }

            /*
            $this->logDebug(
                sprintf(
                    "%s: Preparing to cancel subscription payments %s.",
                    $this->getClassName(),
                    $subscriptionPaymentsToCancel->implode("id", ", ")
                )
            );
            */

            $subscriptionPaymentsToCancel->each(function (SubscriptionPayment $subscriptionPayment) use ($paymentId) {
                // first ensure this subscription payment's order hasn't already been cancelled or deleted
                try {
                    $orderShopifyAttributes = $this->shopify->getOrder($subscriptionPayment->shopify_id)->getAttributes(
                    );
                    $this->handleRateLimit(true);
                } catch (NotFoundException $exception) {
                    $this->results[] = [
                        self::RESULTS_MESSAGE_TYPE => self::RESULTS_MESSAGE_TYPE_WARNING,
                        self::RESULTS_MESSAGE => sprintf(
                            "SKIPPED Subscription Payment %s already deleted",
                            $subscriptionPayment->id
                        )
                    ];
                    return;
                }

                if ($orderShopifyAttributes["cancelled_at"]) {
                    $this->results[] = [
                        self::RESULTS_MESSAGE_TYPE => self::RESULTS_MESSAGE_TYPE_WARNING,
                        self::RESULTS_MESSAGE => sprintf(
                            "SKIPPED Subscription Payment %s already cancelled",
                            $subscriptionPayment->id
                        )
                    ];
                    return;
                }

                $shopifyOrderId = $orderShopifyAttributes["id"];

                // DEV NOTE: from testing this process, we'll most likely be in a situation where the order cannot be
                // cancelled, and we'd get the error "Cannot cancel a paid and fulfilled order". So first check if the
                // order is paid and/or fulfilled, and undo each of those
                if ($orderShopifyAttributes["fulfillment_status"] === "fulfilled") {
                    $fulfillmentsData = $orderShopifyAttributes["fulfillments"];
                    $this->cancelFulfillments($fulfillmentsData, $shopifyOrderId, $paymentId);
                }

                if ($orderShopifyAttributes["financial_status"] === "paid") {
                    $this->refundPayments(
                        $orderShopifyAttributes,
                        $shopifyOrderId,
                        $paymentId,
                        $subscriptionPayment->id
                    );
                }

                try {
                    if (!$this->getIsSimulation()) {
                        $cancelResults = $this->shopify->cancelOrder($shopifyOrderId);
                        $this->handleRateLimit();
                    }

                    // we need to remove the permissions from the order
                    $this->deleteUserAccessPermissions($subscriptionPayment, $orderShopifyAttributes);

                    $this->results[] = [
                        self::RESULTS_MESSAGE_TYPE => self::RESULTS_MESSAGE_TYPE_SUCCESS,
                        self::RESULTS_MESSAGE => sprintf(
                            "Subscription Payment %s: %s",
                            $subscriptionPayment->id,
                            $this->getIsSimulation() ? "simulated cancellation" : "cancelled"
                        )
                    ];

                    // now that we've cancelled the order, it can also be deleted
                    $this->deleteOrder($shopifyOrderId);
                } catch (ValidationException $exception) {
                    $this->results[] = [
                        self::RESULTS_MESSAGE_TYPE => self::RESULTS_MESSAGE_TYPE_ERROR,
                        self::RESULTS_MESSAGE => sprintf(
                            "Shopify Order %s (Subscription Payment %s) was not cancelled",
                            $shopifyOrderId,
                            $subscriptionPayment->id
                        )
                    ];
                    $this->logError(
                        sprintf(
                            "%s: validation error(s) when attempting to cancel order %s for payment id %s: %s",
                            $this->getClassName(),
                            $shopifyOrderId,
                            $paymentId,
                            collect($exception->errors)
                        )
                    );
                }
            });
        });
    }

    /**
     * Get the extra subscription payments with the given payment id
     *
     * @param  int  $paymentId
     * @return EloquentCollection
     */
    private function getExtraSubscriptionPayments(int $paymentId): EloquentCollection
    {
        $subscriptionPayments = SubscriptionPayment::query()
            ->where("payment_id", $paymentId)
            ->whereNotNull("shopify_id")
            ->get();
        return $subscriptionPayments
            // skip the first one, so that we don't remove the one good entry
            ->skip(1);
    }

    /**
     * Cancel all fulfillments in Shopify, in the given fulfillments data retrieved from Shopify through getOrder
     *
     * @param  array  $fulfillmentsData
     * @param  int  $shopifyOrderId
     * @param  int  $paymentId
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
                    $this->handleRateLimit();
                }
                $this->results[] = [
                    self::RESULTS_MESSAGE_TYPE => self::RESULTS_MESSAGE_TYPE_SUCCESS,
                    self::RESULTS_MESSAGE => sprintf(
                        "%s fulfillment %s on order %s for payment id %s",
                        $this->getIsSimulation() ? "Simulated cancellation of" : "Cancelled",
                        $fulfillmentId,
                        $shopifyOrderId,
                        $paymentId
                    )
                ];
            }
        }
    }

    /**
     * @inheritDoc
     */
    protected function getIsSimulation(): bool
    {
        return $this->simulate;
    }

    /**
     * Go through the refund process for all payments on the given Shopify Order
     *
     * @param  array  $orderData
     * @param  int  $orderShopifyId
     * @param  int  $paymentId
     * @param  int  $subscriptionPaymentId
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
                $this->handleRateLimit();
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
        $this->handleRateLimit(true);

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
                $this->handleRateLimit();
            }
            $this->results[] = [
                self::RESULTS_MESSAGE_TYPE => self::RESULTS_MESSAGE_TYPE_SUCCESS,
                self::RESULTS_MESSAGE => sprintf(
                    "%s payment of %s %s on order %s for payment id %s.",
                    $this->getIsSimulation() ? "Simulated refund of" : "Refunded",
                    $transactionData["maximum_refundable"],
                    $currency,
                    $orderShopifyId,
                    $paymentId
                )
            ];
        }

        // 4. if we had to reopen the order, we need to close it again
        if ($wasReopened && !$this->getIsSimulation()) {
            $this->shopify->closeOrder($orderShopifyId);
            $this->handleRateLimit();
        }
    }

    /**
     * Find the User Access Permissions related to the given Shopify Order and delete each entry
     *
     * @param  SubscriptionPayment  $subscriptionPayment
     * @param  array  $shopifyOrderAttributes
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
                $this->results[] = [
                    self::RESULTS_MESSAGE_TYPE => self::RESULTS_MESSAGE_TYPE_SUCCESS,
                    self::RESULTS_MESSAGE => sprintf(
                        "Subscription Payment %s linked to User Access Permission(s) %s",
                        $subscriptionPayment->id,
                        $foundUAPs
                    )
                ];

                $userAccessPermissions->each(function (UserAccessPermission $userAccessPermission) {
                    if (!$this->getIsSimulation()) {
                        $userAccessPermission->delete();
                    }
                    $this->results[] = [
                        self::RESULTS_MESSAGE_TYPE => self::RESULTS_MESSAGE_TYPE_SUCCESS,
                        self::RESULTS_MESSAGE => sprintf(
                            "User Access Permission %s (%s %s - %s) %s",
                            $userAccessPermission->id,
                            $userAccessPermission->getDescription(),
                            $userAccessPermission->start_time,
                            $userAccessPermission->getExpirationTime(),
                            $this->getIsSimulation() ? "simulated deletion" : "deleted"
                        )
                    ];
                });
            }
        }

        // log the route to the user in MC for easy verification
        $this->results[] = [
            self::RESULTS_MESSAGE_TYPE => self::RESULTS_MESSAGE_TYPE_SUCCESS,
            self::RESULTS_MESSAGE => $this->mcUserLink.$user->id
        ];
    }

    /**
     * Delete the Shopify Order
     *
     * @param  int  $shopifyOrderId
     * @return bool whether the order was deleted
     */
    private function deleteOrder(int $shopifyOrderId): bool
    {
        if (!$this->getIsSimulation()) {
            // unfortunately, this is function doesn't return anything, so we just have to assume it worked
            $this->shopify->deleteOrder($shopifyOrderId);
            $this->handleRateLimit();

            // confirm that the deletion worked
            try {
                $this->shopify->getOrder($shopifyOrderId);
                $this->handleRateLimit();
            } catch (NotFoundException $exception) {
                $this->results[] = [
                    self::RESULTS_MESSAGE_TYPE => self::RESULTS_MESSAGE_TYPE_SUCCESS,
                    self::RESULTS_MESSAGE => sprintf(
                        "Shopify Order %s: %s",
                        $shopifyOrderId,
                        "deleted"
                    )
                ];
                return true;
            }
            // the order was found, which means we failed to delete it
            $this->results[] = [
                self::RESULTS_MESSAGE_TYPE => self::RESULTS_MESSAGE_TYPE_ERROR,
                self::RESULTS_MESSAGE => sprintf(
                    "Shopify Order %s: %s",
                    $shopifyOrderId,
                    "NOT deleted"
                )
            ];
        } else {
            $this->results[] = [
                self::RESULTS_MESSAGE_TYPE => self::RESULTS_MESSAGE_TYPE_SUCCESS,
                self::RESULTS_MESSAGE => sprintf(
                    "Shopify Order %s: %s",
                    $shopifyOrderId,
                    "simulated deletion"
                )
            ];
        }

        return false;
    }

    /**
     * @inheritDoc
     */
    protected function getClassName(): string
    {
        return "CancelDuplicateSubscriptionPaymentOrders";
    }
}
