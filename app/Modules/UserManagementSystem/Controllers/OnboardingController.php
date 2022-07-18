<?php

namespace Modules\UserManagementSystem\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
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
        }

        return response(json_encode(user()), 200);
    }

    /**
     *
     * @param Request $request
     */
    public function experience(Request $request)
    {
        $request->validate(
            'brand' => 'required',
            ['experience_level' => 'integer|required|max:3']
        );

        OnboardingExperience::where(['brand' => $request->brand, 'user_id' => user()->id])->delete();
        OnboardingExperience::create(
            ['experience_level' => $request->experience_level, 'brand' => $request->brand, 'user_id' => user()->id]
        );

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


}
