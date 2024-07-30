<?php

namespace Modules\UserManagementSystem\Models;

use App\Modules\UserManagementSystem\Enums\OnboardingSkillLevelEnum;
use Barryvdh\LaravelIdeHelper\Eloquent;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Modules\UserManagementSystem\Models\OnboardingAnswerHistory
 *
 * @property int $id
 * @property int $user_id
 * @property string|null $brand
 * @property string $onboarding_question
 * @property string $onboarding_answer
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|OnboardingAnswerHistory newModelQuery()
 * @method static Builder|OnboardingAnswerHistory newQuery()
 * @method static Builder|OnboardingAnswerHistory query()
 * @method static Builder|OnboardingAnswerHistory whereId($value)
 * @method static Builder|OnboardingAnswerHistory whereBrand($value)
 * @method static Builder|OnboardingAnswerHistory whereOnboardingQuestion($value)
 * @method static Builder|OnboardingAnswerHistory whereOnboardingAnswer($value)
 * @method static Builder|OnboardingAnswerHistory whereUserId($value)
 * @method static Builder|OnboardingAnswerHistory whereCreatedAt($value)
 * @method static Builder|OnboardingAnswerHistory whereUpdatedAt($value)
 * @mixin Eloquent
 * @property-read User $user
 * @property string|null $coach_name
 * @method static Builder|OnboardingAnswerHistory whereCoachName($value)
 */
class OnboardingAnswerHistory extends Model
{
    use HasFactory;
    protected $table = 'onboarding_answer_history';

    /* we describe the question with only one term to help the data querying and data modelling process */
    public const QUESTION_GEAR = 'gear';
    public const QUESTION_TOPIC = 'topic';
    public const QUESTION_GENRE = 'genre';
    public const QUESTION_EXPERIENCE = 'experience';
    public const QUESTION_GOALS = 'goals';
    public const QUESTION_INSTRUMENT = 'instrument';
    public const QUESTION_COACH = 'coach';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'brand', 'onboarding_question', 'onboarding_answer', 'coach_name'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function setExperienceLevelAnswer(int $onboardingAnswer)
    {
        $this->onboarding_answer = OnboardingSkillLevelEnum::from($onboardingAnswer)->name;
    }
}
