<?php

namespace Modules\UserManagementSystem\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Modules\UserManagementSystem\Models\ReportedUser
 *
 * @property int $id
 * @property int $user_id
 * @property int $reported_id
 * @property Carbon|null $created_at
 * @method static Builder|ReportedUser newModelQuery()
 * @method static Builder|ReportedUser newQuery()
 * @method static Builder|ReportedUser query()
 * @method static Builder|ReportedUser whereCreatedAt($value)
 * @method static Builder|ReportedUser whereId($value)
 * @method static Builder|ReportedUser whereUserId($value)
 * @method static Builder|ReportedUser whereReporterId($value)
 * @mixin Eloquent
 * @property-read User $user
 */
class ReportedUser extends Model
{
    use HasFactory;
    protected $table = 'usora_reported_users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'reporter_id','created_on'];
    public $timestamps = false;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function reporter(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reporter_id');
    }
}
