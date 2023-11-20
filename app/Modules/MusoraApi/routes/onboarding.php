<?php


use App\Modules\MusoraApi\Controllers\V1\OnboardingController;

Route::as('musora-api.')
    ->prefix('/musora-api')
    ->middleware('web_or_api_authenticated')
    ->group(function () {
        Route::post('/v1/onboarding/started', [OnboardingController::class, 'onboardingStarted'])
            ->middleware('api_version:v1')
            ->name('v1.onboarding.started');

        Route::post(
            '/v1/onboarding/about-completed', [OnboardingController::class, 'aboutStepCompleted']
        )
            ->middleware('api_version:v1')
            ->name('v1.onboarding.about_completed');

        Route::post(
            '/v1/onboarding/gears', [OnboardingController::class, 'gears']
        )
            ->middleware('api_version:v1')
            ->name('v1.onboarding.gears');

        Route::post(
            '/v1/onboarding/topics', [OnboardingController::class, 'topics']
        )
            ->middleware('api_version:v1')
            ->name('v1.onboarding.topics');

        Route::post(
            '/v1/onboarding/genres', [OnboardingController::class, 'genres']
        )
            ->middleware('api_version:v1')
            ->name('v1.onboarding.genres');

        Route::post(
            '/v1/onboarding/experience', [OnboardingController::class, 'experience']
        )
            ->middleware('api_version:v1')
            ->name('v1.onboarding.experience');

        Route::post(
            '/v1/onboarding/goals', [OnboardingController::class, 'goals']
        )
            ->middleware('api_version:v1')
            ->name('v1.onboarding.goals');

        Route::get(
            '/v1/onboarding/saved-answers', [OnboardingController::class, 'getUserOnboardingInformation']
        )
            ->middleware('api_version:v1')
            ->name('v1.onboarding.saved_answers');

        Route::post(
            '/v1/onboarding/skip-account-setup', [OnboardingController::class, 'skipAccountSetup']
        )
            ->middleware('api_version:v1')
            ->name('v1.onboarding.skip');

        Route::get(
            '/v1/onboarding/answer-history-instrument',
            [OnboardingController::class, 'saveOnboardingHistoryForInstrument']
        )
            ->middleware('api_version:v1')
            ->name('v1.onboarding.answer_history_instrument');

        Route::get(
            '/v1/onboarding/answer-history-coach',
            [OnboardingController::class, 'saveOnboardingHistoryForCoach']
        )
            ->middleware('api_version:v1')
            ->name('v1.onboarding.answer_history_coach');
    });
