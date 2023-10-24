<?php

namespace App\Modules\Ecommerce\Models\Shopify;

class OrderLineItem
{
    public string $gid;
    public int $id;
    public string $sku;

    public function __construct(
        $graphGLResponse
    ) {
        $this->gid = $graphGLResponse->id;
        $this->id = str_replace('gid://shopify/LineItem/', '', $graphGLResponse->id);
        $this->sku = $graphGLResponse->sku;
    }

}
