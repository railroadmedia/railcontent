<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

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
        return $this->hasMany(Feature::class)->orderBy('order_number');
    }

    public function specs()
    {
        return $this->hasMany(Spec::class)->orderBy('order_number');
    }

    public function sizes()
    {
        return $this->hasManyThrough(Size::class, ProductSize::class, 'product_id', 'id', 'id', 'size_id')
                    ->addSelect(['product_sizes.sold_out', 'sizes.*'])->orderBy('id');
    }

    public function product_size()
    {
        return $this->hasMany(ProductSize::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class)->orderBy('order_number');
    }

    public function sizeChart()
    {
        return $this->belongsTo(SizeChart::class, 'size_chart_id');
    }

    public function delete()
    {
        Feature::where('product_id', '=', $this->id)->delete();
        ProductSize::where('product_id', '=', $this->id)->delete();
        Spec::where('product_id', '=', $this->id)->delete();

        $imgs = Image::where('product_id', '=', $this->id)->get();

        foreach($imgs as $img){
            Storage::disk('s3')->delete($img->path);
        }

        Image::where('product_id', '=', $this->id)->delete();

        Product::where('id', '=', $this->id)->delete();
    }

    protected $guarded = [
        'id'
    ];
}
