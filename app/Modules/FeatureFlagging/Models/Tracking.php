<?php

namespace App\Modules\FeatureFlagging\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Feature
 *
 * @property int $id
 * @property int $branch_id
 * @property ?int $user_id
 * @property int $experiment_id
 * @property ?string $anonymous_user_id
 * @method static \Illuminate\Database\Eloquent\Builder|Tracking newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tracking newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tracking query()
 * @method static \Illuminate\Database\Eloquent\Builder|Tracking whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tracking whereBranchID($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tracking whereUserID($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tracking whereExperimentID($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tracking whereAnonymousUserID($value)
 * @mixin \Eloquent
 */
class Tracking extends Model
{
    protected $table = 'features_tracking';

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }

    public function experiment()
    {
        return $this->belongsTo(Experiment::class, 'experiment_id');
    }

    protected $guarded = [
        'id'
    ];
}
