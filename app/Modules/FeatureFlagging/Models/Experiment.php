<?php

namespace App\Modules\FeatureFlagging\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Feature
 *
 * @property int $id
 * @property string $name
 * @property string $default_value
 * @property bool $enabled
 * @method static \Illuminate\Database\Eloquent\Builder|Experiment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Experiment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Experiment query()
 * @method static \Illuminate\Database\Eloquent\Builder|Experiment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Experiment whereName($value)

 * @mixin \Eloquent
 */
class Experiment extends Model
{
    protected $table = 'features_experiments';
    protected $guarded = [
        'id'
    ];

    public function branches(): HasMany
    {
        return $this->hasMany(Branch::class)->orderBy('priority');
    }
}
