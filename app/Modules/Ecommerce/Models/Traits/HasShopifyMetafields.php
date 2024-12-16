<?php

namespace App\Modules\Ecommerce\Models\Traits;

use App\Modules\Ecommerce\Models\Product;
use App\Modules\Ecommerce\Models\Shopify\MetaField;
use Exception;
use Illuminate\Support\Collection;
use Modules\UserManagementSystem\Models\User;
use Signifly\Shopify\REST\Resources\MetafieldResource;
use Signifly\Shopify\Shopify;

trait HasShopifyMetafields
{
    /**
     * Get any metafields for this model that are not already in Shopify
     *
     * @throws Exception
     */
    public function getNewMetafieldsForShopify(): array
    {
        $localMetaFields = collect($this->getMetafieldsForShopify());
        $shopifyMetaFields = $this->getMetafieldsFromShopify();
        if ($shopifyMetaFields->isEmpty()) {
            return $localMetaFields->toArray();
        }
        // Shopify has extra fields we don't care about, so clean up the response data
        $existingMetaFields = $shopifyMetaFields->transform(
            fn (MetafieldResource $metafieldResource) => MetaField::getStructureFromShopify($metafieldResource)
        );

        $newMetafields = $localMetaFields->diffKeys($existingMetaFields);
        return $newMetafields->values()->toArray();
    }

    /**
     * Get the array of metafields, as formatted for Shopify to receive.
     * NOTE keys must be unique within the namespace
     *
     * @link https://shopify.dev/docs/apps/custom-data/metafields/types for additional information
     *
     * @return array<MetaField>
     */
    abstract public function getMetafieldsForShopify(): array;

    /**
     * Query Shopify for the metafields for this model.
     *
     * @throws Exception
     */
    protected function getMetafieldsFromShopify(): Collection
    {
        if (!$this->shopify_id) {
            throw new Exception("No shopify_id set on this model. Unable to query Shopify for metafields");
        }

        /** @var Shopify $shopify */
        $shopify = app(Shopify::class);

        return match (get_class($this)) {
            User::class => $shopify->getCustomerMetafields($this->shopify_id),
            Product::class => $shopify->getVariantMetafields($this->shopify_id),
            default => throw new Exception("No method defined to get metafields from Shopify")
        };
    }
}
