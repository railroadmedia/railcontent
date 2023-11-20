<?php

namespace App\Modules\Ecommerce\Models\Shopify;

use App\Modules\Ecommerce\Models\Product;

class OrderLineItem
{
    public string $gid;
    public int $id;
    public string $sku;
    public ?Product $product = null;
    public Order $order;

    public function __construct(
        Order $order,
        $graphGLResponse
    ) {
        $this->gid = $graphGLResponse->id;
        $this->id = str_replace('gid://shopify/LineItem/', '', $graphGLResponse->id);
        $this->sku = $graphGLResponse->sku;
        $this->order = $order;
    }

    public function setProduct(Product $product): void
    {
        $this->product = $product;
    }

}
