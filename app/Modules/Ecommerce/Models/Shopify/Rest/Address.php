<?php

namespace App\Modules\Ecommerce\Models\Shopify\Rest;

/**
 * Data Model for a Shopify Address, using the REST Admin API.
 */
class Address
{
    public ?string $name;
    public ?string $firstName;
    public ?string $lastName;
    public ?string $company;
    public ?string $phone;
    public ?string $address1;
    public ?string $address2;
    public ?string $city;
    public ?string $zip;
    public ?string $province;
    public ?string $province_code;
    public ?string $country;
    public ?string $country_code;
    public ?string $latitude;
    public ?string $longitude;

    public function __construct($shopifyAddressData)
    {
        $this->firstName = $shopifyAddressData->first_name;
        $this->address1 = $shopifyAddressData->address1;
        $this->phone = $shopifyAddressData->phone;
        $this->city = $shopifyAddressData->city;
        $this->zip = $shopifyAddressData->zip;
        $this->province = $shopifyAddressData->province;
        $this->country = $shopifyAddressData->country;
        $this->lastName = $shopifyAddressData->last_name;
        $this->address2 = $shopifyAddressData->address2;
        $this->company = $shopifyAddressData->company;
        $this->latitude = $shopifyAddressData->latitude;
        $this->longitude = $shopifyAddressData->longitude;
        $this->name = $shopifyAddressData->name;
        $this->country_code = $shopifyAddressData->country_code;
        $this->province_code = $shopifyAddressData->province_code;
    }

    public function toShopifyArray(): array
    {
        $data = [];
        if ($this->address1) {
            $data['address1'] = $this->address1;
        }
        if ($this->address2) {
            $data['address2'] = $this->address2;
        }
        if ($this->city) {
            $data['city'] = $this->city;
        }
        if ($this->company) {
            $data['company'] = $this->company;
        }
        if ($this->firstName) {
            $data['$this->first_name'] = $this->firstName;
        }
        if ($this->lastName) {
            $data['$this->last_name'] = $this->lastName;
        }
        if ($this->phone) {
            $data['phone'] = $this->phone;
        }
        if ($this->province) {
            $data['province'] = $this->province;
        }
        if ($this->country) {
            $data['country'] = $this->country;
        }
        if ($this->zip) {
            $data['zip'] = $this->zip;
        }
        if ($this->province_code) {
            $data['province_code'] = $this->province_code;
        }
        if ($this->country_code) {
            $data['country_code'] = $this->country_code;
        }
        if ($this->name) {
            $data['$this->name'] = $this->name;
        }
        return array_merge($data);
    }
}
