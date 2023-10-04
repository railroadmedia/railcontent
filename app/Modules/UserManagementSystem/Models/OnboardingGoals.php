<?php

namespace Modules\UserManagementSystem\Models;

use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Modules\UserManagementSystem\Models\OnboardingGoals
 *
 * @property int $id
 * @property int $user_id
 * @property string $brand
 * @property string $goals
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|OnboardingGoals newModelQuery()
 * @method static Builder|OnboardingGoals newQuery()
 * @method static Builder|OnboardingGoals query()
 * @method static Builder|OnboardingGoals whereId($value)
 * @method static Builder|OnboardingGoals whereBrand($value)
 * @method static Builder|OnboardingGoals whereGoals($value)
 * @method static Builder|OnboardingGoals whereUserId($value)
 * @method static Builder|OnboardingGoals whereCreatedAt($value)
 * @method static Builder|OnboardingGoals whereUpdatedAt($value)
 * @mixin Eloquent
 * @property-read User $user
 */
class OnboardingGoals extends Model
{

    protected $table = 'onboarding_goals';

    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [ 'goals', 'user_id', 'brand'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
