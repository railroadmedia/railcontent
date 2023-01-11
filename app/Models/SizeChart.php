<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Venturecraft\Revisionable\RevisionableTrait;

/**
 * App\Models\SizeChart
 *
 * @property int $id
 * @property string $chart
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Venturecraft\Revisionable\Revision[] $revisionHistory
 * @property-read int|null $revision_history_count
 * @method static \Illuminate\Database\Eloquent\Builder|SizeChart newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SizeChart newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SizeChart query()
 * @method static \Illuminate\Database\Eloquent\Builder|SizeChart whereChart($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SizeChart whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SizeChart whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SizeChart whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class SizeChart extends Model
{
    use HasFactory;
    use RevisionableTrait;

    protected $guarded = [
        'id'
    ];
}
