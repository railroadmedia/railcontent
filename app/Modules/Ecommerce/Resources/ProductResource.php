<?php

namespace App\Modules\Ecommerce\Resources;

use App\Modules\Ecommerce\Models\AccessCode;
use App\Modules\Ecommerce\Models\Product;
use App\Modules\UserManagementSystem\Resources\UserResource;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray($request): array
    {
        /** @var Product $product */
        $product = $this->resource;
        return [
            'id' => $product->id,
            'brand' => $product->brand,
            'name' => $product->name,
            'sku' => $product->sku,
            'price' => $product->price,
            'type' => $product->type,
            'active' => $product->active,
            'category' => $product->category,
            'description' => $product->description,
            'thumbnailUrl' => $product->thumbnail_url,
            'salesPageUrl' => $product->sales_page_url,
            'isPhysical' => $product->is_physical,
            'weight' => $product->weight,
            'stock' => $product->stock,
            'publicStockCount' => $product->public_stock_count,
        ];
    }
}
