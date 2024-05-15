<?php

namespace Modules\UserManagementSystem\Models;

use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Modules\UserManagementSystem\Models\OnboardingExperience
 *
 * @property int $id
 * @property int $user_id
 * @property string $brand
 * @property string $experience_level
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|OnboardingExperience newModelQuery()
 * @method static Builder|OnboardingExperience newQuery()
 * @method static Builder|OnboardingExperience query()
 * @method static Builder|OnboardingExperience whereId($value)
 * @method static Builder|OnboardingExperience whereBrand($value)
 * @method static Builder|OnboardingExperience whereExperienceLevel($value)
 * @method static Builder|OnboardingExperience whereUserId($value)
 * @method static Builder|OnboardingExperience whereCreatedAt($value)
 * @method static Builder|OnboardingExperience whereUpdatedAt($value)
 * @mixin Eloquent
 * @property-read User $user
 */
class OnboardingExperience extends Model
{
    use HasFactory;

    protected $table = 'onboarding_experience';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [ 'experience_level', 'user_id', 'brand'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
