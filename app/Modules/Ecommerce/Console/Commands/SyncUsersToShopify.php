<?php

namespace App\Modules\Ecommerce\Console\Commands;

use App\Modules\Ecommerce\Enums\ShopifyMetafieldKey;
use App\Modules\Ecommerce\Enums\ShopifyMetafieldNamespace;
use App\Modules\Ecommerce\Enums\ShopifyMetafieldTypes;
use App\Modules\Ecommerce\Jobs\Shopify\Traits\SyncsShopifyCustomer;
use Doctrine\ORM\Exception\ORMException;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Modules\UserManagementSystem\Models\User;
use Railroad\Ecommerce\Entities\Customer;
use Railroad\Ecommerce\Managers\EcommerceEntityManager;
use Railroad\Ecommerce\Repositories\AddressRepository;
use Railroad\Ecommerce\Repositories\CustomerRepository;
use Signifly\Shopify\Exceptions\ValidationException;
use Signifly\Shopify\REST\Resources\ApiResource;
use Signifly\Shopify\REST\Resources\CustomerResource;
use Signifly\Shopify\Shopify;

class SyncUsersToShopify extends SyncCustomersToShopifyBaseCommand
{
    use SyncsShopifyCustomer;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'shopify:sync-users
                            {--limit= : (Optional) The number of users to limit this run to.}
                            {--since= : (Optional) The ISO 8601 date time to sync all changes since. e.g. 2023-10-13T17:03:25+00:00}
                            {--fresh : Sync all users, not just those that need it}
                            {--execute : Execute this sync to Shopify. Without this flag, it will be simulated. }';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync our users and any related customers up to Shopify';

    /**
     * Execute the console command.
     *
     * @param  Shopify  $shopify
     * @param  CustomerRepository  $customerRepository
     * @param  AddressRepository  $addressRepository
     * @param  EcommerceEntityManager  $entityManager
     * @return int
     */
    public function handle(
        Shopify $shopify,
        CustomerRepository $customerRepository,
        AddressRepository $addressRepository,
        EcommerceEntityManager $entityManager
    ): int {
        $this->shopify = $shopify;
        $this->customerRepository = $customerRepository;
        $this->addressRepository = $addressRepository;
        $this->entityManager = $entityManager;

        $this->notifyStartupStatus();

        // record this as a class variable so that it doesn't get updated with each loop of the users
        $this->lastSyncAt = $this->getDateTimeOfLastSync();

        // DEV NOTE: we do not use the SyncsToShopify sync() here. The huge number of Users in our
        // database leads to a unique situation for syncing up to Shopify Customers.
        $batchSize = 50;
        $this->withExecutionTime(function () use ($batchSize) {
            $this->loopUsersSync($batchSize);
        });

        return self::SUCCESS;
    }

    /**
     * Get all the users that need to be synced, and perform the sync action on each one
     *
     * @param  int  $batchSize
     * @return void
     */
    private function loopUsersSync(int $batchSize): void
    {
        $limit = $this->getLimit();
        $this->tableHeader = ["User or Customer ID", "Class", "Action", "Shopify Customer ID"];
        $this->tableRows = [];

        if (!$this->getIsFresh()) {
            $this->info(
                sprintf(
                    "Retrieving all users that have not been synced, or have been updated since %s ...",
                    $this->lastSyncAt->toString()
                )
            );
        }
        $usersQuery = User::query()
            ->when(!$this->getIsFresh(), function ($q) {
                return $q
                    ->whereNull("shopify_id")
                    ->orWhere("updated_at", ">", $this->lastSyncAt);
            })
            ->when($limit, function (Builder $q) use ($limit) {
                return $q->limit($limit);
            });
        $totalCount = $usersQuery->count();
        $infoString = "Found {$totalCount} users to be synced.";
        if ($limit) {
            $infoString .= " Limiting to {$limit}.";
        }
        $infoString .= " Performing in batches of {$batchSize}.";
        $this->info($infoString);

        $totalCountForRun = is_null($limit) ? $totalCount : min($totalCount, $limit);
        $totalBatchesToRun = intval(ceil($totalCountForRun / $batchSize));
        $userCount = 0;
        $usersQuery->chunk(
            $batchSize,
            function (Collection $users, int $batchRun) use (
                $batchSize,
                $totalBatchesToRun,
                $totalCountForRun,
                &$userCount
            ) {
                $this->info(sprintf("Running Users batch %s of %s", $batchRun, $totalBatchesToRun));
                $this->shopifyIds = collect();
                $this->createSyncLogIfExecuting();

                // chunk doesn't keep the limit set before, so we'll work around that by keeping track of the count internally
                $isAtLimit = false;

                // start a progress bar for this chunk
                $bar = $this->output->createProgressBar($totalCountForRun % $batchSize);
                $bar->start();

                $users->each(function (User $user, int $index) use ($bar, $totalCountForRun, &$userCount, &$isAtLimit) {
                    ++$userCount;
                    $this->syncUser($user, $this->getIsFresh(), $this->getIsSimulation(), $index + 1);
                    $bar->advance();

                    // if this is the last user to get before exceeding our limit, denote it and break out of the loop
                    if ($userCount >= $totalCountForRun) {
                        $isAtLimit = true;
                        return false;
                    }
                });

                // print progress bar and table
                $bar->finish();
                $this->newLine();
                $this->table($this->tableHeader, $this->tableRows);
                // finish the sync log
                $this->finishSyncLogIfExecuting($this->shopifyIds);
                // and clear the table rows for the next run
                $this->tableRows = [];

                // if our last loop hit the limit, break out of the loop of all users
                if ($isAtLimit) {
                    return false;
                }
            }
        );
    }

    /**
     * Sync the user up to Shopify
     *
     * @param  User  $user
     * @param  bool  $fresh
     * @param  bool  $simulate
     * @param  int|null  $simulatedShopifyId
     * @return void
     */
    private function syncUser(User $user, bool $fresh, bool $simulate, ?int $simulatedShopifyId): void
    {
        // STEP 1: find any of our Customers with the same email address, so we can use the combined data
        $userCustomers = $this->getCustomersForUser($user);

        // STEP 2: determine if updating or creating
        // ensuring to check for any of the user's customer entities that may have already been synced
        $alreadySyncedUserCustomers = $userCustomers->filter(
            fn(Customer $customer) => !is_null($customer->getShopifyId())
        );
        $isCreating = $fresh || (is_null($user->shopify_id) && $alreadySyncedUserCustomers->isEmpty());

        // STEP 3: build up the data structure
        $postData = $this->createCustomerDataForUser($user, $isCreating);

        // STEP 4: send the data to Shopify
        if (!$simulate) {
            $attemptNumber = 1;
            $customerResource = $this->sendDataToShopify(
                $user,
                $postData,
                $isCreating,
                $alreadySyncedUserCustomers,
                $attemptNumber
            );
            if (is_null($customerResource)) {
                // we failed to send the data. the error was recorded within the sendDataToShopify function
                return;
            }

            $shopifyCustomerId = $customerResource->id;
            $this->shopifyIds->push($shopifyCustomerId);

            // record the shopify ID on the User ...
            if ($user->shopify_id !== $shopifyCustomerId) {
                $user->shopify_id = $shopifyCustomerId;
                $user->saveWithoutUpdatedAt();
            }
            try {
                // ... and any of their related Customers
                $userCustomers->each(function (Customer $customer) use ($shopifyCustomerId) {
                    if ($customer->getShopifyId() !== $shopifyCustomerId) {
                        // grab the eloquent model, so we can update it
                        $customerModel = \App\Modules\Ecommerce\Models\Customer::find($customer->getId());
                        $customerModel->shopify_id = $shopifyCustomerId;
                        $customerModel->saveWithoutUpdatedAt();
                        // refresh the doctrine model to get the change
                        $this->entityManager->refresh($customer);
                    }
                });

                // STEP 5: build up the data structure for the User's (and its Customers') Addresses
                $addressesData = $isCreating ? $this->createAddressesDataForUser($user, $userCustomers)
                    : $this->updateAddressesDataForUser($user, $userCustomers);

                // STEP 6: send it to Shopify, if there are any
                $this->sendAddressDataToShopify($addressesData, $shopifyCustomerId);
            } catch (ORMException $e) {
                $this->error(
                    sprintf(
                        "Failed to save shopify_id for user or customer with email address %s: %s",
                        $user->email,
                        $e->getMessage()
                    )
                );
            }
        } else {
            // simulating
            $shopifyCustomerId = $user->shopify_id ?? $simulatedShopifyId;
        }

        $this->tableRows[] = [$user->id, "User", $isCreating ? "Created" : "Updated", $shopifyCustomerId];
        $userCustomers->each(function (Customer $customer) use ($isCreating, $shopifyCustomerId) {
            $this->tableRows[] = [
                $customer->getId(),
                "Customer",
                $isCreating ? "Created" : "Updated",
                $shopifyCustomerId
            ];
        });
    }

    /**
     * Create the data to post to Shopify to create a Customer from our User
     *
     * DEV NOTE: we don't bother looking at the user's customers because our system doesn't allow for
     * new Customers to be made after a User already exists with the same email address.
     *
     * @param  User  $user
     * @param  bool  $withMetafields
     * @return array
     */
    private function createCustomerDataForUser(User $user, bool $withMetafields): array
    {
        $customerData = [
            "currency" => "USD",
            "email" => $this->getEmailForShopify($user->email),
            "first_name" => $user->first_name,
            "last_name" => $user->last_name,
            "note" => $user->support_note,
            "phone" => $this->getPhoneNumberForUser($user),
            // "tags" => "",
        ];

        if ($withMetafields) {
            // refer to https://shopify.dev/docs/apps/custom-data/metafields/types
            // we can use meta fields for stuff like our user id, etc
            $customerData["metafields"] = [
                [
                    "key" => ShopifyMetafieldKey::Id->value,
                    "value" => (string)$user->id,
                    "type" => ShopifyMetafieldTypes::integer->value,
                    "namespace" => ShopifyMetafieldNamespace::Model_Users->value
                ]
            ];
        }

        return $customerData;
    }

    /**
     * Send the data to Shopify to create or update a customer. Allowing up to 2 attempts, so that we can retry
     * after certain validation failures.
     *
     * @param  User  $user
     * @param  array  $postData
     * @param  bool  $isCreating
     * @param  Collection  $alreadySyncedUserCustomers
     * @param  int  $attemptNumber
     * @return CustomerResource|null
     */
    private function sendDataToShopify(
        User $user,
        array $postData,
        bool $isCreating,
        Collection $alreadySyncedUserCustomers,
        int $attemptNumber
    ): ?CustomerResource {
        if ($attemptNumber > 2) {
            return null;
        }

        try {
            if ($isCreating) {
                $customerResource = $this->shopify->createCustomer($postData);
            } else {
                $existingCustomerShopifyId = $user->shopify_id ?? $alreadySyncedUserCustomers->first()->getShopifyId();
                $customerResource = $this->shopify->updateCustomer($existingCustomerShopifyId, $postData);
            }
        } catch (ValidationException $exception) {
            // we can have edge cases where the customer was created in Shopify, but we didn't record their shopify_id,
            // so check for that error and record Shopify's id on our records
            $errors = collect($exception->errors);
            if (collect($errors->get("email"))->contains("has already been taken")) {
                $this->linkExistingCustomer($user->email);
                $this->tableRows[] = [
                    $user->id,
                    "User",
                    "<error>EMAIL EXISTING</error>",
                    "Email account already taken. Shopify ID recorded locally."
                ];
                return null;
            }

            // a common validation error is that the phone number is invalid. We try our best to set it to
            // something valid, but there's no guarantee it's right. So if that validation failed, try again
            // without a phone number
            if (collect($errors->get("phone"))->contains("Enter a valid phone number")) {
                // remove the phone number from the post data and try again
                $postData["phone"] = null;
                return $this->sendDataToShopify(
                    $user,
                    $postData,
                    $isCreating,
                    $alreadySyncedUserCustomers,
                    ++$attemptNumber
                );
            }

            // a known validation error is that the phone number is already in use. This is a bit of an odd unique
            // constraint by Shopify, but it is what it is. So if that validation failed, try again
            // without a phone number
            if (collect($errors->get("phone"))->contains("Phone has already been taken")) {
                // remove the phone number from the post data and try again
                $postData["phone"] = null;
                return $this->sendDataToShopify(
                    $user,
                    $postData,
                    $isCreating,
                    $alreadySyncedUserCustomers,
                    ++$attemptNumber
                );
            }

            // a different validation error occurred that we can't handle, so report it here
            $this->error(
                sprintf(
                    "Validation failed when sending customer data to Shopify: %s",
                    $exception->getMessage()
                )
            );
            $this->error(
                sprintf(
                    "Please investigate for user or customers with email address %s. Attempted customer data: %s",
                    $user->email,
                    json_encode($postData)
                )
            );
            // record the failure in the table then exit out for this user
            $this->tableRows[] = [$user->id, "User", "<error>FAILED</error>", $exception->getMessage()];
            return null;
        }
        return $customerResource;
    }

    /**
     * Get all addresses for this user and its customers, then format it to meet Shopify's expectation
     *
     * @param  User  $user
     * @param  Collection<Customer>  $customers
     * @return Collection
     */
    private function createAddressesDataForUser(User $user, Collection $customers): Collection
    {
        $addressData = collect();
        // get all the addresses for the user
        $addresses = collect($this->addressRepository->getUserShippingAddresses($user->id));

        // and its customers
        $customers->each(fn(Customer $customer) => $addresses->push(
            ...$this->addressRepository->getCustomerShippingAddresses($customer->getId())
        ));

        $addresses = $this->cleanUpAddressesForRest($addresses);

        $addresses->each(function ($addressArray) use ($addressData) {
            $addressData->push($addressArray);
        });

        return $addressData;
    }

    /**
     * Find and compare all local versions of addresses for the user provided, against the addresses
     * for the customer in Shopify. If we have any changes, or any new addresses, format those to
     * meet Shopify's expectations.
     *
     * @param  User  $user
     * @param  Collection<Customer>  $userCustomers
     * @return Collection
     */
    private function updateAddressesDataForUser(User $user, Collection $userCustomers): Collection
    {
        $addressData = collect();

        $shopifyCustomerId = $user->shopify_id;
        // first, get the address information from Shopify
        $shopifyAddressesResponse = $this->shopify->getCustomerAddresses($shopifyCustomerId);
        $shopifyAddresses = $shopifyAddressesResponse->map(fn(ApiResource $apiResource) => $apiResource->getAttributes()
        );

        // keep track of the local addresses that we've checked, so we know not to check if they're new
        $checkedLocalAddressIds = collect();

        // get data for all the addresses that need to be updated
        $this->addDataForUpdatedAddresses($shopifyCustomerId, $shopifyAddresses, $checkedLocalAddressIds, $addressData);

        // next, check for any additional addresses that the user has, that haven't yet been synced up to Shopify
        $allLocalAddressData = $this->createAddressesDataForUser($user, $userCustomers);
        $this->addDataForNewAddresses($allLocalAddressData, $shopifyAddresses, $checkedLocalAddressIds, $addressData);

        return $addressData;
    }

    /**
     * @inheritDoc
     */
    protected function getClassName(): string
    {
        return "SyncUsersToShopify";
    }
}
