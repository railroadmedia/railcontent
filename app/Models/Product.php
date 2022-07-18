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
                    ->addSelect(['product_sizes.sold_out', 'product_sizes.id', 'sizes.name', 'sizes.id as sizeId', 'sizes.code'])->orderBy('sizeId');
    }

    public function product_size()
    {
        return $this->hasMany(ProductSize::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class)->orderBy('order_number');
    }

    public function bundles()
    {
        return $this->hasManyThrough( Product::class,Bundle::class, 'bundle_id', 'id', 'id', 'product_id')->select(['products.name', 'bundles.id', 'bundles.product_id as bundle_product_id', 'products.thumbnail', 'products.bundle_lifetime_access', 'products.bundle_free_shipping', 'products.price', 'products.free_bonus', 'products.short_desc'])->orderBy('order_number');
    }

    public function sizeChart()
    {
        return $this->belongsTo(SizeChart::class, 'size_chart_id');
    }

    public function save(array $options = [])
    {
       Product::create([
           'brand_id' => $this->brand_id,
           'product_type_id' => $this->product_type_id,
           'name' => $this->name,
           'slug' => $this->slug,
           'sku' => $this->sku,
           'thumbnail' => $this->thumbnail,
           'header_text' => $this->header_text,
           'short_desc' => $this->short_desc,
           'meta_desc' => $this->meta_desc,
           'meta_img' => $this->meta_img,
           'special_text' => $this->special_text,
           'thumbnail_logo' => $this->thumbnail_logo,
           'study_text' => $this->study_text,
           'page_logo' => $this->page_logo,
           'price' => $this->price,
           'discounted_price' => $this->discounted_price,
           'video_src' => $this->video_src,
           'overview' => $this->overview,
           'instructor_name' => $this->instructor_name,
           'product_img' => $this->product_img,
           'instructor_desc' => $this->instructor_desc,
           'sold_out' => $this->sold_out,
           'free_shipping' => $this->free_shipping,
           'guaranteed' => $this->guaranteed,
           'visible' => $this->visible,
           'free_bonus' => $this->free_bonus,
           'membership_discount' => $this->membership_discount,
           'lifetime_access' => $this->lifetime_access,
           'size_case_sensitive' => $this->size_case_sensitive,
           'created_at' => now(),
           'updated_at' => now(),
       ]);
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

        Bundle::where('bundle_id', '=', $this->id)->delete();

        Product::where('id', '=', $this->id)->delete();
    }

    protected $guarded = [
        'id'
    ];
}
