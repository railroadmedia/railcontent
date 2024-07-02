<?php

namespace App\Modules\Ecommerce\Models\Shopify;

use App\Modules\Ecommerce\Enums\ShopifyMetafieldKey;
use App\Modules\Ecommerce\Enums\ShopifyMetafieldNamespace;
use App\Modules\Ecommerce\Enums\ShopifyMetafieldOwnerTypeEnum;
use App\Modules\Ecommerce\Enums\ShopifyMetafieldTypes;

class MetaFieldDefinition
{
    public ?string $id;
    public mixed $value;
    public string $name;
    public ?string $description;
    public string $namespace;
    public string $key;
    public string $type;
    public string $ownerType;

    public function __construct(
        string $name,
        ?string $description,
        string|ShopifyMetafieldKey $key,
        ShopifyMetafieldTypes $type,
        string|ShopifyMetafieldNamespace $namespace,
        ShopifyMetafieldOwnerTypeEnum $ownerType,
        mixed $id = null,
        mixed $value = null
    ) {
        $this->name = $name;
        $this->description = $description;
        $this->value = $value;
        $this->type = $type->value;
        $this->namespace = is_string($namespace) ? $namespace : $namespace->value;
        $this->ownerType = $ownerType->value;
        $this->id = $id;
        $this->key = is_string($key) ? $key : $key->value;
    }

    /**
     * Structure the MetaField Definition's values into an array for Shopify query
     *
     * @param  MetaFieldDefinition  $metaFieldDefinition
     * @return array
     */
    public static function getStructureForShopifyQuery(self $metaFieldDefinition): array
    {
        return [
            "name" => $metaFieldDefinition->name,
            "key" => $metaFieldDefinition->key,
            "type" => $metaFieldDefinition->type,
            "namespace" => $metaFieldDefinition->namespace,
            "ownerType" => $metaFieldDefinition->ownerType
        ];
    }

    /**
     * Structure the MetaField Definition's values into an array for Shopify mutation
     *
     * @param  MetaFieldDefinition  $metaFieldDefinition
     * @return array
     */
    public static function getStructureForShopifyMutation(self $metaFieldDefinition): array
    {
        return [
            "name" => $metaFieldDefinition->name,
            "description" => $metaFieldDefinition->description,
            "key" => $metaFieldDefinition->key,
            "value" => strval($metaFieldDefinition->value),
            "type" => $metaFieldDefinition->type,
            "namespace" => $metaFieldDefinition->namespace,
            "ownerType" => $metaFieldDefinition->ownerType
        ];
    }

    /**
     * Create a MetaFieldDefinition from Shopify's response data array
     *
     * @param  array  $data
     * @return MetaFieldDefinition
     */
    public static function fromShopifyData(array $data): self
    {
        return new self(
            $data['name'],
            $data['description'] ?: null,
            ShopifyMetafieldKey::tryFrom($data['key']) ?? $data['key'],
            ShopifyMetafieldTypes::from($data['type']),
            ShopifyMetafieldNamespace::tryFrom($data['namespace']) ?? $data['namespace'],
            ShopifyMetafieldOwnerTypeEnum::from($data['ownerType']),
            $data['id'],
            null
        );
    }
}
