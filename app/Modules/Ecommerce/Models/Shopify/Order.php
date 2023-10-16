<?php

namespace App\Modules\Ecommerce\Models\Shopify;

use Carbon\Carbon;
use Illuminate\Support\Collection;

class Order
{
    public string $gid;

    public int $id;
    public ?string $brand;
    public ?string $paymentSource;
    public Collection $lineItems;
    public ?Carbon $createdAt;
    public ?Carbon $cancelledAt;

    public function __construct(
        $graphGLResponse
    ) {
        $this->gid = $graphGLResponse->id;
        $this->id = str_replace('gid://shopify/Order/', '', $graphGLResponse->id);
        $this->brand = $graphGLResponse->brand?->value;
        $this->paymentSource = $graphGLResponse->paymentSource?->value;
        $this->createdAt = $graphGLResponse->createdAt ? Carbon::parse($graphGLResponse->createdAt) : null;
        $this->cancelledAt = $graphGLResponse->cancelledAt ? Carbon::parse($graphGLResponse->cancelledAt) : null;
        $this->lineItems = collect($graphGLResponse->lineItems->nodes)->map(function ($item) {
            return new OrderLineItem($item);
        });
    }
}
