<?php

namespace App\Modules\Ecommerce\Models\Shopify;

class ProductMetaFields
{
    public string $key;
    public string $value;

    public function __construct($graphGLResponse)
    {
        $this->key = $graphGLResponse->node->key;
        $this->value = $graphGLResponse->node->value;
    }


}
