<?php

namespace App\Modules\Ecommerce\Jobs\Shopify;

use App\Modules\Ecommerce\Models\SubscriptionPayment;
use Illuminate\Database\Eloquent\Builder;

class SyncSubscriptionPaymentAddressMetafieldsToShopifyOrder extends SyncAddressMetafieldsToShopifyBaseClass
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
        return "subscription payment";
    }

    /**
     * @inheritDoc
     */
    protected function getModelsQuery(): Builder
    {
        return SubscriptionPayment::query()
            ->whereBetween("id", [$this->startAtId, $this->endAtId])
            ->whereBetween('created_at', [$this->startCreatedAt, $this->endCreatedAt])
            ->whereNotNull('shopify_id');
    }
}
