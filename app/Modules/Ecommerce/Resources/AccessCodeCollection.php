<?php

namespace App\Modules\Ecommerce\Resources;

use App\Modules\Ecommerce\Models\Product;
use Illuminate\Http\Resources\Json\ResourceCollection;

class AccessCodeCollection extends ResourceCollection
{
    public function __construct($resource)
    {
        parent::__construct($resource);
        $productIds = [];
        $this->collection->each(function ($accessCodeResource) use (&$productIds) {
            $productIds = array_merge($productIds, unserialize($accessCodeResource->resource->product_ids));
        });
        $productIds = array_unique($productIds);

        $products = Product::whereIn('id', $productIds)->get()->keyBy('id');
        $this->collection->each(function ($accessCodeResource) use ($products, &$productIds) {
            $accessCodeProductIds = unserialize($accessCodeResource->resource->product_ids);
            $accessCodeResource->products = $products->only($accessCodeProductIds)->values();
        });
    }


}
