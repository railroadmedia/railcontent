<?php

namespace Modules\UserManagementSystem\Models;

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
 * @property int $blocker_id
 * @property Carbon|null $created_at
 * @method static Builder|ReportedUser newModelQuery()
 * @method static Builder|ReportedUser newQuery()
 * @method static Builder|ReportedUser query()
 * @method static Builder|ReportedUser whereCreatedAt($value)
 * @method static Builder|ReportedUser whereId($value)
 * @method static Builder|ReportedUser whereUserId($value)
 * @method static Builder|ReportedUser whereBlockerId($value)
 * @mixin Eloquent
 * @property-read User $user
 */
class BlockedUser extends Model
{
    use HasFactory;
    protected $table = 'usora_blocked_users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'blocker_id','created_on'];
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function blocker()
    {
        return $this->belongsTo(User::class, 'blocker_id');
    }
}
