<?php

namespace App\Modules\MusoraApi\Controllers\V5;

use App\Modules\EventDataSynchronizer\Jobs\CustomerIoSyncUserByUserId;
use App\Modules\EventTracking\Avo\AvoHelper;
use App\Modules\UserManagementSystem\Jobs\SyncOnboardingBrands;
use Avo;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\UserManagementSystem\Models\OnboardingAnswerHistory;
use Modules\UserManagementSystem\Models\OnboardingExperience;
use Modules\UserManagementSystem\Models\OnboardingGear;
use Modules\UserManagementSystem\Models\OnboardingGenre;
use Modules\UserManagementSystem\Models\OnboardingGoals;
use Modules\UserManagementSystem\Models\OnboardingTopic;
use Throwable;

class OnboardingController extends Controller
{
    /**
     * @throws Throwable
     */
    public function goals(Request $request): JsonResponse
    {
        ['goals' => $goals, 'brand' => $brand] = $request->validate([
            'goals' => 'required|array',
            'brand' => 'required|string',
        ]);

        OnboardingGoals::where(['brand' => $brand, 'user_id' => user()->id])
            ->delete();

        foreach ($goals as $key => $goal) {
            OnboardingGoals::create(
                ['goals' => $goal, 'brand' => $brand, 'user_id' => user()->id]
            );

            $onboardingAnswerHistory = new OnboardingAnswerHistory();
            $onboardingAnswerHistory->onboarding_question = OnboardingAnswerHistory::QUESTION_GOALS;
            $onboardingAnswerHistory->onboarding_answer = $goal;
            $onboardingAnswerHistory->brand = $brand;
            $onboardingAnswerHistory->user_id = user()->id;
            $onboardingAnswerHistory->save();
        }

        dispatch(
            (new CustomerIoSyncUserByUserId(
                user(),
                [
                    $brand . '_onboarding_goals' => $goals,
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
                'goals_list' => $goals,
                'has_completed_onboarding' => true,
            ])
        );

        SyncOnboardingBrands::dispatchAfterResponse(user()->id, $brand);

        return response()->json();
    }

    /**
     * @throws Throwable
     */
    public function getUserOnboardingInformation(Request $request): JsonResponse
    {
        ['brand' => $brand] = $request->validate(['brand' => 'string|required']);

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
                ->pluck('goals')
                ->toArray(),
            'genres' => OnboardingGenre::query()
                ->where(['brand' => $brand, 'user_id' => user()->id])
                ->pluck('genre')
                ->toArray(),
            'topics' => OnboardingTopic::query()
                ->where(['brand' => $brand, 'user_id' => user()->id])
                ->pluck('topic')
                ->toArray(),
        ];

        return response()->json($response, 200);
    }
}
