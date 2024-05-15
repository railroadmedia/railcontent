<?php

namespace App\Modules\FeatureFlagging\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Feature
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $allow_filter
 * @property string $block_filter
 * @property string $userid_list
 * @property \Illuminate\Support\Carbon|null $active_at
 * @method static \Illuminate\Database\Eloquent\Builder|Feature newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Feature newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Feature query()
 * @method static \Illuminate\Database\Eloquent\Builder|Feature whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Feature whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Feature whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Feature whereActiveAt($value)

 * @mixin \Eloquent
 */
class Feature extends Model
{
    protected $table = 'features_features';
    protected $guarded = [
        'id',
    ];
}
