<?php

use App\Http\Controllers\Platform\CoachPagesController;
use App\Http\Controllers\Platform\ContentPagesController;
use App\Http\Controllers\Platform\ForumPagesController;
use App\Http\Controllers\Platform\HomePageController;
use App\Http\Controllers\Platform\LivePageController;
use App\Http\Controllers\Platform\NotificationPagesController;
use App\Http\Controllers\Platform\ProfilePublicPagesController;
use App\Http\Controllers\Platform\ProfileSettingsPagesController;
use App\Http\Controllers\Platform\ReferralPagesController;
use App\Http\Controllers\Platform\UserListPagesController;
use App\Modules\Brand\Enums\Brand;
use Illuminate\Support\Facades\Route;

Route::domain('{musoraDomain}')
    ->name('platform.')
    ->middleware(['web_authenticated'])
    ->group(function () {
        /*
         * Home Page
         */
        Route::get('/{brand}', [HomePageController::class, 'home'])
            ->whereIn('brand', all_brands())
            ->name('home');

        // this automatically redirects to the users last used brand
        Route::get('/members', [HomePageController::class, 'homeRedirect'])
            ->whereIn('brand', all_brands())
            ->name('home-redirect');

        /*
         * Primary Content Pages
         */
        Route::get('/{brand}/packs', [ContentPagesController::class, 'packs'])
            ->whereIn('brand', all_brands())
            ->name('packs');

        Route::get('/{brand}/coaches', [CoachPagesController::class, 'coaches'])
            ->whereIn('brand', all_brands())
            ->name('coaches');

        Route::get('/{brand}/routines', [ContentPagesController::class, 'routines'])
            ->whereIn('brand', [Brand::Singeo->value])
            ->name('routines');

        Route::get('/{brand}/lessons', [ContentPagesController::class, 'lessons'])
            ->whereIn('brand', [Brand::Guitareo->value])
            ->name('lessons');

        Route::get('/{brand}/songs', [ContentPagesController::class, 'songs'])
            ->whereIn('brand', all_brands())
            ->name('songs');

        Route::get('/{brand}/courses', [ContentPagesController::class, 'courses'])
            ->whereIn('brand', all_brands())
            ->name('courses');

        Route::get('/{brand}/quick-tips', [ContentPagesController::class, 'quickTips'])
            ->whereIn('brand', all_brands())
            ->name('quick-tips');

        Route::get('/{brand}/shows', [ContentPagesController::class, 'shows'])
            ->whereIn('brand', all_brands())
            ->name('shows');

        Route::get('/{brand}/play-alongs', [ContentPagesController::class, 'playAlongs'])
            ->whereIn('brand', [Brand::Drumeo->value, Brand::Guitareo->value])
            ->name('play-alongs');

        Route::get('/{brand}/student-focus', [ContentPagesController::class, 'studentFocus'])
            ->whereIn('brand', all_brands())
            ->name('student-focus');

        Route::get('/{brand}/rudiments', [ContentPagesController::class, 'rudiments'])
            ->whereIn('brand', [Brand::Drumeo->value])
            ->name('rudiments');

        Route::get('/{brand}/podcast', [ContentPagesController::class, 'podcast'])
            ->whereIn('brand', [Brand::Drumeo->value, Brand::Pianote->value])
            ->name('podcast');

        Route::get('/{brand}/boot-camps', [ContentPagesController::class, 'bootCamps'])
            ->whereIn('brand', [Brand::Drumeo->value, Brand::Pianote->value])
            ->name('boot-camps');

        Route::get('/{brand}/chords-and-scales', [ContentPagesController::class, 'chordsAndScales'])
            ->whereIn('brand', [Brand::Pianote->value])
            ->name('chords-and-scales');

        Route::get('/{brand}/archives', [ContentPagesController::class, 'archives'])
            ->whereIn('brand', [Brand::Drumeo->value, Brand::Guitareo->value])
            ->name('archives');

        Route::get('/{brand}/schedule', [ContentPagesController::class, 'schedule'])
            ->whereIn('brand', all_brands())
            ->name('schedule');

        Route::get('/{brand}/search', [ContentPagesController::class, 'search'])
            ->whereIn('brand', all_brands())
            ->name('search');

        /*
         * Specific Sub-Content Hierarchy Pages
         */
        Route::get(
            '/{brand}/coaches/{firstContentSlug}/{firstContentId}',
            [CoachPagesController::class, 'show']
        )
            ->whereIn('brand', all_brands())
            ->name('content.coach.show');

        /*
         * Catch-All Sub-Content Hierarchy Pages
         */
        Route::get(
            '/{brand}/{primaryPage}/{firstContentSlug}/{firstContentId}',
            [ContentPagesController::class, 'firstLevel']
        )
            ->whereIn('brand', all_brands())
            ->whereIn('primaryPage', ['packs', 'method', 'coaches', 'songs', 'courses', 'quick-tips'])
            ->name('content.first-level');

        Route::get(
            '/{brand}/{primaryPage}/{firstContentSlug}/{firstContentId}/{secondContentSlug}/{secondContentId}',
            [ContentPagesController::class, 'secondLevel']
        )
            ->whereIn('brand', all_brands())
            ->whereIn('primaryPage', ['packs', 'method'])
            ->name('content.second-level');

        Route::get(
            '/{brand}/{primaryPage}/{firstContentSlug}/{firstContentId}/{secondContentSlug}/{secondContentId}/{thirdContentSlug}/{thirdContentId}',
            [ContentPagesController::class, 'thirdLevel']
        )
            ->whereIn('brand', all_brands())
            ->whereIn('primaryPage', ['packs', 'method'])
            ->name('content.third-level');

        Route::get(
            '/{brand}/jump-to-content-id/{contentId}',
            [ContentPagesController::class, 'jumpToContentId']
        )
            ->whereIn('brand', all_brands())
            ->whereIn('primaryPage', ['packs', 'method'])
            ->name('content.jump-to-content-id');

        /*
         * Live & Schedule
         */
        Route::get('/{brand}/live', [LivePageController::class, 'live'])
            ->whereIn('brand', all_brands())
            ->name('live');

        /*
         * Users Lists Pages
         */
        Route::get('/{brand}/lists/my-list', [UserListPagesController::class, 'myList'])
            ->whereIn('brand', all_brands())
            ->name('lists.my-list');

        Route::get('/{brand}/lists/in-progress', [UserListPagesController::class, 'inProgress'])
            ->whereIn('brand', all_brands())
            ->name('lists.in-progress');

        Route::get('/{brand}/lists/completed', [UserListPagesController::class, 'completed'])
            ->whereIn('brand', all_brands())
            ->name('lists.completed');

        /*
         * Forums Pages
         */
        Route::get('/{brand}/forums', [ForumPagesController::class, 'index'])
            ->whereIn('brand', all_brands())
            ->name('forums.index');

        Route::get('/{brand}/forums/{categorySlug}/{categoryId}', [ForumPagesController::class, 'category'])
            ->whereIn('brand', all_brands())
            ->name('forums.category');

        Route::get('/{brand}/forums/{categorySlug}/{categoryId}/{threadSlug}/{threadId}', [ForumPagesController::class, 'thread'])
            ->whereIn('brand', all_brands())
            ->name('forums.thread');

        /*
         * Profile Public Pages
         */
        Route::get('/{brand}/profile/{userId}/dashboard', [ProfilePublicPagesController::class, 'dashboard'])
            ->whereIn('brand', all_brands())
            ->name('profile.dashboard');

        /*
         * Profile Settings Pages
         */
        Route::get('/{brand}/profile/{userId}/settings/profile', [ProfileSettingsPagesController::class, 'profile'])
            ->whereIn('brand', all_brands())
            ->name('profile.settings.profile');

        Route::get(
            '/{brand}/profile/{userId}/settings/login-credentials',
            [ProfileSettingsPagesController::class, 'loginCredentials']
        )
            ->whereIn('brand', all_brands())
            ->name('profile.settings.login-credentials');

        Route::get('/{brand}/profile/{userId}/settings/payments', [ProfileSettingsPagesController::class, 'payments'])
            ->whereIn('brand', all_brands())
            ->name('profile.settings.payments');

        Route::get(
            '/{brand}/profile/{userId}/settings/notifications',
            [ProfileSettingsPagesController::class, 'notifications']
        )
            ->whereIn('brand', all_brands())
            ->name('profile.settings.notifications');

        Route::get(
            '/{brand}/profile/{userId}/settings/membership',
            [ProfileSettingsPagesController::class, 'membership']
        )
            ->whereIn('brand', all_brands())
            ->name('profile.settings.membership');

        /*
         * Notifications Pages
         */
        Route::get('/{brand}/notifications', [NotificationPagesController::class, 'index'])
            ->whereIn('brand', all_brands())
            ->name('notifications');

        /*
         * Referral Pages
         */
        Route::get('/{brand}/referral/invite-a-friend', [ReferralPagesController::class, 'inviteAFriend'])
            ->whereIn('brand', all_brands())
            ->name('invite-a-friend');
    });
