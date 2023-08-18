<?php

namespace App\Console\Commands;

use App\Console\Commands\Traits\SyncsToShopify;
use Doctrine\ORM\EntityRepository;
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

        return $this->sync();
    }

    protected function getEcommerceEntities(bool $fresh) : Collection
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
            $qb->where(
                $qb->expr()
                    ->isNull("entity.shopifyId")
            )
                ->orWhere(
                    $qb->expr()
                        ->gt("entity.updatedAt", ":lastSyncAt")
                )->setParameter("lastSyncAt", $lastSyncAt)
             ->andWhere(
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
        $shopifyIds = collect();

        // STEP 1: get all the Users that we're going to sync
        $users = $this->getEcommerceEntities($fresh);

        $this->info("Found {$users->count()} users to be synced");

        $bar = $this->output->createProgressBar($users->count());
        $bar->start();

        $tableHeaders = ["User or Customer ID", "Class", "Shopify Customer ID"];
        $tableRows = [];

        // STEP 2: sync Users
        $simulatedShopifyId = 0;
        $users->each(function (User $user) use ($fresh, $bar, $simulate, $shopifyIds, &$tableRows, &$simulatedShopifyId) {
            // STEP 2-1: for each User, find any of our Customers with the same email address, so we can use the combined data
            $userCustomers = $this->getCustomersForUser($user);

            // STEP 2-2: determine if updating or creating
            $isCreating = $fresh || is_null($user->getShopifyId());

            // STEP 2-3: build up the data structure
            $postData = $isCreating ? $this->createCustomerDataForUser($user)
                : $this->updateCustomerDataForUser($user, $userCustomers);

            // STEP 2-4: send the data to Shopify
            if (!$simulate) {

                $customerResource = $isCreating ? $this->shopify->createCustomer($postData)
                    : $this->shopify->updateCustomer($user->getShopifyId(), $postData);

                $shopifyId = $customerResource->id;
                $shopifyIds->push($shopifyId);

                // record the shopify ID on the User ...
                if ($user->getShopifyId() !== $shopifyId) {
                    $user->setShopifyId($shopifyId);
                    $this->entityManager->persist($user);
                    $this->entityManager->flush();
                }
                // ... and any of their related Customers
                $userCustomers->each(function (Customer $customer) use ($shopifyId) {
                    $customer->setShopifyId($shopifyId);
                    $this->entityManager->persist($customer);
                    $this->entityManager->flush();
                });

                // STEP 2-5: build up the data structure for the User's (and its Customers') Addresses
                $addressesData = $this->createAddressesDataForUser($user, $userCustomers);

                // STEP 2-6: send it to Shopify, if there are any
                $addressesData->each(function ($addressData) use ($shopifyIds, $shopifyId) {
                    $addressResource = $this->shopify->createCustomerAddress($shopifyId, $addressData);
                    // and record the Shopify ID on the Addresses
                    $addressShopifyId = $addressResource->id;
                    $addressEntity = $this->addressRepository->byId($addressData["ecommerce_address_id"]);
                    if ($addressEntity) {
                        $addressEntity->setShopifyId($shopifyId);
                        $this->entityManager->persist($addressEntity);
                        $this->entityManager->flush();
                    }
                    $shopifyIds->push($addressShopifyId);
                });
            } else {
                $shopifyId = ++$simulatedShopifyId;
            }

            $tableRows[] = [$user->getId(), "User", $shopifyId];
            $userCustomers->each(function(Customer $customer) use (&$tableRows, $shopifyId) {
                $tableRows[] = [$customer->getId(), "Customer", $shopifyId];
            });
            $bar->advance();
        })->chunk(100);

        $bar->finish();
        $this->newLine();

        $this->table($tableHeaders, $tableRows);

        // STEP 3: sync Customers who were not done as part of the Users
        //TODO

        return $shopifyIds;
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
     * @param User $user
     * @return array
     */
    private function createCustomerDataForUser(User $user): array
    {
        return [
            "currency" => "USD",
            "email" => $user->getEmail(),
            "first_name" => $user->getFirstName(),
            "last_name" => $user->getLastName(),
            "note" => $user->getSupportNote(),
            "phone" => $user->getPhoneNumber(),
            //TODO?
            // "tags" => "",

            // TODO?
            // refer to https://shopify.dev/docs/apps/custom-data/metafields/types
            // we can use meta fields for stuff like our product id, etc
            "metafields" => [
                [
                    "key" => "_id",
                    "value" => $user->getId(),
                    "type" => "number_integer",
                    "namespace" => "users"
                ]
            ]
        ];
    }

    private function updateCustomerDataForUser(User $user, Collection $customers): array
    {
    //    TODO
        return [];
    }

    /**
     * Get all addresses for this user and its customers, then format it to meet Shopify's expectation
     *
     * @param User $user
     * @param Collection $customers
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
}
