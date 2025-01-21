<?php

namespace App\Modules\Ecommerce\Models\Shopify\Rest;

use Carbon\Carbon;
use Illuminate\Support\Collection;

/**
 * Data Model for a Shopify Fulfillment, using the REST Admin API.
 */
class Fulfillment
{
    // DEV NOTE: this only has the attributes required so far. Please add to this, as needed.

    public string $gid;
    public int $id;
    public int $orderId;
    public int $locationId;
    public string $name;
    /** @var Collection<OrderLineItem> $lineItems */
    public Collection $lineItems;
    public string $status;
    public ?string $shipmentStatus;
    public ?Address $originAddress;
    public ?string $trackingCompany;
    public ?string $trackingNumber;
    public Collection $trackingNumbers;
    public ?string $trackingUrl;
    public Collection $trackingUrls;
    public Carbon $createdAt;
    public Carbon $updatedAt;

    public function __construct($shopifyFulfillmentData)
    {
        $this->id = $shopifyFulfillmentData->id;
        $this->gid = $shopifyFulfillmentData->admin_graphql_api_id;
        $this->orderId = $shopifyFulfillmentData->order_id;
        $this->locationId = $shopifyFulfillmentData->location_id;
        $this->name = $shopifyFulfillmentData->name;
        $this->lineItems = collect($shopifyFulfillmentData->line_items)->map(function ($item) {
            return new OrderLineItem($item);
        });
        $this->shipmentStatus = $shopifyFulfillmentData->shipment_status;
        $this->status = $shopifyFulfillmentData->status;
        if (!empty($shopifyFulfillmentData->originAddress)) {
            $this->originAddress = new Address($shopifyFulfillmentData->originAddress);
        } else {
            $this->originAddress = null;
        }

        $this->trackingCompany = $shopifyFulfillmentData->tracking_company;
        $this->trackingNumber = $shopifyFulfillmentData->tracking_number;
        $this->trackingNumbers = collect($shopifyFulfillmentData->tracking_numbers);
        $this->trackingUrl = $shopifyFulfillmentData->tracking_url;
        $this->trackingUrls = collect($shopifyFulfillmentData->tracking_urls);
        $this->createdAt = Carbon::parse($shopifyFulfillmentData->created_at);
        $this->updatedAt = Carbon::parse($shopifyFulfillmentData->updated_at);
    }

}
