<?php

use App\Modules\MusoraApi\Controllers\V1\OnboardingControllerV1;
use App\Modules\MusoraApi\Controllers\V5\OnboardingControllerV5;

Route::as('musora-api.')
    ->prefix('/musora-api')
    ->middleware('web_or_api_authenticated')
    ->group(function () {
        Route::post('/v1/onboarding/started', [OnboardingControllerV1::class, 'onboardingStarted'])
            ->middleware('api_version:v1')
            ->name('v1.onboarding.started');

        Route::post(
            '/v1/onboarding/about-completed',
            [OnboardingControllerV1::class, 'aboutStepCompleted']
        )
            ->middleware('api_version:v1')
            ->name('v1.onboarding.about_completed');

        Route::post(
            '/v1/onboarding/gears',
            [OnboardingControllerV1::class, 'gears']
        )
            ->middleware('api_version:v1')
            ->name('v1.onboarding.gears');

        Route::post(
            '/v1/onboarding/topics',
            [OnboardingControllerV1::class, 'topics']
        )
            ->middleware('api_version:v1')
            ->name('v1.onboarding.topics');

        Route::post(
            '/v1/onboarding/genres',
            [OnboardingControllerV1::class, 'genres']
        )
            ->middleware('api_version:v1')
            ->name('v1.onboarding.genres');

        Route::post(
            '/v1/onboarding/experience',
            [OnboardingControllerV1::class, 'experience']
        )
            ->middleware('api_version:v1')
            ->name('v1.onboarding.experience');

        Route::post(
            '/v1/onboarding/goals',
            [OnboardingControllerV1::class, 'goals']
        )
            ->middleware('api_version:v1')
            ->name('v1.onboarding.goals');

        Route::get(
            '/v1/onboarding/saved-answers',
            [OnboardingControllerV1::class, 'getUserOnboardingInformation']
        )
            ->middleware('api_version:v1')
            ->name('v1.onboarding.saved_answers');

        Route::post(
            '/v1/onboarding/skip-account-setup',
            [OnboardingControllerV1::class, 'skipAccountSetup']
        )
            ->middleware('api_version:v1')
            ->name('v1.onboarding.skip');

        Route::get(
            '/v1/onboarding/answer-history-instrument',
            [OnboardingControllerV1::class, 'saveOnboardingHistoryForInstrument']
        )
            ->middleware('api_version:v1')
            ->name('v1.onboarding.answer_history_instrument');

        Route::get(
            '/v1/onboarding/answer-history-coach',
            [OnboardingControllerV1::class, 'saveOnboardingHistoryForCoach']
        )
            ->middleware('api_version:v1')
            ->name('v1.onboarding.answer_history_coach');

        Route::post('/v5/onboarding/goals', [OnboardingControllerV5::class, 'goals'])
            ->middleware('api_version:v5')
            ->name('v5.onboarding.goals');

        Route::get('/v5/onboarding/saved-answers', [OnboardingControllerV5::class, 'getUserOnboardingInformation'])
            ->middleware('api_version:v5')
            ->name('v5.onboarding.saved_answers');
    });
