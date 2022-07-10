<?php

namespace Modules\UserManagementSystem\Models;


use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;


/**
 * App\Modules\UserManagementSystem\Models\OnboardingTopic
 *
 * @property int $id
 * @property int $user_id
 * @property string $brand
 * @property string $topic
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|OnboardingTopic newModelQuery()
 * @method static Builder|OnboardingTopic newQuery()
 * @method static Builder|OnboardingTopic query()
 * @method static Builder|OnboardingTopic whereId($value)
 * @method static Builder|OnboardingTopic whereBrand($value)
 * @method static Builder|OnboardingTopic whereTopic($value)
 * @method static Builder|OnboardingTopic whereUserId($value)
 * @method static Builder|OnboardingTopic whereCreatedAt($value)
 * @method static Builder|OnboardingTopic whereUpdatedAt($value)
 * @mixin Eloquent
 * @property-read User $user
 */
class OnboardingTopic extends Model
{

    protected $table = 'onboarding_topics';

    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [ 'topic', 'user_id', 'brand'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
