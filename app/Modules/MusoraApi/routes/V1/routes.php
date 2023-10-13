<?php

use Modules\Api\Controllers\V1\OnboardingController;

Route::as('v1.')
    ->prefix('musora-api/v1')
    ->namespace('App\Modules\MusoraApi\Controllers\V1')
    ->middleware(array_merge(config('musora-api.auth-middleware', []), ['api_version:v1']))
    ->group(
        function () {
            Route::prefix('/onboarding')
                ->group(function () {
                    Route::post(
                        '/about-completed', [OnboardingController::class, 'aboutStepCompleted']
                    )
                        ->name('api.onboarding.about_completed');

                    Route::post(
                        '/gears', [OnboardingController::class, 'gears']
                    )
                        ->name('api.onboarding.gears');

                    Route::post(
                        '/topics', [OnboardingController::class, 'topics']
                    )
                        ->name('api.onboarding.topics');

                    Route::post(
                        '/genres', [OnboardingController::class, 'genres']
                    )
                        ->name('api.onboarding.genres');

                    Route::post(
                        '/experience', [OnboardingController::class, 'experience']
                    )
                        ->name('api.onboarding.experience');

                    Route::post(
                        '/goals', [OnboardingController::class, 'goals']
                    )
                        ->name('api.onboarding.goals');

                    Route::get(
                        '/saved-answers', [OnboardingController::class, 'getUserOnboardingInformation']
                    )
                        ->name('api.onboarding.saved_answers');

                    Route::post(
                        '/skip-account-setup', [OnboardingController::class, 'skipAccountSetup']
                    )
                        ->name('api.onboarding.skip');

                    Route::get(
                        '/answer-history-instrument',
                        [OnboardingController::class, 'saveOnboardingHistoryForInstrument']
                    )
                        ->name('api.onboarding.answer_history_instrument');

                    Route::get(
                        '/answer-history-coach', [OnboardingController::class, 'saveOnboardingHistoryForCoach']
                    )
                        ->name('api.onboarding.answer_history_coach');
                });
        }
    );
