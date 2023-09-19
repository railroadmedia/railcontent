<?php

namespace App\Modules\Ecommerce\Jobs\Shopify\Traits;

use Doctrine\ORM\Exception\ORMException;
use Illuminate\Support\Collection;
use Railroad\Ecommerce\Entities\Address;
use Railroad\Ecommerce\Entities\Customer;
use Railroad\Ecommerce\Managers\EcommerceEntityManager;
use Railroad\Ecommerce\Repositories\AddressRepository;

trait SavesShopifyIdOnAddresses
{
    /**
     * Go through the addresses for the given user (and any of their associated customers), or the given customer,
     * and retrieve any that have matching values to those provided.
     *
     * @param int|null $userId
     * @param Collection<Customer>|null $customers
     * @param string $firstName
     * @param string $lastName
     * @param string $address1
     * @param string|null $address2
     * @param string $city
     * @param string $province
     * @param string $provinceCode
     * @param string $zip
     * @param string $country
     * @param string $countryCode
     * @return Collection
     */
    protected function findAddressesWithMatchingData(?int $userId, ?Collection $customers,
                                                     string $firstName, string $lastName, string $address1,
                                                     ?string $address2, string $city, string $province, string $provinceCode,
                                                     string $zip, string $country, string $countryCode): Collection
    {
        // one or the other must be set
        assert(!is_null($userId) || (!is_null($customers) && $customers->isNotEmpty()));

        // make a key out of the values, so we can compare our addresses (ignoring case)
        // DEV NOTE: we aren't consistent with region and country, and Shopify automatically converts names and codes,
        // so we need to create keys for all possibilities
        $checkKeyNamedProvinceAndCountry = preg_replace('/\s+/', '',
            strtoupper($firstName)
                    . strtoupper($lastName)
                    . strtoupper($address1)
                    . strtoupper($address2 ?? "")
                    . strtoupper($city)
                    . strtoupper($province)
                    . strtoupper($zip)
                    . strtoupper($country)
                );

        $checkKeyProvinceCodeAndCountryName = preg_replace('/\s+/', '',
            strtoupper($firstName)
            . strtoupper($lastName)
            . strtoupper($address1)
            . strtoupper($address2 ?? "")
            . strtoupper($city)
            . strtoupper($provinceCode)
            . strtoupper($zip)
            . strtoupper($country)
        );

        $checkKeyProvinceNameAndCountryCode = preg_replace('/\s+/', '',
            strtoupper($firstName)
            . strtoupper($lastName)
            . strtoupper($address1)
            . strtoupper($address2 ?? "")
            . strtoupper($city)
            . strtoupper($province)
            . strtoupper($zip)
            . strtoupper($countryCode)
        );

        $checkKeyProvinceAndCountryCode = preg_replace('/\s+/', '',
            strtoupper($firstName)
            . strtoupper($lastName)
            . strtoupper($address1)
            . strtoupper($address2 ?? "")
            . strtoupper($city)
            . strtoupper($provinceCode)
            . strtoupper($zip)
            . strtoupper($countryCode)
        );

        $checkKeys = collect([$checkKeyNamedProvinceAndCountry, $checkKeyProvinceCodeAndCountryName, $checkKeyProvinceNameAndCountryCode, $checkKeyProvinceAndCountryCode]);

        $addresses = collect();
        if (!is_null($userId)) {
            // get all the addresses for the user
            $addresses = collect($this->getAddressRepository()->getUserShippingAddresses($userId));
            // and its customers, if there are any
            if (!is_null($customers)) {
                $customers->each(fn(Customer $customer) => $addresses->push(
                    ...$this->getAddressRepository()->getCustomerShippingAddresses($customer->getId())
                ));
            }
            $addresses;
        } else {
            // get all the addresses for the customers
            $customers->each(fn(Customer $customer) => $addresses->push(
                ...$this->getAddressRepository()->getCustomerShippingAddresses($customer->getId())
            ));
        }

        // go through each address, and see if it matches all our values
        return $addresses->filter(function (Address $address) use ($checkKeys) {
            return $checkKeys->contains($this->getKey($address));
        });
    }

    /**
     * Store the give shopify id on each address in the collection
     *
     * @param Collection<Address> $addresses
     * @param int $shopifyId
     * @return void
     * @throws ORMException
     */
    protected function storeShopifyId(Collection $addresses, int $shopifyId): void
    {
        $addresses->each(function(Address $address) use ($shopifyId) {
            $address->setShopifyId($shopifyId);
            $this->getEntityManager()->persist($address);
            $this->getEntityManager()->flush();
        });
    }

    /**
     * Make a key out of the desired values from this address, so we can compare against our keyed values
     *
     * @param Address $address
     * @return string
     */
    private function getKey(Address $address): string
    {
        return preg_replace('/\s+/', '',
            strtoupper($address->getFirstName())
                . strtoupper($address->getLastName())
                . strtoupper($address->getStreetLine1())
                . strtoupper($address->getStreetLine2() ?? "")
                . strtoupper($address->getCity())
                . strtoupper($address->getRegion())
                . strtoupper($address->getZip())
                . strtoupper($address->getCountry())
            );
    }

    /**
     * The Address Repository used to interact with the Ecommerce Address entities
     *
     * @return AddressRepository
     */
    abstract protected function getAddressRepository(): AddressRepository;

    /**
     * The Entity Manager used to update Ecommerce entities
     *
     * @return EcommerceEntityManager
     */
    abstract protected function getEntityManager(): EcommerceEntityManager;
}
