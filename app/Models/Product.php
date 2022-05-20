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

    public function features()
    {
        return $this->hasMany(Feature::class);
    }

    public function specs()
    {
        return $this->hasMany(Spec::class);
    }

    public function sizes()
    {
        return $this->hasManyThrough(Size::class, Product_Size::class, 'product_id', 'id', 'id', 'size_id')
                    ->addSelect(['product__sizes.sold_out', 'sizes.*']);
    }

    public function product_size()
    {
        return $this->hasMany(Product_Size::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    protected $guarded = [
        'id'
    ];
}
