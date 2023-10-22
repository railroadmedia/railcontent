<?php

namespace App\Modules\Ecommerce\Jobs\Shopify;

use App\Modules\Ecommerce\Jobs\Shopify\Traits\LogsShopify;
use App\Modules\Ecommerce\Jobs\Shopify\Traits\PollsShopifyBulkOperation;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Modules\UserManagementSystem\Models\User;
use Signifly\Shopify\Shopify;

/**
 * PollBulkOperationCustomer is a job used to poll Shopify for the status of the bulkOperationId on this class.
 * This job is intended to be called after BulkCustomerCreateFromUsers has run and submitted our data and request to
 * Shopify.
 * The general flow of the process is as follows:
 * 1. Poll Shopify for the status of our bulk operation
 * 2. If the bulk operation has not completed, dispatch another call of this job, with a delay
 *  - This process will repeat until one of the following occurs:
 *      - i. the bulk operation has completed
 *          - we will move on to step 3
 *      - ii. we have been attempting this poll for too long
 *          - we will request Shopify to cancel our bulk operation, and end this batch
 * 3. Use the URL provided in the completed poll response to download a .jsonl file of results
 * 4. Add a new ParseBulkOperationResultsForUsers job to this job's batch, that will parse that result file and
 *  update our users with the Shopify ID from their creation.
 *
 * Please refer to the ParseBulkOperationResultsForUsers class for notes on the process from there.
 * @see https://shopify.dev/docs/api/usage/bulk-operations/imports#option-b-poll-the-status-of-the-operation for
 * full details from Shopify
 * @see PollsShopifyBulkOperation for implementation of the polling process
 */
class PollBulkOperationCustomer implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use LogsShopify;
    use PollsShopifyBulkOperation;
    use Queueable;
    use SerializesModels;

    // 14 minutes
    protected const TIMEOUT = 840;
    protected const DELAY = 10;

    public function handle(Shopify $shopify): void
    {
        // set DI instances that we'll need
        $this->shopify = $shopify;

        try {
            $pollResponse = $this->pollShopify();
            $status = $pollResponse->status;

            if ($status !== "COMPLETED") {
                // if the batch didn't finish, keep trying until it does, or we approach our 15-minute lambda time limit
                if ($this->secondsPassed < self::TIMEOUT) {
                    sleep(self::DELAY);
                    PollBulkOperationCustomer::dispatchSync($this->bulkOperationId,
                            $this->shopifySync,
                            $this->sourceFileName,
                            $this->resourceType,
                            $this->secondsPassed+self::DELAY
                        );
                    return;
                }

                // Shopify is taking too long to process our bulk data, so cancel the operation and our whole job batch
                $this->cancelShopifyOperation();

                $timeoutMessage = sprintf("%s: Bulk Operation was not completed within our time limit."
                    . " The Shopify operation has been cancelled and this job batch has been cancelled. Please review the"
                    . " batch size of Users and try again with a lower count", $this->getClassName());

                $this->logError($timeoutMessage);
                $this->fail($timeoutMessage);
                return;
            }

            // log the run time, just to know
            $this->logInfo(sprintf("%s: Bulk Operation completed in %s seconds",
                $this->getClassName(), $pollResponse->getRuntime()));

            // if the bulk operation has been completed, we can now download the file from Shopify
            $resultsFileName = str($this->sourceFileName)
                ->beforeLast(".jsonl")
                ->append("-Results.jsonl");
            $downloadSuccess = $this->downloadFile($resultsFileName, $pollResponse->url);
            if (!$downloadSuccess){
                throw new Exception(sprintf("%s: Failed to download and store the results file from %s",
                    $this->getClassName(), $pollResponse->url));
            }

            // and dispatch another job to parse the results and update our users or customers
            if ($this->resourceType === User::class) {
                ParseBulkOperationResultsForUsers::dispatchSync($this->sourceFileName, $resultsFileName, $this->shopifySync);
            } else {
                ParseBulkOperationResultsForCustomers::dispatchSync($this->sourceFileName, $resultsFileName, $this->shopifySync);
            }

        } catch (Exception $e) {
            $this->logError($e->getMessage());
        }
    }

    /**
     * @inheritDoc
     */
    protected function getClassName(): string
    {
        return $this->resourceType === User::class ? "SyncBulkUsersToShopify" : "SyncBulkCustomersToShopify";
    }
}
