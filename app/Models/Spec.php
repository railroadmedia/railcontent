<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Venturecraft\Revisionable\RevisionableTrait;

/**
 * App\Models\Spec
 *
 * @property int $id
 * @property int $product_id
 * @property string $title
 * @property string $desc
 * @property int $order_number
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Product|null $product
 * @property-read \Illuminate\Database\Eloquent\Collection|\Venturecraft\Revisionable\Revision[] $revisionHistory
 * @property-read int|null $revision_history_count
 * @method static \Illuminate\Database\Eloquent\Builder|Spec newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Spec newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Spec query()
 * @method static \Illuminate\Database\Eloquent\Builder|Spec whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Spec whereDesc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Spec whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Spec whereOrderNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Spec whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Spec whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Spec whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Spec extends Model
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
