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
    protected $table = 'onboarding_gears';

    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [ 'gear'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
