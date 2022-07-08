<?php

namespace Modules\UserManagementSystem\Models;


use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;


/**
* App\Modules\UserManagementSystem\Models\OnboardingGenre
*
* @property int $id
* @property int $user_id
* @property string $brand
* @property string $genre
* @property Carbon|null $created_at
* @property Carbon|null $updated_at
* @method static Builder|OnboardingGenre newModelQuery()
* @method static Builder|OnboardingGenre newQuery()
* @method static Builder|OnboardingGenre query()
* @method static Builder|OnboardingGenre whereId($value)
* @method static Builder|OnboardingGenre whereBrand($value)
* @method static Builder|OnboardingGenre whereGenre($value)
* @method static Builder|OnboardingGenre whereUserId($value)
* @method static Builder|OnboardingGenre whereCreatedAt($value)
* @method static Builder|OnboardingGenre whereUpdatedAt($value)
* @mixin Eloquent
* @property-read User $user
*/
class OnboardingGenre extends Model
{

    protected $table = 'onboarding_genres';

    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [ 'genre', 'user_id', 'brand'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
