<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Venturecraft\Revisionable\RevisionableTrait;

/**
 * App\Models\Benefit
 *
 * @property int $id
 * @property int $product_id
 * @property string $icon
 * @property string $heading
 * @property string $desc
 * @property int $order_number
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Product|null $product
 * @property-read \Illuminate\Database\Eloquent\Collection|\Venturecraft\Revisionable\Revision[] $revisionHistory
 * @property-read int|null $revision_history_count
 * @method static \Illuminate\Database\Eloquent\Builder|Benefit newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Benefit newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Benefit query()
 * @method static \Illuminate\Database\Eloquent\Builder|Benefit whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Benefit whereDesc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Benefit whereHeading($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Benefit whereIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Benefit whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Benefit whereOrderNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Benefit whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Benefit whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Benefit extends Model
{
    use HasFactory;
    use RevisionableTrait;

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    protected $guarded = [
        'id'
    ];
}
