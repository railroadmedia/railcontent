<?php

namespace App\Modules\Ecommerce\Jobs\Shopify\Traits;

use App\Modules\Ecommerce\Models\Address;
use Doctrine\ORM\NonUniqueResultException;
use Illuminate\Support\Collection;
use Signifly\Shopify\Exceptions\ValidationException;

trait SyncsAddressData
{
    /**
     * Query Shopify for all addresses on file for the given customer ID, then get all of our local addresses with
     * the matching shopify_id stored. Compare Shopify's address data and our own, and if there's a difference,
     * record it in the running $addressData collection.
     *
     * @return Collection  notices for any addresses that failed
     */
    protected function addDataForUpdatedAddresses(
        int $shopifyCustomerId,
        Collection $shopifyAddresses,
        Collection &$checkedLocalAddressIds,
        Collection &$addressData
    ): Collection {
        $failures = collect();
        // go through all the addresses from Shopify and see if we have any changes to the local version associated with it
        $shopifyAddresses->each(
            function (array $shopifyAddressData) use ($failures, &$checkedLocalAddressIds, &$addressData, $shopifyCustomerId) {
                // use the shopify ID to find our version of it
                try {
                    $localAddress = $this->addressRepository->getByShopifyId($shopifyAddressData["id"]);
                } catch (NonUniqueResultException $e) {
                    $failures->push(
                        sprintf(
                            "Mulitiple local addresses found with shopify_id %s. Cannot update address for User or Customer with shopify_id %s",
                            $shopifyAddressData["id"],
                            $shopifyCustomerId
                        )
                    );
                    return;
                }
                if (is_null($localAddress)) {
                    $failures->push(
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
                    "first_name" => $localAddress->getFirstName(),
                    "last_name" => $localAddress->getLastName(),
                    "name" => "{$localAddress->getFirstName()} {$localAddress->getLastName()}",
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

                // we store region and country in either short code or full name, so compare those separately,
                // and add them to the address data after the main comparison
                $localAddressData["country"] = $localAddress->getCountry();
                if (!in_array(
                    strtoupper($localAddressData["country"]),
                    [
                        strtoupper($shopifyAddressData["country_code"]),
                        strtoupper($shopifyAddressData["country_name"])
                    ]
                )
                ) {
                    $isDifferent = true;
                }
                $localAddressData["province"] = $localAddress->getRegion();
                if (!in_array(
                    strtoupper($localAddressData["province"]),
                    [
                        strtoupper($shopifyAddressData["province_code"]),
                        strtoupper($shopifyAddressData["province"])
                    ]
                )
                ) {
                    $isDifferent = true;
                }

                // if we have some changes, return our values, plus the shopify ID (so it knows what to update)
                if ($isDifferent) {
                    $localAddressData["id"] = $shopifyAddressData["id"];
                    $addressData->push($localAddressData);
                }
            }
        );
        return $failures;
    }

    /**
     * Go through the given local address data and identify any that are not yet in Shopify's addresses. If any
     * are identified, record them in the running $addressData collection.
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
     * Send the given collection of address data to Shopify, to create or update accordingly,
     * recording the resulting shopify id on each
     *
     * @return Collection notices for any errors
     */
    protected function sendAddressDataToShopify(Collection $addressesData, int $shopifyCustomerId, Collection &$shopifyIds): Collection
    {
        $errors = collect();
        $addressesData->each(function ($addressData) use (&$shopifyIds, $errors, $shopifyCustomerId) {
            // check if the addressData has a shopify id and create or update accordingly
            try {
                if (array_key_exists("id", $addressData)) {
                    $addressResource = $this->shopify->updateCustomerAddress(
                        $shopifyCustomerId,
                        $addressData["id"],
                        $addressData
                    );
                    $addressShopifyId = $addressResource->id;
                    $shopifyIds->push($addressShopifyId);
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
                        $shopifyIds->push($addressShopifyId);
                    } catch (\Doctrine\ORM\ORMException $e) {
                        $errors->push(
                            sprintf(
                                "Failed to find address by ID %s: %s",
                                $addressData["ecommerce_address_id"],
                                $e->getMessage()
                            )
                        );
                    }
                }
            } catch (ValidationException $exception) {
                $errors->push(
                    sprintf(
                        "Validation failed when sending address data to Shopify: %s",
                        $exception->getMessage()
                    )
                );
                $errors->push(
                    sprintf(
                        "Please investigate for Shopify Customer ID %s. Attempted address data: %s",
                        $shopifyCustomerId,
                        json_encode($addressData)
                    )
                );
            }
        });
        return $errors;
    }
}
