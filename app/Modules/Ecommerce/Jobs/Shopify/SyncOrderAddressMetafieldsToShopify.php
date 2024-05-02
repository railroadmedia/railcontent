<?php

namespace App\Modules\Ecommerce\Jobs\Shopify;

use App\Modules\Ecommerce\Models\Order;
use Illuminate\Database\Eloquent\Builder;

class SyncOrderAddressMetafieldsToShopify extends SyncAddressMetafieldsToShopifyBaseClass
{
    /**
     * @inheritDoc
     */
    protected function getClassName(): string
    {
        return get_class($this);
    }


    /**
     * @inheritDoc
     */
    protected function getModelTypeName(): string
    {
        return "order";
    }

    /**
     * @inheritDoc
     */
    protected function getModelsQuery(): Builder
    {
        return Order::query()
            ->whereBetween("id", [$this->startAtId, $this->endAtId])
            ->whereBetween('created_at', [$this->startCreatedAt, $this->endCreatedAt])
            ->whereNotNull('shopify_id');
    }
}
