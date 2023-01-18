<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Venturecraft\Revisionable\RevisionableTrait;


/**
 * App\Models\Product
 *
 * @property int $id
 * @property int $brand_id
 * @property int $product_type_id
 * @property string $name
 * @property string|null $slug
 * @property string $sku
 * @property string|null $promo_code
 * @property string|null $thumbnail
 * @property string|null $badge_text
 * @property string|null $header_text
 * @property string|null $subheader_text
 * @property string|null $short_desc
 * @property string|null $meta_desc
 * @property string|null $meta_img
 * @property string|null $special_text
 * @property string|null $thumbnail_logo
 * @property string|null $page_logo
 * @property string $price
 * @property string|null $discounted_price
 * @property string|null $spread_img
 * @property string|null $overview
 * @property string|null $study_text
 * @property string|null $video_src
 * @property string|null $product_img
 * @property string|null $instructor_name
 * @property string|null $instructor_desc
 * @property int|null $size_chart_id
 * @property int $sold_out
 * @property int $guaranteed
 * @property int $visible
 * @property int $free_shipping
 * @property int $included_edge
 * @property int $size_case_sensitive
 * @property int $bundle_free_shipping
 * @property string|null $bundle_img
 * @property string|null $bundle_desc
 * @property int $display_order
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Benefit[] $benefits
 * @property-read int|null $benefits_count
 * @property-read \App\Models\Brand|null $brand
 * @property-read \Illuminate\Database\Eloquent\Collection|Product[] $bundles
 * @property-read int|null $bundles_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Feature[] $features
 * @property-read int|null $features_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Image[] $images
 * @property-read int|null $images_count
 * @property-read \App\Models\ProductType|null $productType
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ProductSize[] $product_size
 * @property-read int|null $product_size_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Venturecraft\Revisionable\Revision[] $revisionHistory
 * @property-read int|null $revision_history_count
 * @property-read \App\Models\SizeChart|null $sizeChart
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Size[] $sizes
 * @property-read int|null $sizes_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Spec[] $specs
 * @property-read int|null $specs_count
 * @method static \Illuminate\Database\Eloquent\Builder|Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product query()
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereBadgeText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereBrandId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereBundleDesc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereBundleFreeShipping($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereBundleImg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereDiscountedPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereDisplayOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereFreeShipping($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereGuaranteed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereHeaderText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereIncludedEdge($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereInstructorDesc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereInstructorName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereMetaDesc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereMetaImg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereOverview($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product wherePageLogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereProductImg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereProductTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product wherePromoCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereShortDesc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereSizeCaseSensitive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereSizeChartId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereSku($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereSoldOut($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereSpecialText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereSpreadImg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereStudyText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereSubheaderText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereThumbnail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereThumbnailLogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereVideoSrc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereVisible($value)
 * @mixin \Eloquent
 */
class Product extends Model
{
    use HasFactory;
    use RevisionableTrait;
    use SoftDeletes;

    protected $with = ["brand", "productType"];
    protected $dontKeepRevisionOf = ['uuid'];

    protected $revisionForceDeleteEnabled = true;

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

    public function benefits()
    {
        return $this->hasMany(Benefit::class);
    }

    public function sizes()
    {
        return $this->hasManyThrough(Size::class, ProductSize::class, 'product_id', 'id', 'id', 'size_id')
                    ->addSelect(['product_sizes.id', 'sizes.name', 'sizes.id as sizeId', 'sizes.code'])->orderBy('sizeId');
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
        return $this->hasManyThrough( Product::class,Bundle::class, 'bundle_id', 'id', 'id', 'product_id')->select(['products.name', 'bundles.id', 'bundles.product_id as bundle_product_id', 'bundles.lifetime_access', 'products.bundle_img', 'products.bundle_desc', 'products.bundle_free_shipping', 'products.price', 'bundles.free_bonus'])->orderBy('order_number');
    }

    public function sizeChart()
    {
        return $this->belongsTo(SizeChart::class, 'size_chart_id');
    }

    protected function slug(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => str_replace( array('Drumeo-', 'Pianote-', 'Guitareo-', 'Singeo-'), '', $value ),
        );
    }

    public static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub

        self::saving(function ($model){
            $uuid = $model['uuid'];
            unset($model['uuid']);

            if(!empty($model['slug'])){
                $model['slug'] = $model->brand->name.'-'.$model['slug'];
            }

            if(gettype($model['meta_img']) === 'object'){
                $model['meta_img'] = 'https://laravel-nova.s3.us-east-2.amazonaws.com/'.$model->brand->name.'/Meta-images/'.$uuid.'-'.$model['meta_img']->getClientOriginalName();
            }

            if(gettype($model['spread_img']) === 'object'){
                $model['spread_img'] = 'https://laravel-nova.s3.us-east-2.amazonaws.com/'.$model->brand->name.'/Spread-images/'.$uuid.'-'.$model['spread_img']->getClientOriginalName();
            }

            if(gettype($model['thumbnail']) === 'object'){
                $model['thumbnail'] = 'https://laravel-nova.s3.us-east-2.amazonaws.com/'.$model->brand->name.'/Thumbnails/'.$uuid.'-'.$model['thumbnail']->getClientOriginalName();
            }

            if(gettype($model['thumbnail_logo']) === 'object'){
                $model['thumbnail_logo'] = 'https://laravel-nova.s3.us-east-2.amazonaws.com/'.$model->brand->name.'/Thumbnail-logos/'.$uuid.'-'.$model['thumbnail_logo']->getClientOriginalName();
            }

            if(gettype($model['page_logo']) === 'object'){
                $model['page_logo'] = 'https://laravel-nova.s3.us-east-2.amazonaws.com/'.$model->brand->name.'/Page-logos/'.$uuid.'-'.$model['page_logo']->getClientOriginalName();
            }

            if(gettype($model['product_img']) === 'object'){
                $model['product_img'] = 'https://laravel-nova.s3.us-east-2.amazonaws.com/'.$model->brand->name.'/Product-images/'.$uuid.'-'.$model['product_img']->getClientOriginalName();
            }

            if(gettype($model['bundle_img']) === 'object'){
                $model['bundle_img'] = 'https://laravel-nova.s3.us-east-2.amazonaws.com/'.$model->brand->name.'/Bundle-images/'.$uuid.'-'.$model['bundle_img']->getClientOriginalName();
            }
        });

    }

    protected $guarded = [
        'id'
    ];
}
