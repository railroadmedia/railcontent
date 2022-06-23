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

        OnboardingGear::where(['brand' => brand(), 'user_id' => user()->id])->delete();

        foreach ($request->data as $gear) {
            OnboardingGear::create(['gear' => $gear, 'brand' => brand(), 'user_id' => user()->id]);
        }

        return response(json_encode(user()), 200);
    }

    /**
     *
     * @param Request $request
     */
    public function topics(Request $request)
    {
        $request->validate(['data' => 'required']);

        OnboardingTopic::where(['brand' => brand(), 'user_id' => user()->id])->delete();

        foreach ($request->data as $topic) {
            OnboardingTopic::create(['topic' => $topic, 'brand' => brand(), 'user_id' => user()->id]);
        }

        return response(json_encode(user()), 200);
    }

    /**
     *
     * @param Request $request
     */
    public function genres(Request $request)
    {
        $request->validate(['data' => 'required']);

        OnboardingGenre::where(['brand' => brand(), 'user_id' => user()->id])->delete();

        foreach ($request->data as $genre) {
            OnboardingGenre::create(['genre' => $genre, 'brand' => brand(), 'user_id' => user()->id]);
        }

        return response(json_encode(user()), 200);
    }

    /**
     *
     * @param Request $request
     */
    public function experience(Request $request)
    {
        $request->validate(['experience_level' => 'integer|required|max:3']);

        OnboardingExperience::where(['brand' => brand(), 'user_id' => user()->id])->delete();
        OnboardingExperience::create(
            ['experience_level' => $request->experience_level, 'brand' => brand(), 'user_id' => user()->id]
        );

        return response(json_encode(user()), 200);
    }


}
