<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Whitecube\NovaFlexibleContent\Value\FlexibleCast;

class Product extends Model
{
    use HasFactory;

    protected $with = ["brand", "productType"];

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function productType()
    {
        return $this->belongsTo(ProductType::class, 'product_type_id');
    }

    public function feature()
    {
        return $this->hasMany(Feature::class);
    }

    protected $casts = [
        'features' => FlexibleCast::class
    ];

    protected $guarded = [
        'id'
    ];
}
