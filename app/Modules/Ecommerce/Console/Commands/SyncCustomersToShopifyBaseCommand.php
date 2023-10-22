<?php

namespace App\Modules\Ecommerce\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\Ecommerce\Console\Commands\Traits\SyncsToShopify;
use App\Modules\Ecommerce\Jobs\Shopify\Traits\FindsCustomers;
use App\Modules\Ecommerce\Jobs\Shopify\Traits\HandlesMaskedEmailAddress;
use App\Modules\Ecommerce\Jobs\Shopify\Traits\SavesShopifyIdOnAddresses;
use App\Modules\Ecommerce\Models\Address;
use Carbon\Carbon;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\NonUniqueResultException;
use Illuminate\Support\Collection;
use Modules\UserManagementSystem\Models\User;
use Railroad\Ecommerce\Entities\Customer;
use Railroad\Ecommerce\Managers\EcommerceEntityManager;
use Railroad\Ecommerce\Repositories\AddressRepository;
use Railroad\Ecommerce\Repositories\CustomerRepository;
use Railroad\Ecommerce\Repositories\RepositoryBase;
use Signifly\Shopify\Exceptions\ValidationException;
use Signifly\Shopify\REST\Resources\CustomerResource;
use Signifly\Shopify\Shopify;

class SyncCustomersToShopifyBaseCommand extends Command
{
    use FindsCustomers;
    use HandlesMaskedEmailAddress;
    use SavesShopifyIdOnAddresses;
    use SyncsToShopify;

    // we need to have the signature defined to meet requirements of the command, but it will be overridden
    protected $signature = "-";

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
     * Query Shopify for a customer with the given email address. If found, get our user and/or customers with the
     * same email address, and store the shopify_id to link them to the Shopify customer.
     * Use the Shopify customer's addresses to set the shopify_id for our user/customer's addresses as well.
     *
     * @param  string  $email
     * @return void
     */
    protected function linkExistingCustomer(string $email): void
    {
        $shopifyCustomers = $this->shopify->getCustomers(["email" => $this->getEmailForShopify($email)]);
        $shopifyAttributes = $shopifyCustomers->first()->getAttributes() ?? null;

        // this shouldn't be possible, but check just in case
        if (is_null($shopifyAttributes)) {
            $this->error(
                sprintf(
                    "The email address %s was already in use in Shopify, but no customers were found".
                    " when attempting to retrieve it from Shopify",
                    $email
                )
            );
            $this->tableRows[] = [$email, "", "<error>FAILED</error>", "Existing email but no customers"];
            return;
        }

        $shopifyCustomerId = $shopifyAttributes["id"];
        // find all of our users and customers with that email address, and store the shopify_id
        $user = User::query()->firstWhere("email", $email);

        if (!is_null($user)) {
            $user->shopify_id = $shopifyCustomerId;
            $user->saveWithoutUpdatedAt();
        }
        $customers = $this->getCustomersForEmail($email);
        try {
            $customers->each(function (Customer $customer) use ($shopifyCustomerId) {
                // grab the eloquent model, so we can update it
                $customerModel = \App\Modules\Ecommerce\Models\Customer::find($customer->getId());
                $customerModel->shopify_id = $shopifyCustomerId;
                $customerModel->saveWithoutUpdatedAt();
                // refresh the doctrine model to get the change
                $this->entityManager->refresh($customer);
            });
        } catch (ORMException $e) {
            $this->error(
                sprintf(
                    "Failed to store shopify_id %s on customers with email address %s: %s",
                    $shopifyCustomerId,
                    $email,
                    $e->getMessage()
                )
            );
            $this->tableRows[] = [$email, "<error>FAILED</error>", "Failed to save shopify_id on existing customers"];
        }

        // find any addresses for our user and/or customers that match Shopify's, and store the shopify_id
        collect($shopifyAttributes["addresses"])->each(function (array $addressData) use ($email, $customers, $user) {
            $matchedAddresses = $this->findAddressesWithMatchingData(
                $user->id ?? null,
                $customers,
                $addressData["first_name"],
                $addressData["last_name"],
                $addressData["address1"],
                $addressData["address2"],
                $addressData["city"],
                $addressData["province"],
                $addressData["province_code"],
                $addressData["zip"],
                $addressData["country"],
                $addressData["country_code"]
            );
            if ($matchedAddresses->isNotEmpty()) {
                $addressShopifyId = $addressData["id"];
                try {
                    $this->storeShopifyId($matchedAddresses, $addressShopifyId);
                } catch (ORMException $e) {
                    $this->error(
                        sprintf(
                            "Failed to store shopify_id %s on address(es) for user or customer with email".
                            " address %s: %s",
                            $addressShopifyId,
                            $email,
                            $e->getMessage()
                        )
                    );
                    $this->tableRows[] = [
                        $email,
                        "<error>FAILED</error>",
                        "Failed to save shopify_id on existing addresses"
                    ];
                }
            }
        });
    }

    /**
     * Go through the given local address data and identify any that are not yet in Shopify's addresses. If any
     * are identified, record them in the running $addressData collection.
     *
     * @param  Collection  $allLocalAddressData
     * @param  Collection  $shopifyAddresses
     * @param  Collection  $checkedLocalAddressIds
     * @param  Collection  $addressData
     * @return void
     */
    protected function addDataForNewAddresses(
        Collection $allLocalAddressData,
        Collection $shopifyAddresses,
        Collection $checkedLocalAddressIds,
        Collection &$addressData
    ): void {
        // remove any that are already in our collection to sync
        $allLocalAddressData = $allLocalAddressData->filter(
            function (array $localAddressData) use ($checkedLocalAddressIds) {
                return $checkedLocalAddressIds->doesntContain($localAddressData["ecommerce_address_id"]);
            }
        );

        // make sure that Shopify doesn't already have the address
        $allLocalAddressData->each(function (array $localAddressData) use (&$addressData, $shopifyAddresses) {
            // go through each shopify address and check if this local address data is a complete match.
            // if all fields match for any of the shopify addresses, then we need to skip this one
            $alreadyExists = false;
            $shopifyAddresses->each(function (array $shopifyAddressData) use ($localAddressData, &$alreadyExists) {
                $isDifferent = false;

                foreach ($localAddressData as $key => $value) {
                    // make sure to ignore our added ecommerce_address_id
                    if ($key === "ecommerce_address_id") {
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
     * Query Shopify for all addresses on file for the given customer ID, then get all of our local addresses with
     * the matching shopify_id stored. Compare Shopify's address data and our own, and if there's a difference,
     * record it in the running $addressData collection.
     *
     * @param  int  $shopifyCustomerId
     * @param  Collection  $shopifyAddresses
     * @param  Collection  $checkedLocalAddressIds
     * @param  Collection  $addressData
     * @return void
     */
    protected function addDataForUpdatedAddresses(
        int $shopifyCustomerId,
        Collection $shopifyAddresses,
        Collection &$checkedLocalAddressIds,
        Collection &$addressData
    ): void {
        // go through all the addresses from Shopify and see if we have any changes to the local version associated with it
        $shopifyAddresses->each(
            function (array $shopifyAddressData) use (&$checkedLocalAddressIds, &$addressData, $shopifyCustomerId) {
                // use the shopify ID to find our version of it
                try {
                    $localAddress = $this->addressRepository->getByShopifyId($shopifyAddressData["id"]);
                } catch (NonUniqueResultException $e) {
                    $this->error(
                        sprintf(
                            "Mulitiple local addresses found with shopify_id %s. Cannot update address for User or Customer with shopify_id %s",
                            $shopifyAddressData["id"],
                            $shopifyCustomerId
                        )
                    );
                    return;
                }
                if (is_null($localAddress)) {
                    $this->error(
                        sprintf(
                            "No local address found with shopify_id %s. Cannot update address for User or Customer with shopify_id %s",
                            $shopifyAddressData["id"],
                            $shopifyCustomerId
                        )
                    );
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
            }
        );
    }

    /**
     * Send the given collection of address data to Shopify, to create or update accordingly,
     * recording the resulting shopify id on each
     *
     * @param  Collection  $addressesData
     * @param  int  $shopifyCustomerId
     * @return void
     */
    protected function sendAddressDataToShopify(Collection $addressesData, int $shopifyCustomerId): void
    {
        $addressesData->each(function ($addressData) use ($shopifyCustomerId) {
            // check if the addressData has a shopify id and create or update accordingly
            try {
                if (array_key_exists("id", $addressData)) {
                    $addressResource = $this->shopify->updateCustomerAddress(
                        $shopifyCustomerId,
                        $addressData["id"],
                        $addressData
                    );
                    $addressShopifyId = $addressResource->id;
                    $this->shopifyIds->push($addressShopifyId);
                } else {
                    $addressResource = $this->shopify->createCustomerAddress($shopifyCustomerId, $addressData);
                    // and record the Shopify ID on the Addresses
                    $addressShopifyId = $addressResource->id;
                    try {
                        $addressEntity = $this->addressRepository->byId($addressData["ecommerce_address_id"]);
                        if ($addressEntity) {
                            // grab the eloquent model, so we can update it
                            $addressModel = Address::find($addressEntity->getId());
                            $addressModel->shopify_id = $addressShopifyId;
                            $addressModel->saveWithoutUpdatedAt();
                            // refresh the doctrine model to get the change
                            $this->entityManager->refresh($addressEntity);
                        }
                        $this->shopifyIds->push($addressShopifyId);
                    } catch (\Doctrine\ORM\ORMException $e) {
                        $this->error(
                            sprintf(
                                "Failed to find address by ID %s: %s",
                                $addressData["ecommerce_address_id"],
                                $e->getMessage()
                            )
                        );
                    }
                }
            } catch (ValidationException $exception) {
                $this->error(
                    sprintf(
                        "Validation failed when sending address data to Shopify: %s",
                        $exception->getMessage()
                    )
                );
                $this->error(
                    sprintf(
                        "Please investigate for Shopify Customer ID %s. Attempted address data: %s",
                        $shopifyCustomerId,
                        json_encode($addressData)
                    )
                );
            }
        });
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
    protected function getIsSimulation(): bool
    {
        return $this->option("execute") == false;
    }

    /**
     * @inheritDoc
     */
    protected function getIsFresh(): bool
    {
        return $this->option("fresh");
    }

    /**
     * @inheritDoc
     */
    protected function getLimit(): ?int
    {
        return $this->option("limit");
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
    protected function syncResource(bool $simulate, bool $fresh): Collection
    {
        // we do not use the SyncsToShopify sync() here. We need to run through all applicable Users/Customers,
        // rather than just one entity. That, combined with the huge number of Users and Customers in our
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
}
