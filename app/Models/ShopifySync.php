<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class ShopifySync extends Model
{
    use HasFactory;

    public const RESOURCE_PRODUCT = "product";
    public const RESOURCE_CUSTOMER = "customer";
    public const RESOURCE_ORDER = "order";
    public const RESOURCE_SUBSCRIPTION_PAYMENT = "subscription_payment";

    protected $guarded = [];

    protected $casts = [
        'shopify_ids' => 'array',
        'finished_at' => 'datetime'
    ];

    /**
     * Scope a query to get only the latest sync to finish.
     */
    public function scopeLatestFinished(Builder $query): void
    {
        $query->orderByDesc("finished_at")->limit(1);
    }
}
