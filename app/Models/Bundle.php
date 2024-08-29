<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Venturecraft\Revisionable\RevisionableTrait;

/**
 * App\Models\Bundle
 *
 * @property int $id
 * @property int $bundle_id
 * @property int $product_id
 * @property int $free_bonus
 * @property int $lifetime_access
 * @property int $order_number
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Product|null $product
 * @property-read \Illuminate\Database\Eloquent\Collection|\Venturecraft\Revisionable\Revision[] $revisionHistory
 * @property-read int|null $revision_history_count
 * @method static \Illuminate\Database\Eloquent\Builder|Bundle newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Bundle newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Bundle query()
 * @method static \Illuminate\Database\Eloquent\Builder|Bundle whereBundleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bundle whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bundle whereFreeBonus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bundle whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bundle whereLifetimeAccess($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bundle whereOrderNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bundle whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bundle whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Bundle extends Model
{
    use HasFactory;
    use RevisionableTrait;

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'bundle_id');
    }

    protected $guarded = [
        'id'
    ];
}
