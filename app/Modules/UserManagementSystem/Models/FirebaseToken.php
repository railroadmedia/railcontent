<?php

namespace Modules\UserManagementSystem\Models;

use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Modules\UserManagementSystem\Models\FirebaseToken
 *
 * @property int $id
 * @property int $user_id
 * @property string $type
 * @property string|null $token
 * @property string $brand
 * @property Carbon|null $created_at
 * @method static Builder|FirebaseToken newModelQuery()
 * @method static Builder|FirebaseToken newQuery()
 * @method static Builder|FirebaseToken query()
 * @method static Builder|FirebaseToken whereBrand($value)
 * @method static Builder|FirebaseToken whereCreatedAt($value)
 * @method static Builder|FirebaseToken whereId($value)
 * @method static Builder|FirebaseToken whereToken($value)
 * @method static Builder|FirebaseToken whereType($value)
 * @method static Builder|FirebaseToken whereUserId($value)
 * @mixin Eloquent
 * @property-read User $user
 */
class FirebaseToken extends Model
{
    use HasFactory;
    protected $table = 'usora_user_firebase_tokens';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [ 'type','token', 'user_id', 'brand'];
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
