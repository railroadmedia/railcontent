<?php

namespace Modules\UserManagementSystem\Controllers;

use App\Modules\EventTracking\Avo\AvoHelper;
use App\Modules\UserManagementSystem\Services\OnboardingService;
use Avo;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Validation\ValidationException;
use Modules\UserManagementSystem\Models\OnboardingAnswerHistory;
use Modules\UserManagementSystem\Models\OnboardingExperience;
use Modules\UserManagementSystem\Models\OnboardingGoals;
use Modules\UserManagementSystem\Models\OnboardingGear;
use Modules\UserManagementSystem\Models\OnboardingTopic;
use Modules\UserManagementSystem\Models\OnboardingGenre;


class OnboardingController extends Controller
{

    private OnboardingService $onboardingService;

    public function __construct(OnboardingService $onboardingService)
    {
        $this->onboardingService = $onboardingService;
        $this->middleware('deprecated:2023-10-16');
    }

    /**
     *
     * @param Request $request
     */
    public function gears(Request $request)
    {
        $request->validate(['data' => 'required']);
        $request->validate(['brand' => 'required']);

        OnboardingGear::where(['brand' => $request->brand, 'user_id' => user()->id])->delete();

        $gearList = [];
        foreach ($request->data as $gear) {
            OnboardingGear::create(['gear' => $gear, 'brand' => $request->brand, 'user_id' => user()->id]);
            OnboardingAnswerHistory::create([
                'onboarding_question' => OnboardingAnswerHistory::QUESTION_GEAR,
                'onboarding_answer' => $gear,
                'brand' => $request->brand,
                'user_id' => user()->id
            ]);
            $gearList[] = $gear;
        }
        Avo::onboarding_gear_step_completed(
            AvoHelper::defaultEventProperties([
                'brand' => $request->brand,
                'gear_list' => $gearList,
            ])
        );

        return response(json_encode(user()), 200);
    }

    /**
     *
     * @param Request $request
     */
    public function topics(Request $request)
    {
        $request->validate([
            'brand' => 'required',
            'data' => 'required'
        ]);

        OnboardingTopic::where(['brand' => $request->brand, 'user_id' => user()->id])->delete();

        $topicList = [];
        foreach ($request->data as $topic) {
            OnboardingTopic::create(['topic' => $topic, 'brand' => $request->brand, 'user_id' => user()->id]);
            OnboardingAnswerHistory::create([
                'onboarding_question' => OnboardingAnswerHistory::QUESTION_TOPIC,
                'onboarding_answer' => $topic,
                'brand' => $request->brand,
                'user_id' => user()->id
            ]);
            $topicList[] = $topic;
        }

        Avo::onboarding_topics_step_completed(
            AvoHelper::defaultEventProperties([
                'brand' => $request->brand,
                'topic_list' => $topicList,
            ])
        );
        return response(json_encode(user()), 200);
    }

    /**
     *
     * @param Request $request
     */
    public function genres(Request $request)
    {
        $request->validate([
            'brand' => 'required',
            'data' => 'required'
        ]);

        OnboardingGenre::where(['brand' => $request->brand, 'user_id' => user()->id])->delete();
        $genres = [];
        foreach ($request->data as $genre) {
            OnboardingGenre::create(['genre' => $genre, 'brand' => $request->brand, 'user_id' => user()->id]);
            OnboardingAnswerHistory::create([
                'onboarding_question' => OnboardingAnswerHistory::QUESTION_GENRE,
                'onboarding_answer' => $genre,
                'brand' => $request->brand,
                'user_id' => user()->id
            ]);
            $genres[] = $genre;
        }

        Avo::onboarding_genres_step_completed(
            AvoHelper::defaultEventProperties([
                'brand' => $request->brand,
                'genre_list' => $genres,
            ])
        );
        return response(json_encode(user()), 200);
    }

    /**
     *
     * @param Request $request
     */
    public function experience(Request $request)
    {
        $request->validate([
            'experience_level' => 'integer|required|max:3',
            'brand' => 'required',
        ]);

        OnboardingExperience::where(['brand' => $request->brand, 'user_id' => user()->id])->delete();
        OnboardingExperience::create(
            ['experience_level' => $request->experience_level, 'brand' => $request->brand, 'user_id' => user()->id]
        );

        $onboardingAnswerHistory = new OnboardingAnswerHistory;
        $onboardingAnswerHistory->onboarding_question = OnboardingAnswerHistory::QUESTION_EXPERIENCE;
        $onboardingAnswerHistory->setExperienceLevelAnswer($request->experience_level);
        $onboardingAnswerHistory->brand = $request->brand;
        $onboardingAnswerHistory->user_id = user()->id;
        $onboardingAnswerHistory->save();


        Avo::onboarding_experience_step_completed(
            AvoHelper::defaultEventProperties([
                'brand' => $request->brand,
                'experience_level' => strval($request->experience_level),
            ])
        );

        return response(json_encode(user()), 200);
    }

    /**
     *
     * @param Request $request
     */
    public function goals(Request $request)
    {
        $request->validate([
            'goals' => 'required',
            'brand' => 'required',
        ]);

        OnboardingGoals::where(['brand' => $request->brand, 'user_id' => user()->id])->delete();
        OnboardingGoals::create(
            ['goals' => $request->goals, 'brand' => $request->brand, 'user_id' => user()->id]
        );

        $onboardingAnswerHistory = new OnboardingAnswerHistory();
        $onboardingAnswerHistory->onboarding_question = OnboardingAnswerHistory::QUESTION_GOALS;
        $onboardingAnswerHistory->onboarding_answer = $request->goals;
        $onboardingAnswerHistory->brand = $request->brand;
        $onboardingAnswerHistory->user_id = user()->id;
        $onboardingAnswerHistory->save();

        Avo::onboarding_goals_step_completed(
            AvoHelper::defaultEventProperties([
                'brand' => $request->brand,
                'goals_list' => [$request->goals],
                'has_completed_onboarding' => true,
            ])
        );

        return response(json_encode(user()), 200);
    }

    /**
     *
     * @param Request $request
     */
    public function getUserOnboardingInformation(Request $request)
    {
        try {
            $request->validate(['brand' => 'string|required']);
        } catch (ValidationException $e) {
            $message = ['error' => 'Get parameter brand is invalid.'];
            return response($message, 422);
        }

        $brand = $request->brand;
        $experience = OnboardingExperience::select('experience_level')->where(
            ['brand' => $brand, 'user_id' => user()->id]
        )->first();

        $response = [
            'gears' => OnboardingGear::where(['brand' => $brand, 'user_id' => user()->id])->pluck('gear')->toArray(),
            'experience' => $experience ? intval($experience->experience_level) : $experience,
            'goals' => OnboardingGoals::select('goals')->where(['brand' => $brand, 'user_id' => user()->id])->first(),
            'genres' => OnboardingGenre::where(['brand' => $brand, 'user_id' => user()->id])->pluck('genre')->toArray(),
            'topics' => OnboardingTopic::where(['brand' => $brand, 'user_id' => user()->id])->pluck('topic')->toArray(),
        ];

        return response($response, 200);
    }

    public function aboutStepCompleted(Request $request)
    {
        $request->validate([
            'skipped' => 'required'
        ]);

        Avo::onboarding_about_step_completed(
            AvoHelper::defaultEventProperties([
                'is_skipped' => $request->get('skipped'),
            ])
        );

        return response(null, 200);
    }

    /**
     *
     * @param Request $request
     */
    public function skipAccountSetup(Request $request)
    {
        $request->validate([
            'brand' => 'required',
            'skippedStep' => 'required'
        ]);

        $userAttribute = $request->get('brand') . '_onboarding_skip_setup';
        user()->{$userAttribute} = true;
        user()->save();

        Avo::onboarding_skipped(
            AvoHelper::defaultEventProperties([
                'step_skipped' => strtolower($request->get('skippedStep')),
                'brand' => $request->get('brand'),
            ])
        );

        return response(json_encode(user()), 200);
    }

    /**
     *
     * @param Request $request
     * @throws \Exception
     */
    public function saveOnboardingHistoryForInstrument(Request $request)
    {
        try {
            $request->validate(['instrument' => 'string|required|not-in:undefined']);
        } catch (ValidationException $e) {
            $message = ['error' => 'Get parameter instrument is missing'];
            return response($message, 422);
        }
        $instrument = $request->get('instrument');
        $this->onboardingService->saveInstrument($instrument);
        Avo::onboarding_instrument_step_completed(
            AvoHelper::defaultEventProperties([
                'brand' => $this->onboardingService->getBrandFromInstrument($instrument),
            ])
        );

        return response("History data for instrument has been saved.", 200);
    }

    /**
     *
     * @param Request $request
     */
    public function saveOnboardingHistoryForCoach(Request $request)
    {
        try {
            $request->validate(['coachName' => 'string|required|not-in:undefined']);
            $request->validate(['coachId' => 'integer|required|not-in:undefined']);
        } catch (ValidationException $e) {
            $message = ['error' => 'Get parameter is missing from onboarding-answer-history-coach api request.'];
            return response($message, 422);
        }

        OnboardingAnswerHistory::create([
            'onboarding_question' => OnboardingAnswerHistory::QUESTION_COACH,
            'onboarding_answer' => $request->get('coachId'),
            'coach_name' => $request->get('coachName'),
            'brand' => brand(),
            'user_id' => user()->id
        ]);
        return response("History data for coach has been saved.", 200);
    }

}
