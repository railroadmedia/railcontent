<?php

namespace Modules\UserManagementSystem\Models;

use Barryvdh\LaravelIdeHelper\Eloquent;
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
    const QUESTION_GEAR = 'gear';
    const QUESTION_TOPIC = 'topic';
    const QUESTION_GENRE = 'genre';
    const QUESTION_EXPERIENCE = 'experience';
    const QUESTION_INSTRUMENT = 'instrument';
    const QUESTION_COACH = 'coach';

    const EXPERIENCE_ONE = 'Level 1';
    const EXPERIENCE_TWO = 'Level 2-3';
    const EXPERIENCE_THREE = 'Level 4-6';
    const EXPERIENCE_FOUR = 'Level 7-10';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [ 'user_id', 'brand', 'onboarding_question', 'onboarding_answer', 'coach_name'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function setExperienceLevelAnswer(string $onboardingAnswer) {
        if ($onboardingAnswer == '0') {
            $this->onboarding_answer = self::EXPERIENCE_ONE;
        } elseif ($onboardingAnswer == '1') {
            $this->onboarding_answer = self::EXPERIENCE_TWO;
        } elseif ($onboardingAnswer == '2'){
            $this->onboarding_answer = self::EXPERIENCE_THREE;
        } elseif ($onboardingAnswer == '3') {
            $this->onboarding_answer = self::EXPERIENCE_FOUR;
        }
    }
}
