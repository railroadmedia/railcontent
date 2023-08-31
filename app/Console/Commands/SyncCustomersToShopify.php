<?php

namespace App\Console\Commands;

use App\Console\Commands\Traits\SyncsToShopify;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Exception\ORMException;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Railroad\Ecommerce\Entities\Address;
use Railroad\Ecommerce\Entities\Customer;
use Railroad\Ecommerce\Entities\User;
use Railroad\Ecommerce\Managers\EcommerceEntityManager;
use Railroad\Ecommerce\Repositories\AddressRepository;
use Railroad\Ecommerce\Repositories\CustomerRepository;
use Railroad\Ecommerce\Repositories\RepositoryBase;
use Railroad\Ecommerce\Repositories\UserRepository;
use Signifly\Shopify\REST\Resources\ApiResource;
use Signifly\Shopify\REST\Resources\CustomerResource;
use Signifly\Shopify\Shopify;
use Symfony\Component\Console\Helper\ProgressBar;

class SyncCustomersToShopify extends Command
{
    use SyncsToShopify;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'shopify:sync-customers {--fresh} {--execute}';

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

    private Collection $customerIdsSyncedByUsers;

    // running collection of the Shopify IDs returned in this run, so we can record it
    protected Collection $shopifyIds;
    // rows for displaying the results in a table
    protected array $tableRows;

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

        $this->shopifyIds = collect();
        $this->tableRows = [];

        return $this->sync();
    }

    protected function getTestUsersEntities(bool $fresh) : Collection
    {
        /*
         TODO: delete this!
          this is just for a simple test case
          people who bought product 129 - Drumeo for Teachers - 1 year, 163 - Bass Drum Technique
            order id: 31490,59526,59715,61069,68775,60643,60895,61019,71344
             -> this has no customers, only users
             user id: (300577, 303623, 303835, 216876, 304549, 183029, 208824, 270181, 313935)
         */
        $qb = $this->getEcommerceEntityRepository()->createQueryBuilder('entity');

        if (!$fresh) {
            $lastSyncAt = $this->getDateTimeOfLastSync();
            $this->info(
                sprintf("Retrieving all users that have not been synced, or have been updated since %s, and are in our test pool of IDs ...",
                    $lastSyncAt->toString())
            );
            // $qb->where(
            //     $qb->expr()
            //         ->isNull("entity.shopifyId")
            // )
            //     ->orWhere(
            //         $qb->expr()
            //             ->gt("entity.updatedAt", ":lastSyncAt")
            //     )->setParameter("lastSyncAt", $lastSyncAt)
            //  ->andWhere(
            //      $qb->expr()
            //          ->in("entity.id", ":ids")
            //  )->setParameter("ids", [300577, 303623, 303835, 216876, 304549, 183029, 208824, 270181, 313935])
            $qb->where(
                $qb->expr()
                    ->in("entity.id", ":ids")
            )->setParameter("ids", [300577, 303623, 303835, 216876, 304549, 183029, 208824, 270181, 313935])
            ;
        }

        $q = $qb->getQuery();

        return collect($q->getResult());
    }


    /**
     * @inheritDoc
     */
    protected function syncResource(bool $simulate, bool $fresh): Collection
    {
        // STEP 1: get all the Users that we're going to sync
        //TODO after test scenario, replace with
        //$users = $this->getEcommerceEntities($fresh);
        $users = $this->getTestUsersEntities($fresh);
        //TODO just ignore the customers for now
        // $customers = $this->getEcommerceEntities($fresh, $this->customerRepository);
        $customers = collect();

        $this->info("Found {$users->count()} users and {$customers->count()} customers to be synced");

        $bar = $this->output->createProgressBar($users->count() + $customers->count());
        $bar->start();

        // STEP 2: sync Users
        $this->syncUsers($users, $customers, $fresh, $bar, $simulate);

        // STEP 3: sync Customers who were not done as part of the Users
        $this->syncCustomers($customers, $fresh, $bar, $simulate);

        $bar->finish();
        $this->newLine();

        $this->table(["User or Customer ID", "Class", "Action", "Shopify Customer ID"], $this->tableRows);
        return $this->shopifyIds;
    }

    /**
     * Sync the users up to Shopify
     *
     * @param Collection $users - users to sync up
     * @param Collection $customers - our customers that we'll sync later
     * @param bool $fresh
     * @param ProgressBar $bar
     * @param bool $simulate
     * @return void
     */
    private function syncUsers(Collection $users, Collection $customers, bool $fresh, ProgressBar $bar, bool $simulate): void
    {
        $simulatedShopifyId = 0;
        $users->each(function (User $user) use (&$customers, $fresh, $bar, $simulate, &$simulatedShopifyId) {
            // STEP 1: for each User, find any of our Customers with the same email address, so we can use the combined data
            $userCustomers = $this->getCustomersForUser($user);
            if ($userCustomers->isNotEmpty()) {
                // then remove them from the customers collection, so we don't try to add them again later

                // DEV NOTE: we can't just `forget` because the entities don't expose their data,
                // so we must pluck out the IDs and then `reject`
                $userCustomerIds = $userCustomers->map(fn (Customer $customer) => $customer->getId());
                $customers = $customers->reject(fn (Customer $customer) => $userCustomerIds->contains($customer->getId()));
            }

            // STEP 2: determine if updating or creating
            // ensuring to check for any of the user's customer entities that may have already been synced
            $alreadySyncedUserCustomers = $userCustomers->filter(fn (Customer $customer) => !is_null($customer->getShopifyId()));
            $isCreating = $fresh || (is_null($user->getShopifyId()) && $alreadySyncedUserCustomers->isEmpty());

            // STEP 3: build up the data structure
            $postData = $this->createCustomerDataForUser($user, $isCreating);

            // STEP 4: send the data to Shopify
            if (!$simulate) {
                if ($isCreating) {
                    $customerResource = $this->shopify->createCustomer($postData);
                } else {
                    $existingCustomerShopifyId = $user->getShopifyId() ?? $alreadySyncedUserCustomers->first()->getShopifyId();
                    $customerResource = $this->shopify->updateCustomer($existingCustomerShopifyId, $postData);
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
                    $addressesData->each(function ($addressData) use ($shopifyCustomerId) {
                        // check if the addressData has a shopify id and create or update accordingly
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
                    });
                } catch (ORMException $e) {
                    $this->error(sprintf("Failed to save shopify_id for user or customer with email address %s: %s",
                        $user->getEmail(), $e->getMessage()));
                }
            } else {
                // simulating
                $shopifyCustomerId = $user->getShopifyId() ?? ++$simulatedShopifyId;
            }

            $this->tableRows[] = [$user->getId(), "User", $isCreating ? "Created" : "Updated", $shopifyCustomerId];
            $userCustomers->each(function(Customer $customer) use ($isCreating, $shopifyCustomerId) {
                $this->tableRows[] = [$customer->getId(), "Customer", $isCreating ? "Created" : "Updated", $shopifyCustomerId];
            });
            $bar->advance($userCustomers->count() + 1);
        })->chunk(100);
    }


    /**
     * Sync the customers up to Shopify
     *
     * @param Collection $customers
     * @param bool $fresh
     * @param ProgressBar $bar
     * @param bool $simulate
     * @return void
     */
    private function syncCustomers(Collection $customers, bool $fresh, ProgressBar $bar, bool $simulate): void
    {
        //    TODO
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
     * @inheritDoc
     */
    protected function getEcommerceEntityRepository(): RepositoryBase|EntityRepository
    {
        // return $this->customerRepository;
        return $this->userRepository;
    }

    /**
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
            "phone" => $user->getPhoneNumber(),
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
     * @return array
     */
    private function createCustomerDataForCustomers(Collection $customers): array
    {
        //    TODO
        return [];
    }

    /**
     * Create the data to post to Shopify to update a Customer from our collection of grouped Customers
     *
     * @param Collection<Customer> $customers
     * @return array
     */
    private function updateCustomerDataForCustomers(Collection $customers): array
    {
        //    TODO
        return [];
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
        $customers->each(fn(Customer $customer) => $addresses->merge($this->addressRepository->getCustomerShippingAddresses($customer->getId())));

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
        $addresses = $addresses->unique(function (array $address) {
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
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    private function updateAddressesDataForUser(User $user, Collection $userCustomers): Collection
    {
        $shopifyCustomerId = $user->getShopifyId();
        $addressData = collect();

        // first, get the address information from Shopify
        $shopifyAddressesResponse = $this->shopify->getCustomerAddresses($shopifyCustomerId);
        $shopifyAddresses = $shopifyAddressesResponse->map(fn (ApiResource $apiResource) => $apiResource->getAttributes());

        // keep track of the local addresses that we've checked, so we know not to check if they're new
        $checkedLocalAddressIds = collect();

        // go through all the addresses from Shopify and see if we have any changes to the local version associated with it
        $shopifyAddresses->each(function (array $shopifyAddressData) use ($checkedLocalAddressIds, $addressData, $shopifyCustomerId) {
            // use the shopify ID to find our version of it
            $localAddress = $this->addressRepository->getByShopifyId($shopifyAddressData["id"]);
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

        // next, check for any additional addresses that the user has, that haven't yet been synced up to Shopify
        $allUniqueLocalAddressData = $this->createAddressesDataForUser($user, $userCustomers);
        // remove any that are already in our collection to sync
        $allUniqueLocalAddressData = $allUniqueLocalAddressData->filter(function (array $localAddressData) use ($checkedLocalAddressIds) {
            return $checkedLocalAddressIds->doesntContain($localAddressData["ecommerce_address_id"]);
        });
        // make sure that Shopify doesn't already have the address
        $allUniqueLocalAddressData->each(function(array $localAddressData) use ($addressData, $shopifyAddresses) {
            $isNew = false;
            $shopifyAddresses->each(function (array $shopifyAddressData) use ($addressData, $localAddressData, &$isNew) {
                foreach ($localAddressData as $key => $value) {
                    // make sure to ignore our added ecommerce_address_id
                    if ($key !== "ecommerce_address_id" && strtoupper($shopifyAddressData[$key]) !== strtoupper($value)) {
                        $isNew = true;
                        break;
                    }
                };
                if ($isNew) {
                    $addressData->push($localAddressData);
                    $isNew = false;
                }
            });
        });

        return $addressData;
    }
}
