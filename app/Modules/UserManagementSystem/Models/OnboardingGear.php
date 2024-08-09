<?php

namespace Modules\UserManagementSystem\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Modules\UserManagementSystem\Models\OnboardingGear
 *
 * @property int $id
 * @property int $user_id
 * @property string $brand
 * @property string $gear
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|OnboardingGear newModelQuery()
 * @method static Builder|OnboardingGear newQuery()
 * @method static Builder|OnboardingGear query()
 * @method static Builder|OnboardingGear whereId($value)
 * @method static Builder|OnboardingGear whereBrand($value)
 * @method static Builder|OnboardingGear whereGear($value)
 * @method static Builder|OnboardingGear whereUserId($value)
 * @method static Builder|OnboardingGear whereCreatedAt($value)
 * @method static Builder|OnboardingGear whereUpdatedAt($value)
 * @mixin Eloquent
 * @property-read User $user
 */
class OnboardingGear extends Model
{
    use HasFactory;
    protected $table = 'onboarding_gears';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [ 'gear', 'user_id', 'brand'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
