<?php

namespace App\Modules\Ecommerce\Collections;

use App\Modules\Ecommerce\Models\Shopify\Order;
use Illuminate\Support\Collection;

class OrderCollection
{
    private Collection $orders;
    private Collection $products;

    public function __construct(Collection $orders, Collection $products)
    {
        $this->orders = $orders;
        $this->products = $products;

        $productLookup = $products->keyBy('sku');

        $orders->each(function ($order) use ($productLookup) {
            /** @var Order $order */
            $order->setProducts($productLookup);
        });
    }

    public function getOrders(): Collection
    {
        return $this->orders;
    }

    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function getOrderBrands()
    {
        return $this->orders->pluck('lineItems')->flatten(1)->pluck('product.brand')->unique()->toArray();
    }


}
