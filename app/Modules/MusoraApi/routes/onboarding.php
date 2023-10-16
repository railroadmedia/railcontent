<?php

use Modules\MusoraApi\Controllers\V1\OnboardingController;

Route::as('musora-api.')
    ->prefix('musora-api/')
    ->middleware(array_merge(config('musora-api.auth-middleware', []), ['api_version:v1']))
    ->group(function () {
        Route::post(
            '/v1/onboarding/about-completed', [OnboardingController::class, 'aboutStepCompleted']
        )
            ->name('v1.onboarding.about_completed');

        Route::post(
            '/v1/onboarding/gears', [OnboardingController::class, 'gears']
        )
            ->name('v1.onboarding.gears');

        Route::post(
            '/v1/onboarding/topics', [OnboardingController::class, 'topics']
        )
            ->name('v1.onboarding.topics');

        Route::post(
            '/v1/onboarding/genres', [OnboardingController::class, 'genres']
        )
            ->name('v1.onboarding.genres');

        Route::post(
            '/v1/onboarding/experience', [OnboardingController::class, 'experience']
        )
            ->name('v1.onboarding.experience');

        Route::post(
            '/v1/onboarding/goals', [OnboardingController::class, 'goals']
        )
            ->name('v1.onboarding.goals');

        Route::get(
            '/v1/onboarding/saved-answers', [OnboardingController::class, 'getUserOnboardingInformation']
        )
            ->name('v1.onboarding.saved_answers');

        Route::post(
            '/v1/onboarding/skip-account-setup', [OnboardingController::class, 'skipAccountSetup']
        )
            ->name('v1.onboarding.skip');

        Route::get(
            '/v1/onboarding/answer-history-instrument',
            [OnboardingController::class, 'saveOnboardingHistoryForInstrument']
        )
            ->name('v1.onboarding.answer_history_instrument');

        Route::get(
            '/v1/onboarding/answer-history-coach', [OnboardingController::class, 'saveOnboardingHistoryForCoach']
        )
            ->name('v1.onboarding.answer_history_coach');
    });
