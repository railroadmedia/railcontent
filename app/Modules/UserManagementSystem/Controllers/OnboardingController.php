<?php

namespace Modules\UserManagementSystem\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\UserManagementSystem\Models\OnboardingGear;

class OnboardingController extends Controller
{

    /**
     *
     * @param Request $request
     */
    public function updateGears(Request $request)
    {
        $request->validate(['data' => 'required']);

        $userGears = OnboardingGear::where([
            ['brand', '=', brand()],
            ['user_id', '=', user()->id]
        ])->get();

        foreach ($request->data as $gear) {
            $requestGears[] = $gear;
        }

        $deleteGearIds = [];
        foreach ($userGears as $oldGear) {
            if (in_array($oldGear->gear, $requestGears)) {
                unset($requestGears[array_search($oldGear->gear, $requestGears)]);
            } else {
                $deleteGearIds[] = $oldGear->id;
            }
        }


        foreach ($requestGears as $newGear) {
            OnboardingGear::create(['gear' => $newGear, 'brand' => brand(), 'user_id' => user()->id]);
        }
        OnboardingGear::whereIn('id', $deleteGearIds)->delete();


        return response('done', 200);
    }

    /**
     *
     * @param Request $request
     */
    public function readGears(Request $request)
    {
        $selectedGears = OnboardingGear::where([
            ['brand', '=', brand()],
            ['user_id', '=', user()->id]
        ])->get();

        $allGears = config('user_management_system.onboarding.') . brand() . ('gears');

        return json_encode(
            array(
                "selected" => json_encode($selectedGears),
                "all" => json_encode($allGears)
            )
        );
    }


}
