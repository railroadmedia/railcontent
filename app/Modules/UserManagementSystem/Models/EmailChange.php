<?php

namespace Modules\UserManagementSystem\Models;

use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Modules\UserManagementSystem\Models\EmailChange
 *
 * @property int $id
 * @property int $user_id
 * @property string $email
 * @property string $token
 * @property string $brand
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|EmailChange newModelQuery()
 * @method static Builder|EmailChange newQuery()
 * @method static Builder|EmailChange query()
 * @method static Builder|EmailChange whereCreatedAt($value)
 * @method static Builder|EmailChange whereEmail($value)
 * @method static Builder|EmailChange whereId($value)
 * @method static Builder|EmailChange whereToken($value)
 * @method static Builder|EmailChange whereBrand($value)
 * @method static Builder|EmailChange whereUpdatedAt($value)
 * @method static Builder|EmailChange whereUserId($value)
 * @mixin Eloquent
 * @property-read User $user
 */
class EmailChange extends Model
{
    use HasFactory;
    protected $table = 'usora_email_changes';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
