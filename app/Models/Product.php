<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function ProductType()
    {
        return $this->belongsTo(ProductType::class, 'product_type_id');
    }

    protected $fillable = [
        'name'
    ];
}
