<?php

namespace Modules\UserManagementSystem\Controllers;

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

    /**
     *
     * @param Request $request
     */
    public function gears(Request $request)
    {
        $request->validate(['data' => 'required']);
        $request->validate(['brand' => 'required']);

        OnboardingGear::where(['brand' => $request->brand, 'user_id' => user()->id])->delete();

        foreach ($request->data as $gear) {
            OnboardingGear::create(['gear' => $gear, 'brand' => $request->brand, 'user_id' => user()->id]);
            OnboardingAnswerHistory::create([
                'onboarding_question' => OnboardingAnswerHistory::QUESTION_GEAR,
                'onboarding_answer' => $gear,
                'brand' => $request->brand,
                'user_id' => user()->id
                ]);
        }

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

        foreach ($request->data as $topic) {
            OnboardingTopic::create(['topic' => $topic, 'brand' => $request->brand, 'user_id' => user()->id]);
            OnboardingAnswerHistory::create([
                'onboarding_question' => OnboardingAnswerHistory::QUESTION_TOPIC,
                'onboarding_answer' => $topic,
                'brand' => $request->brand,
                'user_id' => user()->id
            ]);
        }

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

        foreach ($request->data as $genre) {
            OnboardingGenre::create(['genre' => $genre, 'brand' => $request->brand, 'user_id' => user()->id]);
            OnboardingAnswerHistory::create([
                'onboarding_question' => OnboardingAnswerHistory::QUESTION_GENRE,
                'onboarding_answer' => $genre,
                'brand' => $request->brand,
                'user_id' => user()->id
            ]);
        }

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

        return response(json_encode(user()), 200);
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
            return response($message, 400);
        }

        OnboardingAnswerHistory::create([
            'onboarding_question' => OnboardingAnswerHistory::QUESTION_INSTRUMENT,
            'onboarding_answer' => $request->get('instrument'),
            'user_id' => user()->id
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
            $request->validate(['coach' => 'string|required|not-in:undefined']);
        } catch (ValidationException $e) {
            $message = ['error' => 'Get parameter coach is missing'];
            return response($message, 400);
        }

        OnboardingAnswerHistory::create([
            'onboarding_question' => OnboardingAnswerHistory::QUESTION_COACH,
            'onboarding_answer' => $request->get('coach'),
            'brand' => brand(),
            'user_id' => user()->id
        ]);
        return response("History data for coach has been saved.", 200);
    }

}
