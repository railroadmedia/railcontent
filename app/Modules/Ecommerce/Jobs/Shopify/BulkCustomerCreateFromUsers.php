<?php

namespace App\Modules\Ecommerce\Jobs\Shopify;

use App\Models\ShopifySync;
use App\Modules\Ecommerce\Enums\ShopifyMetafieldKey;
use App\Modules\Ecommerce\Enums\ShopifyMetafieldNamespace;
use App\Modules\Ecommerce\Enums\ShopifyMetafieldTypes;
use App\Modules\Ecommerce\Jobs\Shopify\Traits\FindsCustomers;
use App\Modules\Ecommerce\Jobs\Shopify\Traits\HandlesMaskedEmailAddress;
use App\Modules\Ecommerce\Jobs\Shopify\Traits\StagesUploadToShopify;
use App\Modules\Ecommerce\Jobs\Shopify\Traits\SyncsShopifyCustomer;
use Carbon\Carbon;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;
use Modules\UserManagementSystem\Models\User;
use Railroad\Ecommerce\Entities\Customer;
use Railroad\Ecommerce\Repositories\AddressRepository;
use Railroad\Ecommerce\Repositories\CustomerRepository;
use Signifly\Shopify\Shopify;
/**
 * BulkCustomerCreateFromUsers is a job used to perform a Bulk Operation in shopify to create multiple customers, using
 * the collection of Users found using the provided constructor parameters.
 * In order to maintain short-running jobs, we retrieve a batch of users to sync, using the provided id of the user to
 * start with, and the batch size that will be used to limit the size of the query.
 * This job will simulate its process, as best as possible, when the `$execute` parameter is set to false.
 * The general flow of the process is as follows:
 * 1. Use the provided user ID and batch size to find the batch of users to use this time
 * 2. Create a new ShopifySync entry for this batch of users
 * 3. Build up the json data for each user, so that it can be created as a Customer in Shopify, using the
 *    [CustomerInput](https://shopify.dev/docs/api/admin-graphql/2023-07/input-objects/CustomerInput) format
 * 4. Compile those json data and save them all in a .jsonl-formatted file that we'll store
 * 5. Make a GraphQL mutation post to Shopify to get them to create a staged upload for us
 * 6. Make a GraphQL mutation post to Shopify to upload our .jsonl file into that staged upload area
 * 7. Make a GraphQL mutation post to Shopify to request a `bulkOperationRunMutation` to create the customers,
 *    using the .jsonl file that Shopify now has, and to provide our necessary data for each customer they create
 * 8. Dispatch a PollBulkOperationCustomer job, that will continually poll Shopify for our results
 *
 * Please refer to the PollBulkOperationCustomer class for notes on the process from there.
 * @see https://shopify.dev/docs/api/usage/bulk-operations/imports for full details from Shopify
 */
class BulkCustomerCreateFromUsers implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, SyncsShopifyCustomer, StagesUploadToShopify, FindsCustomers, HandlesMaskedEmailAddress;

    protected CustomerRepository $customerRepository;
    protected AddressRepository $addressRepository;
    protected Shopify $shopify;

    /**
     * @param int $firstUserId the id of the first user to find in this batch
     * @param int $batchSize the number of users to get in this batch and create Shopify Customers for
     * @param bool $useMaskedEmail are we using masked email addresses?
     * @param bool $execute are we executing this process, or simulating?
     */
    public function __construct(protected int $firstUserId, protected int $batchSize, protected bool $useMaskedEmail, protected bool $execute)
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

        // get the users for this batch
        $users = User::query()
            ->whereNull("shopify_id")
            ->where("id", ">=", $this->firstUserId)
            ->orderBy("id")
            ->limit($this->batchSize)
            ->get();

        $usersData = [];
        // build up the payload for each user
        $users->each(function (User $user) use (&$usersData) {
            // find any of our Customers with the same email address
            $userCustomers = $this->getCustomersForUser($user);
            if ($this->checkUserIsNew($user, $userCustomers)) {
                $usersData[] = json_encode($this->createCustomerData($user, $userCustomers));
            }
        });

        // safety check for edge case that all users in this batch were already synced as customers
        if (empty($usersData)) {
            $this->logInfo(sprintf("%s: All users in this batch were already synced. Skipping this batch.",
                $this->getClassName()));
            return;
        }

        try {
            $this->syncData($usersData, $shopifySync, User::class);
        } catch (Exception $e) {
            $this->logError($e->getMessage());
            return;
        }
    }

    /**
     * Check for any Customers with the User's email address, that have already been synced to Shopify.
     * Log an error if the User has synced Customer(s).
     *
     * @param User $user
     * @param Collection<Customer> $userCustomers
     * @return bool true if the User or any related Customers does not have any record in Shopify
     */
    protected function checkUserIsNew(User $user, Collection $userCustomers): bool
    {
        // check for any of the user's customer entities that may have already been synced
        $alreadySyncedUserCustomers = $userCustomers->filter(fn (Customer $customer) => !is_null($customer->getShopifyId()));
        if ($alreadySyncedUserCustomers->isNotEmpty()){
            /** @var Customer $syncedCustomer */
            $syncedCustomer = $alreadySyncedUserCustomers->first();
            $shopifyId = $syncedCustomer->getShopifyId();
            if ($this->execute) {
                $user->shopify_id = $shopifyId;
                $user->saveWithoutUpdatedAt();
            }
            $this->logError(sprintf("%s: Customer(s) with email address %s were already synced" .
                " to Shopify. User ID %s has been given the shopify_id %s and was skipped", $this->getClassName(), $user->email, $user->id, $shopifyId));
        }

        return $alreadySyncedUserCustomers->isEmpty();
    }

    /**
     * Create the data to post to Shopify to create a Customer from our User
     *
     * DEV NOTE: we don't bother looking at the user's customers because our system doesn't allow for
     * new Customers to be made after a User already exists with the same email address.
     *
     * @param User $user
     * @param Collection<Customer> $userCustomers
     * @return array
     */
    protected function createCustomerData(User $user, Collection $userCustomers): array
    {
        $customerData = [
            "email" => $this->getEmailForShopify($user->email),
            "firstName" => $user->first_name,
            "lastName" => $user->last_name,
            "note" => $user->support_note,
            "phone" => $this->getPhoneNumberForUser($user),
            // "tags" => "",
        ];

        // refer to https://shopify.dev/docs/apps/custom-data/metafields/types
        // we can use meta fields for stuff like our user id, etc
        $customerData["metafields"] = [
            [
                "key" => ShopifyMetafieldKey::Id,
                "value" => (string)$user->id,
                "type" => ShopifyMetafieldTypes::integer,
                "namespace" => ShopifyMetafieldNamespace::Model_Users
            ]
        ];

        $customerData["addresses"] = $this->createAddressesData($user, $userCustomers);

        return ["input" => $customerData];
    }

    /**
     * Get all addresses for this user and its customers, then format it to meet Shopify's expectation
     *
     * @param User $user
     * @param Collection<Customer> $customers
     * @return Collection
     */
    protected function createAddressesData(User $user, Collection $customers): Collection
    {
        $addressData = collect();
        // get all the addresses for the user
        $addresses = collect($this->addressRepository->getUserShippingAddresses($user->id));

        // and its customers
        $customers->each(fn(Customer $customer) => $addresses->push(
            ...$this->addressRepository->getCustomerShippingAddresses($customer->getId())
        ));

        $addresses = $this->cleanUpAddresses($addresses);

        $addresses->each(function($addressArray) use ($addressData) {
            $addressData->push ($addressArray);
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
        return "SyncBulkUsersToShopify";
    }

    /**
     * @inheritDoc
     */
    protected function getCustomerRepository(): CustomerRepository
    {
        return $this->customerRepository;
    }

    /**
     * @inheritDoc
     */
    protected function getIsUsingMask(): bool
    {
        return $this->useMaskedEmail;
    }
}
