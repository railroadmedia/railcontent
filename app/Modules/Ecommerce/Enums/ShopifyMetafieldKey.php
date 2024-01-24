<?php

namespace App\Modules\Ecommerce\Enums;

/**
 * Keys used for Shopify Metafield entries.
 * NOTE: the key must be at least 3 characters long.
 */
enum ShopifyMetafieldKey: string
{
    case Id = '_id'; // the internal ID in our db
    case IsMusoraAccountSetUp = 'is_musora_account_set_up';
    case LastTrialEndDate = 'last_trial_end_date';
    case Brand = 'brand';
    case PaymentSource = 'payment_source';

    case InventoryControlSKU = 'inventory_control_sku';

    case FulfillmentSKU = 'fulfillment_sku';
    case DigitalAccessType = 'digital_access_type';
    case DigitalAccessTimeType = 'digital_access_time_type';
    case DigitalAccessTimeIntervalType = 'digital_access_time_interval_type';
    case DigitalAccessTimeIntervalLength = 'digital_access_time_interval_length';

    case AddressRegion = 'address_region';
    case AddressCountry = 'address_country';
}
