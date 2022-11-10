<?php

use App\Http\Controllers\Musora\CodeRedemptionController;
use App\Http\Controllers\Musora\MarketingController;
use App\Http\Controllers\Musora\ReferralJoinController;
use App\Http\Controllers\Platform\BooksController;
use Illuminate\Support\Facades\Route;

Route::domain('{musoraDomain}')
    ->middleware(['web_public'])
    ->group(function () {
        Route::get('about', [MarketingController::class, 'about']);
        Route::get('contact', [MarketingController::class, 'contact']);
        Route::get('terms-of-service', [MarketingController::class, 'terms']);
        Route::get('privacy-policy', [MarketingController::class, 'privacy']);
        Route::get('careers', [MarketingController::class, 'careers']);
        Route::get('ambassador', [MarketingController::class, 'ambassador']);
        Route::get('brand', [MarketingController::class, 'brand']);
        Route::get('unified-2022', [MarketingController::class, 'unified2022']);
        Route::get('referral-join', [ReferralJoinController::class, 'join']);
        Route::get('power-pack', [CodeRedemptionController::class, 'powerPack']);
        Route::post('hlag-submit', [CodeRedemptionController::class, 'hitLikeAGirlSubmission']);
        Route::get('redeem', [CodeRedemptionController::class, 'renderNewAccountRedeemPage']);
        Route::get('redeem/existing', [CodeRedemptionController::class, 'renderExistingAccountRedeemPage']);
        Route::get('sonor', [CodeRedemptionController::class, 'sonor']);
        Route::get('bestbook', [
            'as' => 'books.best-beginner-drum-book',
            'uses' => BooksController::class.'@bestBeginner',
        ]);
        Route::get('bestbook/play-alongs', [
            'as' => 'books.best-beginner-drum-book.play-alongs',
            'uses' => BooksController::class.'@bestBeginnerPlayAlongs',
        ]);

        Route::get('bestbook-digital', [
            'as' => 'books.best-beginner-drum-book-digital',
            'uses' => BooksController::class.'@bestBeginner',
        ]);
        Route::get('bestbook-trial', [MarketingController::class, 'bestBookTrial']);
        Route::get('choose-your-trial', [MarketingController::class, 'chooseTrial']);
        Route::group(['prefix' => 'drummers-toolbox-digital'], function () {
            Route::get('/', [
                              'as' => 'books.digital.drummers-toolbox',
                              'uses' => BooksController::class.'@drummersToolbox',
                          ]);

            Route::get('/{chapterNumber}', [
                                             'as' => 'books.digital.drummers-toolbox.chapter',
                                             'uses' => BooksController::class.'@drummersToolboxChapter',
                                         ]);
        });
        Route::get('drummers-toolbox', [
            'as' => 'books.drummers-toolbox',
            'uses' => BooksController::class.'@drummersToolbox',
        ]);
        Route::get('drummers-toolbox/trial', [
            'as' => 'books.drummers-toolbox.trial',
            'uses' => BooksController::class.'@drummersToolbox',
        ]);
        Route::get('drummers-toolbox/{chapterNumber}', [
                                                         'as' => 'books.drummers-toolbox.chapter',
                                                         'uses' => BooksController::class.'@drummersToolboxChapter',
                                                     ]);


    });
