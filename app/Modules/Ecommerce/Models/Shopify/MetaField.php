<?php

namespace App\Modules\Ecommerce\Models\Shopify;

use App\Modules\Ecommerce\Enums\ShopifyMetafieldKey;
use App\Modules\Ecommerce\Enums\ShopifyMetafieldNamespace;
use App\Modules\Ecommerce\Enums\ShopifyMetafieldTypes;
use Signifly\Shopify\REST\Resources\MetafieldResource;

class MetaField
{
    public string $key;
    public string $value;
    public string $type;
    public string $namespace;

    public function __construct(
        string|ShopifyMetafieldKey $key,
        string $value,
        ShopifyMetafieldTypes $type,
        string|ShopifyMetafieldNamespace $namespace
    ) {
        $this->key = is_string($key) ? $key : $key->value;
        $this->value = $value;
        $this->type = $type->value;
        $this->namespace = is_string($namespace) ? $namespace : $namespace->value;
    }

    /**
     * Structure the MetaField's values into an array for Shopify
     *
     * @param  MetaField  $metaField
     * @return array
     */
    public static function getStructureForShopify(self $metaField): array
    {
        return [
            "key" => $metaField->key,
            "value" => $metaField->value,
            "type" => $metaField->type,
            "namespace" => $metaField->namespace
        ];
    }

    /**
     * Structure the MetafieldResource from Shopify into an array of applicable MetaField values
     *
     * @param  MetafieldResource  $metafieldResource
     * @return array
     */
    public static function getStructureFromShopify(MetafieldResource $metafieldResource): array
    {
        return [
            "key" => $metafieldResource->key,
            "value" => $metafieldResource->value,
            "type" => $metafieldResource->type,
            "namespace" => $metafieldResource->namespace
        ];
    }
}
