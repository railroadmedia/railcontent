<?php

namespace App\Modules\Ecommerce\Jobs\Shopify;

use App\Models\ShopifySync;
use App\Modules\Ecommerce\Jobs\Shopify\Traits\FindsCustomers;
use App\Modules\Ecommerce\Jobs\Shopify\Traits\HandlesMaskedEmailAddress;
use App\Modules\Ecommerce\Jobs\Shopify\Traits\StagesUploadToShopify;
use App\Modules\Ecommerce\Jobs\Shopify\Traits\SyncsShopifyCustomer;
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
use Railroad\Ecommerce\Entities\Customer;
use Railroad\Ecommerce\Repositories\AddressRepository;
use Railroad\Ecommerce\Repositories\CustomerRepository;
use Signifly\Shopify\Shopify;

/**
 * BulkCustomerCreateFromUsers is a job used to perform a Bulk Operation in shopify to create multiple customers, using
 * the collection of Customers, found using the email addresses provided as a constructor parameter.
 * This job will simulate its process, as best as possible, when the `$execute` parameter is set to false.
 * The general flow of the process is as follows:
 * 1. Create a new ShopifySync entry for this batch of customers
 * 2. Build up the json data for each customer, so that it can be created as a Customer in Shopify, using the
 *    [CustomerInput](https://shopify.dev/docs/api/admin-graphql/2023-07/input-objects/CustomerInput) format
 * 3. Compile those json data and save them all in a .jsonl-formatted file that we'll store
 * 4. Make a GraphQL mutation post to Shopify to get them to create a staged upload for us
 * 5. Make a GraphQL mutation post to Shopify to upload our .jsonl file into that staged upload area
 * 6. Make a GraphQL mutation post to Shopify to request a `bulkOperationRunMutation` to create the customers,
 *    using the .jsonl file that Shopify now has, and to provide our necessary data for each customer they create
 * 7. Dispatch a PollBulkOperationCustomer job, that will continually poll Shopify for our results
 *
 * Please refer to the PollBulkOperationCustomer class for notes on the process from there.
 * @see https://shopify.dev/docs/api/usage/bulk-operations/imports for full details from Shopify
 */
class BulkCustomerCreateFromCustomers implements ShouldQueue
{
    use Batchable;
    use Dispatchable;
    use FindsCustomers;
    use HandlesMaskedEmailAddress;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;
    use StagesUploadToShopify;
    use SyncsShopifyCustomer;

    public function middleware(): array
    {
        return [new SkipIfBatchCancelled()];
    }

    protected CustomerRepository $customerRepository;
    protected AddressRepository $addressRepository;
    protected Shopify $shopify;

    /**
     * @param Collection<string> $emails the email addresses to use to get our customers to create Shopify Customers for
     * @param bool $execute are we executing this process, or simulating?
     */
    public function __construct(protected Collection $emails, protected bool $execute)
    {
    }

    public function handle(CustomerRepository $customerRepository, AddressRepository $addressRepository, Shopify $shopify): void
    {
        // set DI instances that we'll need
        $this->customerRepository = $customerRepository;
        $this->addressRepository = $addressRepository;
        $this->shopify = $shopify;

        // start the sync log
        $shopifySync = $this->execute
            ? ShopifySync::create([
                "resource" => "customer",
                "started_at" => Carbon::now()
            ])
            : null;

        $customersData = [];
        // build up the payload for each customer's email address
        $this->emails->each(function (?string $email) use (&$customersData) {
            // safety check for empty email addresses (we have some)
            if (empty($email)) {
                $this->logError(sprintf("%s: Customer(s) with an empty email address were found and cannot be" .
                    " synced to Shopify.", $this->getClassName()));
                return;
            }

            // find any of our Customers with the same email address
            $customers = $this->getCustomersForEmail($email);
            if ($customers->isEmpty()) {
                $this->logError(sprintf("%s: No customers found with email address %s ... even though it's the".
                    " email address of a customer...?", $this->getClassName(), $email));
                return;
            }
            $customersData[] = json_encode($this->createCustomerData($customers));
        });

        try {
            $this->syncData($customersData, $shopifySync, Customer::class);
        } catch (Exception $e) {
            $this->logError($e->getMessage());
            return;
        }
    }

    /**
     * Create the data to post to Shopify to create a Customer from our collection of Customers
     *
     * @param Collection<Customer> $customers
     */
    protected function createCustomerData(Collection $customers): array
    {
        // sort the customers collection so that we have the newest one first (so we can work our way back when trying to find data)
        $customers = $customers->sort(function (Customer $customer1, Customer $customer2) {
            return $customer1->getUpdatedAt() < $customer2->getUpdatedAt();
        });

        $customerData = [
            "email" => $this->getEmailForShopify($customers->first()->getEmail()),
            "note" => $this->getCustomerValueFor($customers, "getNote"),
            "phone" => $this->getPhoneNumberForCustomer($customers),
            // "tags" => "",
        ];
        // DEV NOTE: we don't bother making a metafield entry for the ID, because we use multiple customers, so it's
        // not a clean 1-1 mapping

        $customerData["addresses"] = $this->createAddressesData($customers);

        return ["input" => $customerData];
    }


    /**
     * Get all addresses for the customers, then format it to meet Shopify's expectation
     *
     * @param Collection<Customer> $customers
     */
    protected function createAddressesData(Collection $customers): Collection
    {
        $addresses = collect();
        $customers->each(fn (Customer $customer) => $addresses->push(
            ...$this->addressRepository->getCustomerShippingAddresses($customer->getId())
        ));

        $addresses = $this->cleanUpAddresses($addresses);

        $addressData = collect();
        $addresses->each(function ($addressArray) use ($addressData) {
            $addressData->push($addressArray);
        });

        return $addressData;
    }

    /**
     * @inheritDoc
     */
    protected function getAddressRepository(): AddressRepository
    {
        return $this->addressRepository;
    }

    /**
     * @inheritDoc
     */
    protected function getShopify(): Shopify
    {
        return $this->shopify;
    }

    /**
     * @inheritDoc
     */
    protected function getClassName(): string
    {
        return "SyncBulkCustomersToShopify";
    }

    /**
     * @inheritDoc
     */
    protected function getCustomerRepository(): CustomerRepository
    {
        return $this->customerRepository;
    }
}
