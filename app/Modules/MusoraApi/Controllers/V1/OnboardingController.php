<?php

namespace Modules\Api\Controllers\V1;

use App\Modules\EventTracking\Avo\AvoHelper;
use App\Modules\UserManagementSystem\Services\OnboardingService;
use Avo;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Routing\ResponseFactory;
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
    }

    /**
     *
     * @param Request $request
     * @return Response|Application|ResponseFactory
     */
    public function gears(Request $request)
    : Response|Application|ResponseFactory {
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
        Avo::gear_onboarding_step_completed(
            AvoHelper::defaultEventProperties([
                'brand' => $brand,
                'gear_list' => $gearList,
            ])
        );

        return response(json_encode(user()), 200);
    }

    /**
     *
     * @param Request $request
     * @return Response|Application|ResponseFactory
     */
    public function topics(Request $request)
    : Response|Application|ResponseFactory {
        ['data' => $data, 'brand' => $brand] = $request->validate([
            'brand' => 'required',
            'data' => 'required',
        ]);

        OnboardingTopic::where(['brand' => $brand, 'user_id' => user()->id])
            ->delete();

        $topicList = [];
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
            $topicList[] = $topic;
        }

        Avo::topics_onboarding_step_completed(
            AvoHelper::defaultEventProperties([
                'brand' => $brand,
                'topic_list' => $topicList,
                'has_completed_onboarding' => true,
            ])
        );
        return response(json_encode(user()), 200);
    }

    /**
     *
     * @param Request $request
     * @return Response|Application|ResponseFactory
     */
    public function genres(Request $request)
    : Response|Application|ResponseFactory {
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

        Avo::genres_onboarding_step_completed(
            AvoHelper::defaultEventProperties([
                'brand' => $brand,
                'genre_list' => $genres,
            ])
        );
        return response(json_encode(user()), 200);
    }

    /**
     *
     * @param Request $request
     * @return Response|Application|ResponseFactory
     */
    public function experience(Request $request)
    : Response|Application|ResponseFactory {
        ['experience_level' => $experienceLevel, 'brand' => $brand] = $request->validate([
            'experience_level' => 'integer|required|max:3',
            'brand' => 'required',
        ]);

        OnboardingExperience::where(['brand' => $brand, 'user_id' => user()->id])
            ->delete();
        OnboardingExperience::create(
            ['experience_level' => $experienceLevel, 'brand' => $brand, 'user_id' => user()->id]
        );

        $onboardingAnswerHistory = new OnboardingAnswerHistory();
        $onboardingAnswerHistory->onboarding_question = OnboardingAnswerHistory::QUESTION_EXPERIENCE;
        $onboardingAnswerHistory->setExperienceLevelAnswer($experienceLevel);
        $onboardingAnswerHistory->brand = $brand;
        $onboardingAnswerHistory->user_id = user()->id;
        $onboardingAnswerHistory->save();

        Avo::experience_onboarding_step_completed(
            AvoHelper::defaultEventProperties([
                'brand' => $brand,
                'experience_level' => strval($experienceLevel),
            ])
        );

        return response(json_encode(user()), 200);
    }

    /**
     *
     * @param Request $request
     * @return Response|Application|ResponseFactory
     */
    public function goals(Request $request)
    : Response|Application|ResponseFactory {
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

        return response(json_encode(user()), 200);
    }

    /**
     *
     * @param Request $request
     * @return Response|Application|ResponseFactory
     */
    public function getUserOnboardingInformation(Request $request)
    : Response|Application|ResponseFactory {
        try {
            ['brand' => $brand] = $request->validate(['brand' => 'string|required']);
        } catch (ValidationException $e) {
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
     * @param Request $request
     * @return Response|Application|ResponseFactory
     */
    public function aboutStepCompleted(Request $request)
    : Response|Application|ResponseFactory {
        $request->validate([
            'skipped' => 'required',
        ]);

        Avo::about_onboarding_step_completed(
            AvoHelper::defaultEventProperties([
                'is_skipped' => $request->get('skipped'),
            ])
        );

        return response(null, 200);
    }

    /**
     *
     * @param Request $request
     * @return Response|Application|ResponseFactory
     */
    public function skipAccountSetup(Request $request)
    : Response|Application|ResponseFactory {
        ['brand' => $brand, 'skippedStep' => $skippedStep] = $request->validate([
            'brand' => 'required',
            'skippedStep' => 'required',
        ]);

        $userAttribute = $brand . '_onboarding_skip_setup';
        user()->{$userAttribute} = true;
        user()->save();

        Avo::account_setup_skipped(
            AvoHelper::defaultEventProperties([
                'step_skipped' => $skippedStep,
                'brand' => $brand,
            ])
        );

        return response(json_encode(user()), 200);
    }

    /**
     *
     * @param Request $request
     * @return Response|Application|ResponseFactory
     * @throws Exception
     */
    public function saveOnboardingHistoryForInstrument(Request $request)
    : Response|Application|ResponseFactory {
        try {
            $request->validate(['instrument' => 'string|required|not-in:undefined']);
        } catch (ValidationException $e) {
            $message = ['error' => 'Get parameter instrument is missing'];
            return response($message, 422);
        }
        $instrument = $request->get('instrument');
        $this->onboardingService->saveInstrument($instrument);
        Avo::instrument_onboarding_step_completed(
            AvoHelper::defaultEventProperties([
                'brand' => $this->onboardingService->getBrandFromInstrument($instrument),
            ])
        );

        return response("History data for instrument has been saved.", 200);
    }

    /**
     *
     * @param Request $request
     * @return Response|Application|ResponseFactory
     */
    public function saveOnboardingHistoryForCoach(Request $request)
    : Response|Application|ResponseFactory {
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
            'user_id' => user()->id,
        ]);
        return response("History data for coach has been saved.", 200);
    }
}
