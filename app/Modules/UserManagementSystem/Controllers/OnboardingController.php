<?php

namespace Modules\UserManagementSystem\Controllers;

use App\Modules\UserManagementSystem\Services\OnboardingService;
use Avo;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Validation\ValidationException;
use Modules\UserManagementSystem\Models\OnboardingAnswerHistory;
use Modules\UserManagementSystem\Models\OnboardingExperience;
use Modules\UserManagementSystem\Models\OnboardingGear;
use Modules\UserManagementSystem\Models\OnboardingTopic;
use Modules\UserManagementSystem\Models\OnboardingGenre;


class OnboardingController extends Controller
{

    private OnboardingService $onboardingService;

    public function __construct(OnboardingService $onboardingService)
    {
        $this->onboardingService = $onboardingService;
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
        Avo::gear_onboarding_step_completed([
            'user_id_' => userIdString(),
            'musora_user_id' => userId(),
            'brand' => $request->brand,
            'is_skipped' => false,
            'gear_list' => $gearList
        ]);

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

        Avo::topics_onboarding_step_completed([
            'user_id_' => userIdString(),
            'musora_user_id' => userId(),
            'brand' => $request->brand,
            'is_skipped' => false,
            'topic_list' => $topicList
        ]);
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

        Avo::genres_onboarding_step_completed([
            'user_id_' => userIdString(),
            'musora_user_id' => userId(),
            'brand' => $request->brand,
            'is_skipped' => false,
            'genre_list' => $genres
        ]);
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


        Avo::experience_onboarding_step_completed([
            'user_id_' => userIdString(),
            'musora_user_id' => userId(),
            'brand' => $request->brand,
            'is_skipped' => false,
            'experience_level' => strval($request->experience_level)
        ]);

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
            'genres' => OnboardingGenre::where(['brand' => $brand, 'user_id' => user()->id])->pluck('genre')->toArray(),
            'topics' => OnboardingTopic::where(['brand' => $brand, 'user_id' => user()->id])->pluck('topic')->toArray(),
        ];

        return response($response, 200);
    }

    /**
     *
     * @param Request $request
     */
    public function skipAccountSetup(Request $request)
    {
        $request->validate([
            'skip' => 'boolean|required',
            'brand' => 'required'
        ]);

        $userAttribute = $request->get('brand') . '_onboarding_skip_setup';
        user()->{$userAttribute} = $request->get('skip');
        user()->save();

        return response(json_encode(user()), 200);
    }

    /**
     *
     * @param Request $request
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
        Avo::instrument_onboarding_step_completed([
            'user_id_' => userIdString(),
            'musora_user_id' => userId(),
            'brand' => $this->onboardingService->getBrandFromInstrument($instrument)
        ]);

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
