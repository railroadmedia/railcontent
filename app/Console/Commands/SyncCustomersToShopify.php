<?php

namespace App\Console\Commands;

use App\Console\Commands\Traits\SyncsToShopify;
use Carbon\Carbon;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use libphonenumber\NumberParseException;
use libphonenumber\PhoneNumberFormat;
use libphonenumber\PhoneNumberUtil;
use Railroad\Ecommerce\Entities\Address;
use Railroad\Ecommerce\Entities\Customer;
use Railroad\Ecommerce\Entities\User;
use Railroad\Ecommerce\Managers\EcommerceEntityManager;
use Railroad\Ecommerce\Repositories\AddressRepository;
use Railroad\Ecommerce\Repositories\CustomerRepository;
use Railroad\Ecommerce\Repositories\RepositoryBase;
use Railroad\Ecommerce\Repositories\UserRepository;
use Signifly\Shopify\Exceptions\ValidationException;
use Signifly\Shopify\REST\Resources\ApiResource;
use Signifly\Shopify\REST\Resources\CustomerResource;
use Signifly\Shopify\Shopify;

class SyncCustomersToShopify extends Command
{
    use SyncsToShopify;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'shopify:sync-customers
                            {--limit= : (Optional) The number of users and customers to limit this run to. Applies to each.}
                            {--fresh : Sync all users and customers, not just those that need it}
                            {--execute : Execute this sync to Shopify. Without this flag, it will be simulated. }';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync our users and customers up to Shopify';

    protected Shopify $shopify;
    protected AddressRepository $addressRepository;
    protected CustomerRepository $customerRepository;
    protected UserRepository $userRepository;
    protected EcommerceEntityManager $entityManager;

    // the date and time that the last sync for this entity was performed
    protected Carbon $lastSyncAt;

    // customer IDs that have been synced with Shopify as part of the process to sync Users
    private Collection $customerIdsSyncedByUsers;

    // running collection of the Shopify IDs returned in this run, so we can record it
    protected Collection $shopifyIds;

    // header for the results table display
    protected array $tableHeader = [];
    // rows for displaying the results in a table
    protected array $tableRows = [];

    /**
     * Execute the console command.
     *
     * @param Shopify $shopify
     * @param CustomerRepository $customerRepository
     * @param UserRepository $userRepository
     * @param AddressRepository $addressRepository
     * @param EcommerceEntityManager $entityManager
     * @return int
     */
    public function handle(Shopify $shopify,
                           CustomerRepository $customerRepository,
                           UserRepository $userRepository,
                           AddressRepository $addressRepository,
                           EcommerceEntityManager $entityManager): int
    {
        $this->shopify = $shopify;
        $this->customerRepository = $customerRepository;
        $this->userRepository = $userRepository;
        $this->addressRepository = $addressRepository;
        $this->entityManager = $entityManager;
        $this->customerIdsSyncedByUsers = collect();

        // record this as a class variable so that it doesn't get updated with each loop of the users
        $this->lastSyncAt = $this->getDateTimeOfLastSync();

        // DEV NOTE: we need to sync the customers by getting all of them from the db into one collection,
        // so we can group them by the email address and make a singular entity for each customer in the group.
        // Make sure to get the whole collection before doing any of the users, so that the sync logs created by the
        // users don't affect the query
        $customers = $this->getEcommerceEntities($this->getIsFresh());

        // DEV NOTE: we do not use the SyncsToShopify sync() here. We need to run through all applicable Users and then
        // all applicable Customers, rather than just one entity. That, combined with the huge number of Users in our
        // database, leads to a unique situation for syncing up to Shopify Customers.
        $this->notifyStartupStatus();
        $batchSize = 50;
        $this->loopUsersSync($batchSize);
        $this->syncCustomers($customers, $batchSize);

        return self::SUCCESS;
    }

    /**
     * Get all the users that need to be synced, and perform the sync action on each one
     *
     * @param int $batchSize
     * @return void
     */
    private function loopUsersSync(int $batchSize): void
    {
        $simulate = $this->getIsSimulation();
        $fresh = $this->getIsFresh();
        $limit = $this->getLimitOption();
        $this->tableHeader = ["User or Customer ID", "Class", "Action", "Shopify Customer ID"];
        $this->tableRows = [];

        // get the users, using pagination to keep from blowing up the memory usage
        $qb = $this->userRepository->createQueryBuilder('entity');
        if (!$this->getIsFresh()) {;
            $this->info(
                sprintf("Retrieving all users that have not been synced, or have been updated since %s ...",
                    $this->lastSyncAt->toString())
            );
            $qb->where(
                $qb->expr()
                    ->isNull("entity.shopifyId")
            )
                ->orWhere(
                    $qb->expr()
                        ->gt("entity.updatedAt", ":lastSyncAt")
                )->setParameter("lastSyncAt", $this->lastSyncAt);
        }

        if ($limit) {
            $qb->setMaxResults($limit);
        }
        $q = $qb->getQuery();
        $paginator = new Paginator($q);

        $totalCount = count($paginator);

        $infoString = "Found {$totalCount} users to be synced.";
        if ($limit) {
            $infoString .= " Limiting to {$limit}.";
        }
        $infoString .= " Performing in batches of {$batchSize}.";
        $this->info($infoString);

        $batchRun = 0;
        $totalCountForRun = is_null($limit) ? $totalCount : min($totalCount, $limit);
        $totalBatchesToRun = intval(ceil($totalCountForRun / $batchSize));
        $bar = $this->output->createProgressBar($batchSize);

        foreach ($paginator as $index => $user) {

            // starting the batch
            if ($index % $batchSize === 0) {
                // start the sync log and prep the progress bar and table
                ++$batchRun;
                $this->newLine();
                $this->info(sprintf("Running Users batch %s of %s", $batchRun, $totalBatchesToRun));
                $this->shopifyIds = collect();
                $this->createSyncLogIfExecuting();
                // if this is the last run of the batches, set the progress bar's size
                if ($batchRun === $totalBatchesToRun)
                {
                    $bar = $this->output->createProgressBar($totalCountForRun % $batchSize);
                }
                $bar->start();
            }

            $this->syncUser($user, $fresh, $simulate, $index+1);
            $bar->advance();

            // batch has ended
            if (($index % $batchSize === $batchSize-1) || $index+1 === $totalCountForRun) {
                // print progress bar and table
                $bar->finish();
                $this->newLine();
                $this->table($this->tableHeader, $this->tableRows);
                // finish the sync log
                $this->finishSyncLogIfExecuting($this->shopifyIds);
                // and clear the table rows for the next run
                $this->tableRows = [];
            }
        }
    }

    /**
     * Sync the user up to Shopify
     *
     * @param User $user
     * @param bool $fresh
     * @param bool $simulate
     * @param int|null $simulatedShopifyId
     * @return void
     */
    private function syncUser(User $user, bool $fresh, bool $simulate, ?int $simulatedShopifyId): void
    {
        // STEP 1: find any of our Customers with the same email address, so we can use the combined data
        $userCustomers = $this->getCustomersForUser($user);
        if ($userCustomers->isNotEmpty()) {
            // then add them to the customerIdsSyncedByUsers collection, so we don't try to add them again later
            $this->customerIdsSyncedByUsers->push(...$userCustomers->map(fn (Customer $customer) => $customer->getId()));
        }

        // STEP 2: determine if updating or creating
        // ensuring to check for any of the user's customer entities that may have already been synced
        $alreadySyncedUserCustomers = $userCustomers->filter(fn (Customer $customer) => !is_null($customer->getShopifyId()));
        $isCreating = $fresh || (is_null($user->getShopifyId()) && $alreadySyncedUserCustomers->isEmpty());

        // STEP 3: build up the data structure
        $postData = $this->createCustomerDataForUser($user, $isCreating);

        // STEP 4: send the data to Shopify
        if (!$simulate) {
            try {
                if ($isCreating) {
                    $customerResource = $this->shopify->createCustomer($postData);
                } else {
                    $existingCustomerShopifyId = $user->getShopifyId() ?? $alreadySyncedUserCustomers->first()->getShopifyId();
                    $customerResource = $this->shopify->updateCustomer($existingCustomerShopifyId, $postData);
                }
            } catch (ValidationException $exception) {
                $this->error(sprintf("Validation failed when sending customer data to Shopify: %s",
                    $exception->getMessage()));
                $this->error(sprintf("Please investigate for user or customers with email address %s. Attempted customer data: %s",
                    $user->getEmail(), json_encode($postData)));
                // record the failure in the table then exit out for this user
                $this->tableRows[] = [$user->getId(), "User", "<error>FAILED</error>", $exception->getMessage()];
                return;
            }

            $shopifyCustomerId = $customerResource->id;
            $this->shopifyIds->push($shopifyCustomerId);

            try {
                // record the shopify ID on the User ...
                if ($user->getShopifyId() !== $shopifyCustomerId) {
                    $user->setShopifyId($shopifyCustomerId);
                    $this->entityManager->persist($user);
                    $this->entityManager->flush();
                }
                // ... and any of their related Customers
                $userCustomers->each(function (Customer $customer) use ($shopifyCustomerId) {
                    if ($customer->getShopifyId() !== $shopifyCustomerId) {
                        $customer->setShopifyId($shopifyCustomerId);
                        $this->entityManager->persist($customer);
                        $this->entityManager->flush();
                    }
                });

                // STEP 5: build up the data structure for the User's (and its Customers') Addresses
                $addressesData = $isCreating ? $this->createAddressesDataForUser($user, $userCustomers)
                    : $this->updateAddressesDataForUser($user, $userCustomers);

                // STEP 6: send it to Shopify, if there are any
                $this->sendAddressDataToShopify($addressesData, $shopifyCustomerId);

            } catch (ORMException $e) {
                $this->error(sprintf("Failed to save shopify_id for user or customer with email address %s: %s",
                    $user->getEmail(), $e->getMessage()));
            }
        } else {
            // simulating
            $shopifyCustomerId = $user->getShopifyId() ?? $simulatedShopifyId;
        }

        $this->tableRows[] = [$user->getId(), "User", $isCreating ? "Created" : "Updated", $shopifyCustomerId];
        $userCustomers->each(function(Customer $customer) use ($isCreating, $shopifyCustomerId) {
            $this->tableRows[] = [$customer->getId(), "Customer", $isCreating ? "Created" : "Updated", $shopifyCustomerId];
        });
    }

    /**
     * Sync the customers up to Shopify
     *
     * @param Collection $customers
     * @param int $batchSize
     * @return void
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

        $chunkedCustomers->each(function(Collection $groupedCustomers, int $chunkIndex) use ($bar, $batchSize, $totalBatchesToRun, $totalCountForRun) {
            $this->newLine();
            $this->info(sprintf("Running Customers batch %s of %s", $chunkIndex+1, $totalBatchesToRun));
            $this->shopifyIds = collect();
            $this->createSyncLogIfExecuting();
            // if this is the last chunk, set the progress bar's size
            if ($chunkIndex+1 === $totalBatchesToRun)
            {
                $bar = $this->output->createProgressBar($groupedCustomers->count() % $batchSize);
            }
            $bar->start();

            $simulatedShopifyId = $batchSize * $chunkIndex;
            $groupedCustomers->each(function(Collection $customersCollection, string $email) use (&$simulatedShopifyId, $batchSize, $chunkIndex, $bar) {

                    // STEP 2: determine if updating or creating
                    $alreadySynced = $customersCollection->filter(fn (Customer $customer) => !is_null($customer->getShopifyId()));

                    // sort the customers collection so that we have the newest one first (so we can work our way back when trying to find data)
                    $customersCollection = $customersCollection->sort(function (Customer $customer1, Customer $customer2) {
                        return $customer1->getUpdatedAt() < $customer2->getUpdatedAt();
                    });

                $isCreating = $this->getIsFresh() || $alreadySynced->isEmpty();

                // STEP 3: build up the data structure
                // DEV NOTE: we need the same data regardless of creating or updating
                $postData = $this->createCustomerDataForCustomers($customersCollection, $email);

                // STEP 4: send the data to Shopify
                if (!$this->getIsSimulation()) {

                    try {
                        if ($isCreating) {
                            $customerResource = $this->shopify->createCustomer($postData);
                        } else {
                            $existingCustomerShopifyId = $this->getCustomerValueFor($customersCollection, "getShopifyId");
                            $customerResource = $this->shopify->updateCustomer($existingCustomerShopifyId, $postData);
                        }
                    } catch (ValidationException $exception) {
                        $this->error(sprintf("Validation failed when sending customer data to Shopify: %s",
                            $exception->getMessage()));
                        $this->error(sprintf("Please investigate for customer with email address %s. Attempted customer data: %s",
                            $email, json_encode($postData)));
                        // record the failure in the table then exit out for this customer
                        $this->tableRows[] = [$email, "<error>FAILED</error>", $exception->getMessage()];
                        return;
                    }

                    $shopifyCustomerId = $customerResource->id;
                    $this->shopifyIds->push($shopifyCustomerId);

                    try {
                        // record the shopify ID each Customer
                        $customersCollection->each(function (Customer $customer) use ($shopifyCustomerId) {
                            $customer->setShopifyId($shopifyCustomerId);
                            $this->entityManager->persist($customer);
                            $this->entityManager->flush();
                        });

                        // STEP 5: build up the data structure for the Customers' Addresses
                        $addressesData = $isCreating ? $this->createAddressesDataForCustomers($customersCollection)
                            : $this->updateAddressesDataForCustomers($customersCollection, $shopifyCustomerId);

                        // STEP 6: send it to Shopify, if there are any
                        $this->sendAddressDataToShopify($addressesData, $shopifyCustomerId);
                     } catch (ORMException $e) {
                        $this->error(sprintf("Failed to save shopify_id for customer with email address %s: %s",
                            $email, $e->getMessage()));
                    }

                } else {
                    $shopifyCustomerId = ++$simulatedShopifyId;
                }

                $customersCollection->each(function(Customer $customer) use ($isCreating, $shopifyCustomerId, $bar) {
                    $this->tableRows[] = [$customer->getId(), $isCreating ? "Created" : "Updated", $shopifyCustomerId];
                    $bar->advance();
                });
            });

            // batch has ended
            // print progress bar and table
            $bar->finish();
            $this->newLine();
            $this->table($this->tableHeader, $this->tableRows);
            // finish the sync log
            $this->finishSyncLogIfExecuting($this->shopifyIds);
            // and clear the table rows for the next run
            $this->tableRows = [];
        });
    }

    /**
     * Send the given collection of address data to Shopify, to create or update accordingly,
     * recording the resulting shopify id on each
     *
     * @param Collection $addressesData
     * @param int $shopifyCustomerId
     * @return void
     */
    private function sendAddressDataToShopify(Collection $addressesData, int $shopifyCustomerId): void
    {
        $addressesData->each(function ($addressData) use ($shopifyCustomerId) {
            // check if the addressData has a shopify id and create or update accordingly
            try {
                if (array_key_exists("id", $addressData)) {
                    $addressResource = $this->shopify->updateCustomerAddress($shopifyCustomerId, $addressData["id"], $addressData);
                    $addressShopifyId = $addressResource->id;
                    $this->shopifyIds->push($addressShopifyId);
                } else {
                    $addressResource = $this->shopify->createCustomerAddress($shopifyCustomerId, $addressData);
                    // and record the Shopify ID on the Addresses
                    $addressShopifyId = $addressResource->id;
                    try {
                        $addressEntity = $this->addressRepository->byId($addressData["ecommerce_address_id"]);
                        if ($addressEntity) {
                            $addressEntity->setShopifyId($addressShopifyId);
                            $this->entityManager->persist($addressEntity);
                            $this->entityManager->flush();
                        }
                        $this->shopifyIds->push($addressShopifyId);
                    } catch (\Doctrine\ORM\ORMException $e) {
                        $this->error(sprintf("Failed to find address by ID %s: %s",
                            $addressData["ecommerce_address_id"], $e->getMessage()));
                    }
                }
            } catch (ValidationException $exception) {
                $this->error(sprintf("Validation failed when sending address data to Shopify: %s",
                    $exception->getMessage()));
                $this->error(sprintf("Please investigate for Shopify Customer ID %s. Attempted address data: %s",
                    $shopifyCustomerId, json_encode($addressData)));
            }
        });
    }

    /**
     * @inheritDoc
     */
    protected function getShopifyResourceClass(): string
    {
        return CustomerResource::class;
    }

    /**
     * @inheritDoc
     */
    protected function getSyncResource(): string
    {
        return "customer";
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
     * Do not allow the Customers to be limited for the query. We require the full result set so that we can
     * group them by email address afterwards
     */
    function getLimit(): ?int
    {
        return null;
    }

    /**
     * Get the optional limit provided for the number of users and customers to sync
     */
    function getLimitOption(): ?int
    {
        return $this->option("limit");
    }

    /**
     * @inheritDoc
     */
    protected function getEcommerceEntityRepository(): RepositoryBase|EntityRepository
    {
        return $this->customerRepository;
    }


    /**
     * Create the data to post to Shopify to create a Customer from our User
     *
     * DEV NOTE: we don't bother looking at the user's customers because our system doesn't allow for
     * new Customers to be made after a User already exists with the same email address.
     *
     * @param User $user
     * @param bool $withMetafields
     * @return array
     */
    private function createCustomerDataForUser(User $user, bool $withMetafields): array
    {
        $customerData = [
            "currency" => "USD",
            "email" => $user->getEmail(),
            "first_name" => $user->getFirstName(),
            "last_name" => $user->getLastName(),
            "note" => $user->getSupportNote(),
            "phone" => $this->getPhoneNumberForUser($user),
            // "tags" => "",
        ];

        if ($withMetafields) {
            // refer to https://shopify.dev/docs/apps/custom-data/metafields/types
            // we can use meta fields for stuff like our user id, etc
            $customerData["metafields"] = [
                [
                    "key" => "_id",
                    "value" => $user->getId(),
                    "type" => "number_integer",
                    "namespace" => "users"
                ]
            ];
        }

        return $customerData;
    }

    /**
     * Create the data to post to Shopify to create a Customer from our collection of grouped Customers
     *
     * @param Collection<Customer> $customers
     * @param string $email
     * @return array
     */
    private function createCustomerDataForCustomers(Collection $customers, string $email): array
    {
        return [
            "currency" => "USD",
            "email" => $email,
            "note" => $this->getCustomerValueFor($customers, "getNote"),
            "phone" => $this->getPhoneNumberForCustomer($customers),
            // "tags" => "",
            // DEV NOTE: we won't bother recording the id in a metafield because the data is an amalgamation of
            // any number of customers in our system
        ];
    }

    /**
     * Get all addresses for this user and its customers, then format it to meet Shopify's expectation
     *
     * @param User $user
     * @param Collection<Customer> $customers
     * @return Collection
     */
    private function createAddressesDataForUser(User $user, Collection $customers): Collection
    {
        $addressData = collect();
        // get all the addresses for the user
        $addresses = collect($this->addressRepository->getUserShippingAddresses($user->getId()));

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
     * Find and compare all local versions of addresses for the user provided, against the addresses
     * for the customer in Shopify. If we have any changes, or any new addresses, format those to
     * meet Shopify's expectations.
     *
     * @param User $user
     * @param Collection<Customer> $userCustomers
     * @return Collection
     */
    private function updateAddressesDataForUser(User $user, Collection $userCustomers): Collection
    {
        $addressData = collect();

        $shopifyCustomerId = $user->getShopifyId();
        // first, get the address information from Shopify
        $shopifyAddressesResponse = $this->shopify->getCustomerAddresses($shopifyCustomerId);
        $shopifyAddresses = $shopifyAddressesResponse->map(fn (ApiResource $apiResource) => $apiResource->getAttributes());

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
     * Get all addresses for this collection of customers, then format it to meet Shopify's expectation
     *
     * @param Collection<Customer> $customers
     * @return Collection
     */
    private function createAddressesDataForCustomers(Collection $customers): Collection
    {
        $addressData = collect();
        // get all the addresses for all customers
        $addresses = collect();
        $customers->each(fn(Customer $customer) => $addresses->merge($this->addressRepository->getCustomerShippingAddresses($customer->getId())));

        $addresses = $this->cleanUpAddresses($addresses);

        $addresses->each(function($addressArray) use ($addressData) {
            $addressData->push ($addressArray);
        });

        return $addressData;
    }

    /**
     * Find and compare all local versions of addresses for the collection of customers provided,
     * against the addresses for the customer in Shopify. If we have any changes, or any new addresses,
     * format those to meet Shopify's expectations.
     *
     * @param Collection<Customer> $customers
     * @param int $shopifyCustomerId
     * @return Collection
     */
    private function updateAddressesDataForCustomers(Collection $customers, int $shopifyCustomerId): Collection
    {
        $addressData = collect();

        // first, get the address information from Shopify
        $shopifyAddressesResponse = $this->shopify->getCustomerAddresses($shopifyCustomerId);
        $shopifyAddresses = $shopifyAddressesResponse->map(fn (ApiResource $apiResource) => $apiResource->getAttributes());
        // keep track of the local addresses that we've checked, so we know not to check if they're new
        $checkedLocalAddressIds = collect();

        // get data for all the addresses that need to be updated
        $this->addDataForUpdatedAddresses($shopifyCustomerId, $shopifyAddresses, $checkedLocalAddressIds, $addressData);

        // next, check for any additional addresses that the user has, that haven't yet been synced up to Shopify
        $allLocalAddressData = $this->createAddressesDataForCustomers($customers);
        $this->addDataForNewAddresses($allLocalAddressData, $shopifyAddresses, $checkedLocalAddressIds, $addressData);

        return $addressData;
    }


    /** HELPERS **/

    /**
     * Get all customers with the same email address as the given user
     *
     * @param User $user
     * @return Collection
     */
    private function getCustomersForUser(User $user): Collection
    {
        $qb = $this->customerRepository->createQueryBuilder('customer');
        $qb->where(
            $qb->expr()
                ->eq("customer.email", ":email")
        )->setParameter("email", $user->getEmail());

        $q = $qb->getQuery();

        return collect($q->getResult());
    }

    /**
     * For the given collection of Addresses, clean up the data and format it in a way that Shopify will accept
     *
     * @param Collection<Address> $addresses
     * @return Collection
     */
    private function cleanUpAddresses(Collection $addresses): Collection
    {
        // only use addresses that have at least streetLine1, since we may have addresses with no real data
        $addresses = $addresses->filter(function (Address $address) {
            return !empty($address->getStreetLine1());
        });

        // order them to start with the most recent, just in case of duplicates (we have some cases where the region is all caps, and some not, etc)
        $addresses = $addresses->sort(function (Address $address1, Address $address2) {
            return $address1->getUpdatedAt() < $address2->getUpdatedAt();
        });

        // transform it to fit Shopify's data structure (plus our internal id, so we can reference it to update)
        $addresses->transform(function(Address $address) {
            return  [
                "ecommerce_address_id" => $address->getId(),
                "address1" => $address->getStreetLine1(),
                "address2" => $address->getStreetLine2(),
                "city" => $address->getCity(),
                "country" => $address->getCountry(),
                "first_name" => $address->getFirstName(),
                "last_name" => $address->getLastName(),
                "name" => "{$address->getFirstName()} {$address->getLastName()}",
                "province" => $address->getRegion(),
                "zip" => $address->getZip()
            ];
        });

        // and make sure it's unique - Shopify won't allow multiple addresses with the same data
        return $addresses->unique(function (array $address) {
            // ignore case
            return  strtoupper($address["address1"]).
                strtoupper($address["address2"]).
                strtoupper($address["city"]).
                strtoupper($address["country"]).
                strtoupper($address["first_name"]).
                strtoupper($address["last_name"]).
                strtoupper($address["name"]).
                strtoupper($address["province"]).
                strtoupper($address["zip"]);
        });
    }

    /**
     * Query Shopify for all addresses on file for the given customer ID, then get all of our local addresses with
     * the matching shopify_id stored. Compare Shopify's address data and our own, and if there's a difference,
     * record it in the running $addressData collection.
     *
     * @param int $shopifyCustomerId
     * @param Collection $shopifyAddresses
     * @param Collection $checkedLocalAddressIds
     * @param Collection $addressData
     * @return void
     */
    private function addDataForUpdatedAddresses(int $shopifyCustomerId, Collection $shopifyAddresses, Collection &$checkedLocalAddressIds, Collection &$addressData): void
    {
        // go through all the addresses from Shopify and see if we have any changes to the local version associated with it
        $shopifyAddresses->each(function (array $shopifyAddressData) use (&$checkedLocalAddressIds, &$addressData, $shopifyCustomerId) {
            // use the shopify ID to find our version of it
            try {
                $localAddress = $this->addressRepository->getByShopifyId($shopifyAddressData["id"]);
            } catch (NonUniqueResultException $e) {
                $this->error(sprintf("Mulitiple local addresses found with shopify_id %s. Cannot update address for User or Customer with shopify_id %s",
                    $shopifyAddressData["id"], $shopifyCustomerId));
                return;
            }
            if (is_null($localAddress)) {
                $this->error(sprintf("No local address found with shopify_id %s. Cannot update address for User or Customer with shopify_id %s",
                    $shopifyAddressData["id"], $shopifyCustomerId));
                return;
            }
            $checkedLocalAddressIds->push($localAddress->getId());

            $localAddressData = [
                "address1" => $localAddress->getStreetLine1(),
                "address2" => $localAddress->getStreetLine2(),
                "city" => $localAddress->getCity(),
                "country" => $localAddress->getCountry(),
                "first_name" => $localAddress->getFirstName(),
                "last_name" => $localAddress->getLastName(),
                "name" => "{$localAddress->getFirstName()} {$localAddress->getLastName()}",
                "province" => $localAddress->getRegion(),
                "zip" => $localAddress->getZip()
            ];
            // compare the local data against Shopify's (ignoring case)
            $isDifferent = false;
            foreach ($localAddressData as $key => $value) {
                if (strtoupper($shopifyAddressData[$key]) !== strtoupper($value)) {
                    $isDifferent = true;
                    break;
                }
            };

            // if we have some changes, return our values, plus the shopify ID (so it knows what to update)
            if ($isDifferent) {
                $localAddressData["id"] = $shopifyAddressData["id"];
                $addressData->push($localAddressData);
            }
        });
    }

    /**
     * Go through the given local address data and identify any that are not yet in Shopify's addresses. If any
     * are identifies, record them in the running $addressData collection.
     *
     * @param Collection $allLocalAddressData
     * @param Collection $shopifyAddresses
     * @param Collection $checkedLocalAddressIds
     * @param Collection $addressData
     * @return void
     */
    private function addDataForNewAddresses(Collection $allLocalAddressData,
                                            Collection $shopifyAddresses,
                                            Collection $checkedLocalAddressIds,
                                            Collection &$addressData): void
    {
        // remove any that are already in our collection to sync
        $allLocalAddressData = $allLocalAddressData->filter(function (array $localAddressData) use ($checkedLocalAddressIds) {
            return $checkedLocalAddressIds->doesntContain($localAddressData["ecommerce_address_id"]);
        });

        // make sure that Shopify doesn't already have the address
        $allLocalAddressData->each(function(array $localAddressData) use (&$addressData, $shopifyAddresses) {
            // go through each shopify address and check if this local address data is a complete match.
            // if all fields match for any of the shopify addresses, then we need to skip this one
            $alreadyExists = false;
            $shopifyAddresses->each(function (array $shopifyAddressData) use ($localAddressData, &$alreadyExists) {
                $isDifferent = false;

                foreach ($localAddressData as $key => $value) {
                    // make sure to ignore our added ecommerce_address_id
                    if ($key === "ecommerce_address_id"){
                        continue;
                    }
                    // do a loose comparison (so we don't have to worry about null and "", etc)
                    if (strtoupper($shopifyAddressData[$key]) != strtoupper($value)) {
                        $isDifferent = true;
                        break;
                    }
                };

                if (!$isDifferent) {
                    $alreadyExists = true;
                }
            });

            if (!$alreadyExists) {
                $addressData->push($localAddressData);
            }
        });
    }

    /**
     * Go through all customers in the collection, and try to get the value for the given attribute function,
     * returning the first non-null value retrieved.
     *
     * @param Collection<Customer> $customers
     * @param string $attributeFunction
     * @return string|null
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
     * Get the E.164 formatted phone number for the given user
     *
     * @param User $user
     * @return string|null
     */
    private function getPhoneNumberForUser(User $user): ?string
    {
        // get the raw phone number value
        $phoneNumber = $user->getPhoneNumber();

        if (empty($phoneNumber)) {
            return null;
        }

        // get the user's country, so we can supply the country code
        $address = $this->cleanUpAddresses(
            collect($this->addressRepository->getUserShippingAddresses($user->getId()))
        )->first();

        if (is_array($address) && array_key_exists("country", $address)) {
            $countryName = $address["country"];
        } else {
            $countryName = $address?->getCountry();
        }
        $countryCode = $this->countryNameToISO3166($countryName ?? "Canada");

        $phoneUtil = PhoneNumberUtil::getInstance();

        try {
            $phoneNumberObject = $phoneUtil->parse($phoneNumber, $countryCode);
            return $phoneUtil->format($phoneNumberObject, PhoneNumberFormat::E164);
        } catch (NumberParseException $e) {
            $this->error(sprintf("Unable to format phone number %s for User ID %s: %s", $phoneNumber, $user->getId(), $e->getMessage()));
        }
        return null;
    }

    /**
     * Get the E.164 formatted phone number for the collection of customers
     *
     * @param Collection<Customer> $customers
     * @return string|null
     */
    private function getPhoneNumberForCustomer(Collection $customers): ?string
    {
        // get the raw phone number value
        $phoneNumber = $this->getCustomerValueFor($customers, "getPhone");

        if (empty($phoneNumber)) {
            return null;
        }

        // get the customers' latest address and get the country, so we can supply the country code
        $addresses = collect();
        $customers->each(fn(Customer $customer) => $addresses->push(
            ...$this->addressRepository->getCustomerShippingAddresses($customer->getId())
        ));

        $address = $this->cleanUpAddresses($addresses)->first();
        $countryCode = $this->countryNameToISO3166($address["country"] ?? "Canada");

        $phoneUtil = PhoneNumberUtil::getInstance();

        try {
            $phoneNumberObject = $phoneUtil->parse($phoneNumber, $countryCode);
            return $phoneUtil->format($phoneNumberObject, PhoneNumberFormat::E164);
        } catch (NumberParseException $e) {
            $this->error(sprintf("Unable to format phone number %s for Customer email %s: %s", $phoneNumber, $customers->first()->getEmail(), $e->getMessage()));
        }
        return null;
    }

    /**
     * Get the ISO 3166 country code for the given country name
     * @author https://www.php.net/manual/en/locale.getdisplayregion.php#119895
     *
     * @param $countryName
     * @return string|null
     */
    function countryNameToISO3166($countryName): ?string
    {
        $language = "EN";
        $countryCode_list = array('AF', 'AX', 'AL', 'DZ', 'AS', 'AD', 'AO', 'AI', 'AQ', 'AG', 'AR', 'AM', 'AW', 'AU', 'AT', 'AZ', 'BS', 'BH', 'BD', 'BB', 'BY', 'BE', 'BZ', 'BJ', 'BM', 'BT', 'BO', 'BQ', 'BA', 'BW', 'BV', 'BR', 'IO', 'BN', 'BG', 'BF', 'BI', 'KH', 'CM', 'CA', 'CV', 'KY', 'CF', 'TD', 'CL', 'CN', 'CX', 'CC', 'CO', 'KM', 'CG', 'CD', 'CK', 'CR', 'CI', 'HR', 'CU', 'CW', 'CY', 'CZ', 'DK', 'DJ', 'DM', 'DO', 'EC', 'EG', 'SV', 'GQ', 'ER', 'EE', 'ET', 'FK', 'FO', 'FJ', 'FI', 'FR', 'GF', 'PF', 'TF', 'GA', 'GM', 'GE', 'DE', 'GH', 'GI', 'GR', 'GL', 'GD', 'GP', 'GU', 'GT', 'GG', 'GN', 'GW', 'GY', 'HT', 'HM', 'VA', 'HN', 'HK', 'HU', 'IS', 'IN', 'ID', 'IR', 'IQ', 'IE', 'IM', 'IL', 'IT', 'JM', 'JP', 'JE', 'JO', 'KZ', 'KE', 'KI', 'KP', 'KR', 'KW', 'KG', 'LA', 'LV', 'LB', 'LS', 'LR', 'LY', 'LI', 'LT', 'LU', 'MO', 'MK', 'MG', 'MW', 'MY', 'MV', 'ML', 'MT', 'MH', 'MQ', 'MR', 'MU', 'YT', 'MX', 'FM', 'MD', 'MC', 'MN', 'ME', 'MS', 'MA', 'MZ', 'MM', 'NA', 'NR', 'NP', 'NL', 'NC', 'NZ', 'NI', 'NE', 'NG', 'NU', 'NF', 'MP', 'NO', 'OM', 'PK', 'PW', 'PS', 'PA', 'PG', 'PY', 'PE', 'PH', 'PN', 'PL', 'PT', 'PR', 'QA', 'RE', 'RO', 'RU', 'RW', 'BL', 'SH', 'KN', 'LC', 'MF', 'PM', 'VC', 'WS', 'SM', 'ST', 'SA', 'SN', 'RS', 'SC', 'SL', 'SG', 'SX', 'SK', 'SI', 'SB', 'SO', 'ZA', 'GS', 'SS', 'ES', 'LK', 'SD', 'SR', 'SJ', 'SZ', 'SE', 'CH', 'SY', 'TW', 'TJ', 'TZ', 'TH', 'TL', 'TG', 'TK', 'TO', 'TT', 'TN', 'TR', 'TM', 'TC', 'TV', 'UG', 'UA', 'AE', 'GB', 'US', 'UM', 'UY', 'UZ', 'VU', 'VE', 'VN', 'VG', 'VI', 'WF', 'EH', 'YE', 'ZM', 'ZW');
        $ISO3166 = NULL;
        foreach ($countryCode_list as $countryCode) {
            $locale_cc = \Locale::getDisplayRegion('-' . $countryCode, $language);
            if (strcasecmp($countryName, $locale_cc) == 0) {
                $ISO3166 = $countryCode;
                break;
            }
        }
        return $ISO3166;
    }

    /**
     * @inheritDoc
     */
    protected function syncResource(bool $simulate, bool $fresh): Collection
    {
        // we do not use the SyncsToShopify sync() here. We need to run through all applicable Users and then
        // all applicable Customers, rather than just one entity. That, combined with the huge number of Users in our
        // database, leads to a unique situation for syncing up to Shopify Customers.
        // All of that is done in the handle function, and so this function is never used.

        return collect();
    }
}
