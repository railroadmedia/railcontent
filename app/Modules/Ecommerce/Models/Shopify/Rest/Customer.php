<?php

namespace App\Modules\Ecommerce\Models\Shopify\Rest;

use Carbon\Carbon;

/**
 * Data Model for a Shopify Customer, using the REST Admin API.
 */
class Customer
{
    // DEV NOTE: this only has the attributes required so far. Please add to this, as needed.

    public string $gid;
    public int $id;
    public Carbon $createdAt;
    public ?string $firstName;
    public ?string $lastName;
    public ?string $email;
    public array $tags;


    public function __construct($shopifyCustomerData)
    {
        $this->id = $shopifyCustomerData->id;
        $this->gid = $shopifyCustomerData->admin_graphql_api_id;
        $this->createdAt = Carbon::parse($shopifyCustomerData->created_at);
        $this->firstName = $shopifyCustomerData->first_name;
        $this->lastName = $shopifyCustomerData->last_name;
        $this->email = $shopifyCustomerData->email;
        $this->tags = empty($shopifyCustomerData->tags) ? [] : array_map(
            'trim',
            explode(',', $shopifyCustomerData->tags)
        );
    }
}
