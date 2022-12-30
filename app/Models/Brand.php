<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Venturecraft\Revisionable\RevisionableTrait;

/**
 * App\Models\Brand
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Product[] $accessories
 * @property-read int|null $accessories_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Product[] $clothing
 * @property-read int|null $clothing_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Product[] $lessons
 * @property-read int|null $lessons_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Product[] $products
 * @property-read int|null $products_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Venturecraft\Revisionable\Revision[] $revisionHistory
 * @property-read int|null $revision_history_count
 * @method static \Illuminate\Database\Eloquent\Builder|Brand newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Brand newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Brand query()
 * @method static \Illuminate\Database\Eloquent\Builder|Brand whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Brand whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Brand whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Brand whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Brand extends Model
{
    use HasFactory;
    use RevisionableTrait;

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
