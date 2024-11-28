<?php

namespace App\Modules\MusoraApi\Controllers\V1;

use App\Modules\EventDataSynchronizer\Jobs\CustomerIoSyncUserByUserId;
use App\Modules\EventTracking\Avo\AvoHelper;
use App\Modules\UserManagementSystem\Enums\OnboardingSkillLevelEnum;
use App\Modules\UserManagementSystem\Jobs\SetDefaultPlaylistsJob;
use App\Modules\UserManagementSystem\Services\OnboardingService;
use Avo;
use Carbon\Carbon;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Routing\ResponseFactory;
use Illuminate\Validation\ValidationException;
use Modules\UserManagementSystem\Models\OnboardingAnswerHistory;
use Modules\UserManagementSystem\Models\OnboardingExperience;
use Modules\UserManagementSystem\Models\OnboardingGear;
use Modules\UserManagementSystem\Models\OnboardingGenre;
use Modules\UserManagementSystem\Models\OnboardingGoals;
use Modules\UserManagementSystem\Models\OnboardingTopic;

class OnboardingController extends Controller
{
    private OnboardingService $onboardingService;

    public function __construct(OnboardingService $onboardingService)
    {
        $this->onboardingService = $onboardingService;
    }

    /**
     * @return Response|Application|ResponseFactory
     */
    public function onboardingStarted(Request $request): Response|Application|ResponseFactory
    {
        Avo::onboarding_started(AvoHelper::defaultEventProperties());
        return response(null, 200);
    }

    /**
     *
     * @return Response|Application|ResponseFactory
     */
    public function gears(Request $request): Response|Application|ResponseFactory
    {
        ['data' => $data, 'brand' => $brand] = $request->validate(['data' => 'required', 'brand' => 'required']);

        OnboardingGear::where(['brand' => $brand, 'user_id' => user()->id])
            ->delete();

        $gearList = [];

        foreach ($data as $gear) {
            OnboardingGear::create(['gear' => $gear, 'brand' => $brand, 'user_id' => user()->id]);
            OnboardingAnswerHistory::create([
                'onboarding_question' => OnboardingAnswerHistory::QUESTION_GEAR,
                'onboarding_answer' => $gear,
                'brand' => $brand,
                'user_id' => user()->id,
            ]);
            $gearList[] = $gear;
        }
        Avo::onboarding_gear_step_completed(
            AvoHelper::defaultEventProperties([
                'brand' => $brand,
                'gear_list' => $gearList,
            ])
        );

        return response(json_encode(user()), 200);
    }

    /**
     *
     * @return Response|Application|ResponseFactory
     */
    public function topics(Request $request): Response|Application|ResponseFactory
    {
        ['data' => $data, 'brand' => $brand] = $request->validate([
            'brand' => 'required',
            'data' => 'required',
        ]);

        OnboardingTopic::where(['brand' => $brand, 'user_id' => user()->id])
            ->delete();

        $topics = [];
        foreach ($data as $topic) {
            $onboardingTopic = new OnboardingTopic(['topic' => $topic, 'brand' => $brand, 'user_id' => user()->id]);
            $onboardingTopic->save();
            $onboardingAnswerHistory = new OnboardingAnswerHistory([
                'onboarding_question' => OnboardingAnswerHistory::QUESTION_TOPIC,
                'onboarding_answer' => $topic,
                'brand' => $brand,
                'user_id' => user()->id,
            ]);
            $onboardingAnswerHistory->save();
            $topics[] = $topic;
        }

        dispatchWithDelay(
            new CustomerIoSyncUserByUserId(
                user(),
                [
                    $brand . '_onboarding_topics' => $topics,
                ]
            ),
            30
        );

        Avo::onboarding_topics_step_completed(
            AvoHelper::defaultEventProperties([
                'brand' => $brand,
                'topic_list' => $topics,
            ])
        );
        return response(json_encode(user()), 200);
    }

    /**
     *
     * @return Response|Application|ResponseFactory
     */
    public function genres(Request $request): Response|Application|ResponseFactory
    {
        ['data' => $data, 'brand' => $brand] = $request->validate([
            'brand' => 'required',
            'data' => 'required',
        ]);

        OnboardingGenre::where(['brand' => $brand, 'user_id' => user()->id])
            ->delete();
        $genres = [];
        foreach ($data as $genre) {
            OnboardingGenre::create(['genre' => $genre, 'brand' => $brand, 'user_id' => user()->id]);
            OnboardingAnswerHistory::create([
                'onboarding_question' => OnboardingAnswerHistory::QUESTION_GENRE,
                'onboarding_answer' => $genre,
                'brand' => $brand,
                'user_id' => user()->id,
            ]);
            $genres[] = $genre;
        }

        dispatchWithDelay(
            new CustomerIoSyncUserByUserId(
                user(),
                [
                    $brand . '_onboarding_genres' => $genres,
                ]
            ),
            30
        );

        Avo::onboarding_genres_step_completed(
            AvoHelper::defaultEventProperties([
                'brand' => $brand,
                'genre_list' => $genres,
            ])
        );
        return response(json_encode(user()), 200);
    }

    /**
     *
     * @return Response|Application|ResponseFactory
     * @throws \Throwable
     */
    public function experience(Request $request): Response|Application|ResponseFactory
    {
        ['experience_level' => $experienceLevel, 'brand' => $brand] = $request->validate([
            'experience_level' => 'integer|required|max:4',
            'brand' => 'required',
        ]);

        $user = user();

        $hasAnsweredBefore = OnboardingExperience::where([
            'brand' => $brand,
            'user_id' => $user->id,
        ])->exists();

        OnboardingExperience::where(['brand' => $brand, 'user_id' => $user->id])
            ->delete();

        OnboardingExperience::create(
            ['experience_level' => $experienceLevel, 'brand' => $brand, 'user_id' => $user->id]
        );

        $skillLevel = OnboardingSkillLevelEnum::from($experienceLevel);

        $onboardingAnswerHistory = new OnboardingAnswerHistory();
        $onboardingAnswerHistory->onboarding_question = OnboardingAnswerHistory::QUESTION_EXPERIENCE;
        $onboardingAnswerHistory->onboarding_answer = $skillLevel->name;
        $onboardingAnswerHistory->brand = $brand;
        $onboardingAnswerHistory->user_id = $user->id;
        $onboardingAnswerHistory->save();

        dispatchWithDelay(
            new CustomerIoSyncUserByUserId(
                $user,
                [$brand . '_onboarding_skill_level' => $skillLevel->name],
            ),
            30
        );

        if (!$hasAnsweredBefore) {
            SetDefaultPlaylistsJob::dispatchAfterResponse($user, $brand, $skillLevel);
        }

        Avo::onboarding_experience_step_completed(
            AvoHelper::defaultEventProperties([
                'brand' => $brand,
                'experience_level' => strval($experienceLevel),
            ])
        );

        return response(json_encode(user()), 200);
    }

    /**
     *
     * @return Response|Application|ResponseFactory
     * @throws \Throwable
     */
    public function goals(Request $request): Response|Application|ResponseFactory
    {
        ['goals' => $goals, 'brand' => $brand] = $request->validate([
            'goals' => 'required',
            'brand' => 'required',
        ]);

        OnboardingGoals::where(['brand' => $brand, 'user_id' => user()->id])
            ->delete();
        OnboardingGoals::create(
            ['goals' => $goals, 'brand' => $brand, 'user_id' => user()->id]
        );

        $onboardingAnswerHistory = new OnboardingAnswerHistory();
        $onboardingAnswerHistory->onboarding_question = OnboardingAnswerHistory::QUESTION_GOALS;
        $onboardingAnswerHistory->onboarding_answer = $goals;
        $onboardingAnswerHistory->brand = $brand;
        $onboardingAnswerHistory->user_id = user()->id;
        $onboardingAnswerHistory->save();

        dispatch(
            (new CustomerIoSyncUserByUserId(
                user(),
                [
                    $brand . '_onboarding_goal' => $goals,
                    'has_completed_onboarding' => true
                ]
            ))->delay(
                Carbon::now()
                    ->addSeconds(30)
            )
        );


        Avo::onboarding_goals_step_completed(
            AvoHelper::defaultEventProperties([
                'brand' => $brand,
                'goals_list' => [$goals],
                'has_completed_onboarding' => true,
            ])
        );

        return response(json_encode(user()), 200);
    }

    /**
     *
     * @return Response|Application|ResponseFactory
     */
    public function getUserOnboardingInformation(Request $request): Response|Application|ResponseFactory
    {
        try {
            ['brand' => $brand] = $request->validate(['brand' => 'string|required']);
        } catch (ValidationException) {
            $message = ['error' => 'Get parameter brand is invalid.'];
            return response($message, 422);
        }

        $experience =
            OnboardingExperience::query()
            ->select('experience_level')
            ->where(['brand' => $brand, 'user_id' => user()->id])
            ->first();

        $response = [
            'gears' => OnboardingGear::query()
                ->where(['brand' => $brand, 'user_id' => user()->id])
                ->pluck('gear')
                ->toArray(),
            'experience' => $experience ? intval($experience->experience_level) : $experience,
            'goals' => OnboardingGoals::query()
                ->select('goals')
                ->where(['brand' => $brand, 'user_id' => user()->id])
                ->first(),
            'genres' => OnboardingGenre::query()
                ->where(['brand' => $brand, 'user_id' => user()->id])
                ->pluck('genre')
                ->toArray(),
            'topics' => OnboardingTopic::query()
                ->where(['brand' => $brand, 'user_id' => user()->id])
                ->pluck('topic')
                ->toArray(),
        ];

        return response($response, 200);
    }

    /**
     * @return Response|Application|ResponseFactory
     */
    public function aboutStepCompleted(Request $request): Response|Application|ResponseFactory
    {
        $request->validate([
            'skipped' => 'required',
        ]);

        Avo::onboarding_about_step_completed(
            AvoHelper::defaultEventProperties([
                'is_skipped' => $request->get('skipped')
            ])
        );

        return response(null, 200);
    }

    /**
     *
     * @return Response|Application|ResponseFactory
     */
    public function skipAccountSetup(Request $request): Response|Application|ResponseFactory
    {
        ['brand' => $brand, 'skippedStep' => $skippedStep] = $request->validate([
            'brand' => 'required',
            'skippedStep' => 'required',
        ]);

        $userAttribute = $brand . '_onboarding_skip_setup';
        user()->{$userAttribute} = true;
        user()->save();

        Avo::onboarding_skipped(
            AvoHelper::defaultEventProperties([
                'step_skipped' => strtolower($skippedStep),
                'brand' => $brand
            ])
        );

        return response(json_encode(user()), 200);
    }

    /**
     *
     * @return Response|Application|ResponseFactory
     * @throws Exception
     */
    public function saveOnboardingHistoryForInstrument(Request $request): Response|Application|ResponseFactory
    {
        try {
            $request->validate(['instrument' => 'string|required|not-in:undefined']);
        } catch (ValidationException) {
            $message = ['error' => 'Get parameter instrument is missing'];
            return response($message, 422);
        }
        $instrument = $request->get('instrument');
        $this->onboardingService->saveInstrument($instrument);

        $brand = $this->onboardingService->getBrandFromInstrument($instrument);

        Avo::onboarding_instrument_step_completed(
            AvoHelper::defaultEventProperties([
                'brand' => $brand

            ])
        );

        $user = user();
        $user->primary_brand = $brand;
        $user->last_used_brand = $brand;
        $user->save();

        dispatchWithDelay(new CustomerIoSyncUserByUserId($user, ['primary_brand' => $brand]), 3);

        return response("History data for instrument has been saved.", 200);
    }

    /**
     *
     * @return Response|Application|ResponseFactory
     */
    public function saveOnboardingHistoryForCoach(Request $request): Response|Application|ResponseFactory
    {
        try {
            $request->validate(['coachName' => 'string|required|not-in:undefined']);
            $request->validate(['coachId' => 'integer|required|not-in:undefined']);
        } catch (ValidationException) {
            $message = ['error' => 'Get parameter is missing from onboarding-answer-history-coach api request.'];
            return response($message, 422);
        }

        OnboardingAnswerHistory::create([
            'onboarding_question' => OnboardingAnswerHistory::QUESTION_COACH,
            'onboarding_answer' => $request->get('coachId'),
            'coach_name' => $request->get('coachName'),
            'brand' => brand(),
            'user_id' => user()->id,
        ]);
        return response("History data for coach has been saved.", 200);
    }
}
