<?php

namespace App\Modules\FeatureFlagging\Models;

use App\Modules\FeatureFlagging\Models\Feature;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Feature
 *
 * @property int $id
 * @property int $experiment_id
 * @property string $name
 * @property string $content
 * @property int $priority
 * @property string $allow_filter
 * @property int $weight
 * @property string $userid_list
 * @method static \Illuminate\Database\Eloquent\Builder|Branch newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Branch newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Branch query()
 * @method static \Illuminate\Database\Eloquent\Builder|Branch whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Branch whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Branch whereExperimentID($value)
 * @mixin \Eloquent
 */
class Branch extends Model
{
    protected $table = 'features_branches';
    public function experiment()
    {
        return $this->belongsTo(Experiment::class, 'experiment_id');
    }

    protected $guarded = [
        'id',
    ];
}
