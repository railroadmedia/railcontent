<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function lessons()
    {
        return $this->hasMany(Product::class)->where('product_type_id', 1);
    }

    public function accessories()
    {
        return $this->hasMany(Product::class)->where('product_type_id', 2);
    }

    public function clothing()
    {
        return $this->hasMany(Product::class)->whereIn('product_type_id', [3,4,5]);
    }

    protected $guarded = [
        'id'
    ];
}
