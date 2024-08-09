<?php

namespace Modules\UserManagementSystem\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Modules\UserManagementSystem\Models\RememberToken
 *
 * @property int $id
 * @property int $user_id
 * @property string $token
 * @property string $device_information
 * @property string $expires_at
 * @property Carbon $created_at
 * @method static Builder|RememberToken newModelQuery()
 * @method static Builder|RememberToken newQuery()
 * @method static Builder|RememberToken query()
 * @method static Builder|RememberToken whereCreatedAt($value)
 * @method static Builder|RememberToken whereDeviceInformation($value)
 * @method static Builder|RememberToken whereExpiresAt($value)
 * @method static Builder|RememberToken whereId($value)
 * @method static Builder|RememberToken whereToken($value)
 * @method static Builder|RememberToken whereUserId($value)
 * @mixin Eloquent
 * @property-read User $user
 * @property Carbon|null $updated_at
 * @method static Builder|RememberToken whereUpdatedAt($value)
 */
class RememberToken extends Model
{
    use HasFactory;
    protected $table = 'usora_remember_tokens';

    protected $casts = [
        'expires_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
