<?php

namespace App\Modules\Ecommerce\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Models\ShopifySync;
use App\Modules\Ecommerce\Console\Commands\Traits\SyncsToShopify;
use App\Modules\Ecommerce\Jobs\Shopify\Traits\FindsCustomers;
use App\Modules\Ecommerce\Jobs\Shopify\Traits\HandlesMaskedEmailAddress;
use App\Modules\Ecommerce\Jobs\Shopify\Traits\HandlesShopifyRateLimit;
use App\Modules\Ecommerce\Jobs\Shopify\Traits\SavesShopifyIdOnAddresses;
use App\Modules\Ecommerce\Jobs\Shopify\Traits\SyncsAddressData;
use App\Modules\Ecommerce\Jobs\Shopify\Traits\SyncsShopifyCustomer;
use Carbon\Carbon;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\QueryBuilder;
use Illuminate\Support\Collection;
use Railroad\Ecommerce\Entities\Customer;
use Railroad\Ecommerce\Managers\EcommerceEntityManager;
use Railroad\Ecommerce\Repositories\AddressRepository;
use Railroad\Ecommerce\Repositories\CustomerRepository;
use Railroad\Ecommerce\Repositories\RepositoryBase;
use Signifly\Shopify\Exceptions\ValidationException;
use Signifly\Shopify\REST\Resources\ApiResource;
use Signifly\Shopify\REST\Resources\CustomerResource;
use Signifly\Shopify\Shopify;

class SyncCustomersToShopify extends Command
{
    use FindsCustomers;
    use HandlesMaskedEmailAddress;
    use HandlesShopifyRateLimit;
    use SavesShopifyIdOnAddresses;
    use SyncsAddressData;
    use SyncsShopifyCustomer;
    use SyncsToShopify;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'shopify:sync-customers
                            {--limit= : (Optional) The number of customers to limit this run to.}
                            {--since= : (Optional) The ISO 8601 date time to sync all changes since. e.g. 2023-10-13T17:03:25+00:00}
                            {--email= : (Optional) email address to limit this sync to.}
                            {--fresh : Sync all customers, not just those that need it}
                            {--execute : Execute this sync to Shopify. Without this flag, it will be simulated.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync our customers up to Shopify. To be run AFTER sync-users.';

    protected AddressRepository $addressRepository;
    protected CustomerRepository $customerRepository;
    protected EcommerceEntityManager $entityManager;
    protected Shopify $shopify;

    // the date and time that the last sync for this entity was performed
    protected Carbon $lastSyncAt;

    // running collection of the Shopify IDs returned in this run, so we can record it
    protected Collection $shopifyIds;

    // header for the results table display
    protected array $tableHeader = [];

    // rows for displaying the results in a table
    protected array $tableRows = [];

    /**
     * Execute the console command.
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

        // record this as a class variable so that it doesn't get updated with each loop of the customers
        $this->lastSyncAt = $this->getDateTimeOfLastSync();

        // DEV NOTE: we need to sync the customers by getting all of them from the db into one collection,
        // so we can group them by the email address and make a singular entity for each customer in the group.
        // Make sure to get the whole collection before doing any of the users, so that the sync logs created by the
        // users don't affect the query
        $customers = $this->getEcommerceEntities($this->getIsFresh());

        // DEV NOTE: we do not use the SyncsToShopify sync() here. We need to run through all applicable Customers,
        // rather than just one entity. That, combined with the huge number of Customers in our
        // database, leads to a unique situation for syncing up to Shopify Customers.
        $batchSize = 50;
        $this->withExecutionTime(function () use ($customers, $batchSize) {
            $this->syncCustomers($customers, $batchSize);
        });

        return self::SUCCESS;
    }

    /**
     * @inheritDoc
     */
    protected function getIsFresh(): bool
    {
        return $this->option("fresh");
    }

    /**
     * Sync the customers up to Shopify
     */
    private function syncCustomers(Collection $customers, int $batchSize): void
    {
        $this->tableHeader = ["Customer ID", "Action", "Shopify Customer ID"];
        $this->tableRows = [];

        $totalCount = $customers->count();
        $limit = $this->getLimitOption();

        // STEP 1: group the customers together by email address, so we don't make duplicates in Shopify
        $customers = $customers->groupBy(fn (Customer $customer) => $customer->getEmail());

        // apply the limit outside the query so that we don't miss out on grouping by email
        $customers = $customers->take($limit);

        // chunk the customers, so we can make tables and sync logs for each chunk, like we did for the batched users
        $chunkedCustomers = $customers->chunk($batchSize);

        $totalCountForRun = is_null($limit) ? $totalCount : min($totalCount, $limit);
        $totalBatchesToRun = intval(ceil($totalCountForRun / $batchSize));
        $bar = $this->output->createProgressBar($batchSize);

        $chunkedCustomers->each(
            function (Collection $groupedCustomers, int $chunkIndex) use (
                $bar,
                $batchSize,
                $totalBatchesToRun,
                $totalCountForRun
            ) {
                $this->newLine();
                $this->info(sprintf("Running Customers batch %s of %s", $chunkIndex + 1, $totalBatchesToRun));
                $this->shopifyIds = collect();
                $this->createSyncLogIfExecuting();
                // if this is the last chunk, set the progress bar's size
                if ($chunkIndex + 1 === $totalBatchesToRun) {
                    $bar = $this->output->createProgressBar($groupedCustomers->count() % $batchSize);
                }
                $bar->start();

                $simulatedShopifyId = $batchSize * $chunkIndex;
                $groupedCustomers->each(
                    function (Collection $customersCollection, string $email) use (
                        &$simulatedShopifyId,
                        $batchSize,
                        $chunkIndex,
                        $bar
                    ) {
                        // STEP 2: determine if updating or creating
                        $alreadySynced = $customersCollection->filter(
                            fn (Customer $customer) => !is_null($customer->getShopifyId())
                        );

                        // sort the customers collection so that we have the newest one first (so we can work our way back when trying to find data)
                        $customersCollection = $customersCollection->sort(
                            function (Customer $customer1, Customer $customer2) {
                                return $customer1->getUpdatedAt() < $customer2->getUpdatedAt();
                            }
                        );

                        $isCreating = $this->getIsFresh() || $alreadySynced->isEmpty();

                        // STEP 3: build up the data structure
                        // DEV NOTE: we need the same data regardless of creating or updating
                        $postData = $this->createCustomerDataForCustomers($customersCollection, $email);

                        // STEP 4: send the data to Shopify
                        if (!$this->getIsSimulation()) {
                            $attemptNumber = 1;
                            $customerResource = $this->sendDataToShopify(
                                $email,
                                $postData,
                                $isCreating,
                                $customersCollection,
                                $attemptNumber
                            );
                            if (is_null($customerResource)) {
                                // we failed to send the data. the error was recorded within the sendDataToShopify function
                                return;
                            }

                            $shopifyCustomerId = $customerResource->id;
                            $this->shopifyIds->push($shopifyCustomerId);

                            try {
                                // record the shopify ID each Customer
                                $customersCollection->each(function (Customer $customer) use ($shopifyCustomerId) {
                                    // grab the eloquent model, so we can update it
                                    $customerModel = \App\Modules\Ecommerce\Models\Customer::find($customer->getId());
                                    $customerModel->shopify_id = $shopifyCustomerId;
                                    $customerModel->saveWithoutUpdatedAt();
                                    // refresh the doctrine model to get the change
                                    $this->entityManager->refresh($customer);
                                });

                                // STEP 5: build up the data structure for the Customers' Addresses
                                $addressesData = $isCreating ? $this->createAddressesDataForCustomers(
                                    $customersCollection
                                )
                                    : $this->updateAddressesDataForCustomers($customersCollection, $shopifyCustomerId);

                                // STEP 6: send it to Shopify, if there are any
                                $errors = $this->sendAddressDataToShopify(
                                    $addressesData,
                                    $shopifyCustomerId,
                                    $this->shopifyIds
                                );
                                $this->handleRateLimit();
                                $errors->each(fn ($errorMessage) => $this->error($errorMessage));
                            } catch (ORMException $e) {
                                $this->error(
                                    sprintf(
                                        "Failed to save shopify_id for customer with email address %s: %s",
                                        $email,
                                        $e->getMessage()
                                    )
                                );
                            }
                        } else {
                            $shopifyCustomerId = ++$simulatedShopifyId;
                        }

                        $customersCollection->each(
                            function (Customer $customer) use ($isCreating, $shopifyCustomerId, $bar) {
                                $this->tableRows[] = [
                                    $customer->getId(),
                                    $isCreating ? "Created" : "Updated",
                                    $shopifyCustomerId
                                ];
                                $bar->advance();
                            }
                        );
                    }
                );

                // batch has ended
                // print progress bar and table
                $bar->finish();
                $this->newLine();
                $this->table($this->tableHeader, $this->tableRows);
                // finish the sync log
                $this->finishSyncLogIfExecuting($this->shopifyIds);
                // and clear the table rows for the next run
                $this->tableRows = [];
            }
        );
    }

    /**
     * Get the optional limit provided for the number of customers to sync
     */
    protected function getLimitOption(): ?int
    {
        return $this->option("limit");
    }

    /**
     * Create the data to post to Shopify to create a Customer from our collection of grouped Customers
     *
     * @param  Collection<Customer>  $customers
     */
    private function createCustomerDataForCustomers(Collection $customers, string $email): array
    {
        return [
            "currency" => "USD",
            "email" => $this->getEmailForShopify($email),
            "note" => $this->getCustomerValueFor($customers, "getNote"),
            "phone" => $this->getPhoneNumberForCustomer($customers),
            // "tags" => "",
            // DEV NOTE: we won't bother recording the id in a metafield because the data is an amalgamation of
            // any number of customers in our system
        ];
    }

    /**
     * Go through all customers in the collection, and try to get the value for the given attribute function,
     * returning the first non-null value retrieved.
     *
     * @param  Collection<Customer>  $customers
     */
    private function getCustomerValueFor(Collection $customers, string $attributeFunction): ?string
    {
        $value = null;
        $customers->each(function (Customer $customer) use ($attributeFunction, &$value) {
            if ($value = $customer->$attributeFunction()) {
                // break out because we found the value
                return false;
            }
        });
        return $value;
    }

    /**
     * @inheritDoc
     */
    protected function getIsSimulation(): bool
    {
        return $this->option("execute") == false;
    }

    /**
     * Send the data to Shopify to create or update a customer. Allowing up to 2 attempts, so that we can retry
     * after certain validation failures.
     */
    private function sendDataToShopify(
        string $customerEmail,
        array $postData,
        bool $isCreating,
        Collection $customersCollection,
        int $attemptNumber
    ): ?CustomerResource {
        if ($attemptNumber > 2) {
            return null;
        }

        try {
            if ($isCreating) {
                $customerResource = $this->shopify->createCustomer($postData);
            } else {
                $existingCustomerShopifyId = $this->getCustomerValueFor(
                    $customersCollection,
                    "getShopifyId"
                );
                $this->handleRateLimit();
                $customerResource = $this->shopify->updateCustomer(
                    $existingCustomerShopifyId,
                    $postData
                );
            }
            $this->handleRateLimit();
        } catch (ValidationException $exception) {
            // we can have edge cases where the customer was created in Shopify, but we didn't record their shopify_id,
            // so check for that error and record Shopify's id on our records
            $errors = collect($exception->errors);
            if (collect($errors->get("email"))->contains("has already been taken")) {
                $failures = $this->linkExistingCustomer($customerEmail);
                $this->handleRateLimit();
                if ($failures->isNotEmpty()) {
                    $failures->each(
                        fn ($failureMessage) => $this->tableRows[] = [
                            $customerEmail,
                            "",
                            "<error>FAILED</error>",
                            $failureMessage
                        ]
                    );
                } else {
                    $this->tableRows[] = [
                        $customerEmail,
                        "Customer",
                        "<error>EMAIL EXISTING</error>",
                        "Email account already taken. Shopify ID recorded locally."
                    ];
                }
                return null;
            }

            // a common validation error is that the phone number is invalid. We try our best to set it to
            // something valid, but there's no guarantee it's right. So if that validation failed, try again
            // without a phone number
            if (collect($errors->get("phone"))->contains("Enter a valid phone number")) {
                // remove the phone number from the post data and try again
                $postData["phone"] = null;
                return $this->sendDataToShopify(
                    $customerEmail,
                    $postData,
                    $isCreating,
                    $customersCollection,
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
                    $customerEmail,
                    $postData,
                    $isCreating,
                    $customersCollection,
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
                    "Please investigate for customer with email address %s. Attempted customer data: %s",
                    $customerEmail,
                    json_encode($postData)
                )
            );
            // record the failure in the table then exit out for this customer
            $this->tableRows[] = [$customerEmail, "<error>FAILED</error>", $exception->getMessage()];
            return null;
        }
        return $customerResource;
    }

    /**
     * Get all addresses for this collection of customers, then format it to meet Shopify's expectation
     *
     * @param  Collection<Customer>  $customers
     */
    private function createAddressesDataForCustomers(Collection $customers): Collection
    {
        $addressData = collect();
        // get all the addresses for all customers
        $addresses = collect();
        $customers->each(
            fn (Customer $customer) => $addresses->merge(
                $this->addressRepository->getCustomerShippingAddresses($customer->getId())
            )
        );

        $addresses = $this->cleanUpAddressesForRest($addresses);

        $addresses->each(function ($addressArray) use ($addressData) {
            $addressData->push($addressArray);
        });

        return $addressData;
    }

    /**
     * Find and compare all local versions of addresses for the collection of customers provided,
     * against the addresses for the customer in Shopify. If we have any changes, or any new addresses,
     * format those to meet Shopify's expectations.
     *
     * @param  Collection<Customer>  $customers
     */
    private function updateAddressesDataForCustomers(Collection $customers, int $shopifyCustomerId): Collection
    {
        $addressData = collect();

        // first, get the address information from Shopify
        $shopifyAddressesResponse = $this->shopify->getCustomerAddresses($shopifyCustomerId);
        $this->handleRateLimit();
        $shopifyAddresses = $shopifyAddressesResponse->map(
            fn (ApiResource $apiResource) => $apiResource->getAttributes()
        );
        // keep track of the local addresses that we've checked, so we know not to check if they're new
        $checkedLocalAddressIds = collect();

        // get data for all the addresses that need to be updated
        $updateFailures = $this->addDataForUpdatedAddresses(
            $shopifyCustomerId,
            $shopifyAddresses,
            $checkedLocalAddressIds,
            $addressData
        );
        $updateFailures->each(fn ($failureMessage) => $this->error($failureMessage));

        // next, check for any additional addresses that the user has, that haven't yet been synced up to Shopify
        $allLocalAddressData = $this->createAddressesDataForCustomers($customers);
        $this->addDataForNewAddresses($allLocalAddressData, $shopifyAddresses, $checkedLocalAddressIds, $addressData);

        return $addressData;
    }

    /**
     * Do not allow the Customers to be limited for the query. We require the full result set so that we can
     * group them by email address afterwards
     */
    protected function getLimit(): ?int
    {
        return null;
    }

    /**
     * @inheritDoc
     */
    protected function getClassName(): string
    {
        return "SyncCustomersToShopify";
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
    protected function getAddressRepository(): AddressRepository
    {
        return $this->addressRepository;
    }

    /**
     * @inheritDoc
     */
    protected function getEntityManager(): EcommerceEntityManager
    {
        return $this->entityManager;
    }

    /**
     * @inheritDoc
     */
    protected function getSyncResource(): string
    {
        return ShopifySync::RESOURCE_CUSTOMER;
    }

    /**
     * @inheritDoc
     */
    protected function syncResource(bool $simulate, bool $fresh): Collection
    {
        // we do not use the SyncsToShopify sync() here. We need to run through all applicable Customers,
        // rather than just one entity. That, combined with the huge number of Customers in our
        // database, leads to a unique situation for syncing up to Shopify Customers.
        // All of that is done in the handle function, and so this function is never used.

        return collect();
    }

    /**
     * @inheritDoc
     */
    protected function getEcommerceEntityRepository(): RepositoryBase|EntityRepository
    {
        return $this->customerRepository;
    }

    /**
     * @inheritDoc
     */
    protected function getLastSyncAtOverride(): null|Carbon
    {
        $override = $this->option("since");
        if (!is_null($override)) {
            return new Carbon($override);
        }
        return null;
    }

    /**
     * @inheritDoc
     */
    protected function addAdditionalScope(QueryBuilder &$queryBuilder): void
    {
        $email = $this->option("email");
        if ($email) {
            $queryBuilder->andWhere($queryBuilder->expr()->eq('entity.email', ':email'))
                ->setParameter("email", $email);
        }
    }
}
