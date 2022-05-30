<?php

use App\Http\Controllers\Platform\CoachPagesController;
use App\Http\Controllers\Platform\ContentPagesController;
use App\Http\Controllers\Platform\ForumController;
use App\Http\Controllers\Platform\ForumPagesController;
use App\Http\Controllers\Platform\HomePageController;
use App\Http\Controllers\Platform\LivePageController;
use App\Http\Controllers\Platform\NotificationPagesController;
use App\Http\Controllers\Platform\PackPagesController;
use App\Http\Controllers\Platform\ProfilePublicPagesController;
use App\Http\Controllers\Platform\ProfileSettingsPagesController;
use App\Http\Controllers\Platform\ReferralPagesController;
use App\Http\Controllers\Platform\UserListPagesController;
use App\Modules\Brand\Enums\Brand;
use Illuminate\Support\Facades\Route;

Route::domain('{musoraDomain}')
    ->middleware(['web_authenticated'])
    ->group(function () {
        /*
         * Home Page
         */
        Route::get('/{brand}', [HomePageController::class, 'home'])
            ->whereIn('brand', all_brands())
            ->name('platform.home');

        // this automatically redirects to the users last used brand
        Route::get('/members', [HomePageController::class, 'homeRedirect'])
            ->whereIn('brand', all_brands())
            ->name('platform.home-redirect');

        /*
         * Primary Content Pages
         */
        Route::get('/{brand}/packs', [PackPagesController::class, 'index'])
            ->whereIn('brand', ['drumeo', 'pianote', 'guitareo'])
            ->name('platform.packs');

        Route::get('/{brand}/coaches', [CoachPagesController::class, 'coaches'])
            ->whereIn('brand', all_brands())
            ->name('platform.coaches');

        Route::get('/{brand}/routines', [ContentPagesController::class, 'routines'])
            ->whereIn('brand', [Brand::Singeo->value])
            ->name('platform.routines');

        Route::get('/{brand}/lessons', [ContentPagesController::class, 'lessons'])
            ->whereIn('brand', [Brand::Guitareo->value])
            ->name('platform.lessons');

        Route::get('/{brand}/{contentTypeName}', [ContentPagesController::class, 'contentTypeCatalog'])
            ->whereIn('brand', all_brands())
            ->whereIn('contentTypeName', [
                'courses',
                'songs',
                'quick-tips',
                'podcasts',
                'question-and-answer',
                'student-reviews',
                'boot-camps',
                'chords-and-scales',
                'bootcamps',
                'chords-scales',
                'library',
                'recording',
                'play-alongs',
                'archives',
                'the-history-of-electronic-drums',
                'backstage-secrets',
                'student-collaborations',
                'live-streams',
                'solos',
                'boot-amps',
                'gear-guides',
                'performances',
                'in-rhythm', /* 2020 */
                'challenges', /* 2020 */
                'on-the-road', /* 2020 */
                'diy-drum-experiments', /* 2019*/
                'rhythmic-adventures-of-captain-carson', /* 2019*/
                'study-the-greats', /* 2019*/
                'rhythms-from-another-planet', /* 2019*/
                'tama-drums', /* 2019*/
                'paiste-cymbals', /* 2019*/
                'behind-the-scenes', /* 2019*/
//        'namm-2019', /* 2019*/
//        'camp-drumeo-ah', /* 2019*/
//        '25-days-of-christmas', /* 2019*/
                'exploring-beats', /* 2018*/
                'sonor-drums', /* 2018*/
            ])
            ->name('platform.content-type-catalog');

        Route::get('/{brand}/shows', [ContentPagesController::class, 'shows'])
            ->whereIn('brand', ['drumeo'])
            ->name('platform.shows');

        Route::get('/{brand}/student-focus', [ContentPagesController::class, 'studentFocus'])
            ->whereIn('brand', all_brands())
            ->name('platform.student-focus');

        Route::get('/{brand}/play-alongs', [ContentPagesController::class, 'playAlongs'])
            ->whereIn('brand', [Brand::Drumeo->value, Brand::Guitareo->value])
            ->name('platform.play-alongs');

        Route::get('/{brand}/rudiments', [ContentPagesController::class, 'rudiments'])
            ->whereIn('brand', [Brand::Drumeo->value])
            ->name('platform.rudiments');

        Route::get('/{brand}/podcast', [ContentPagesController::class, 'podcast'])
            ->whereIn('brand', [Brand::Drumeo->value, Brand::Pianote->value])
            ->name('platform.podcast');

        Route::get('/{brand}/boot-camps', [ContentPagesController::class, 'bootCamps'])
            ->whereIn('brand', [Brand::Drumeo->value, Brand::Pianote->value])
            ->name('platform.boot-camps');

        Route::get('/{brand}/chords-and-scales', [ContentPagesController::class, 'chordsAndScales'])
            ->whereIn('brand', [Brand::Pianote->value])
            ->name('platform.chords-and-scales');

        Route::get('/{brand}/archives', [ContentPagesController::class, 'archives'])
            ->whereIn('brand', [Brand::Drumeo->value, Brand::Guitareo->value])
            ->name('platform.archives');

        Route::get('/{brand}/schedule', [ContentPagesController::class, 'schedule'])
            ->whereIn('brand', all_brands())
            ->name('platform.schedule');

        Route::get('/{brand}/search', [ContentPagesController::class, 'search'])
            ->whereIn('brand', all_brands())
            ->name('platform.search');

        /*
         * Specific Sub-Content Hierarchy Pages
         */
        Route::get(
            '/{brand}/coaches/{firstContentSlug}/{firstContentId}',
            [CoachPagesController::class, 'show']
        )
            ->whereIn('brand', all_brands())
            ->name('platform.content.coach.show');

        /*
         * Packs Sub-Content Hierarchy Pages
         */
        Route::get('/{brand}/packs/{packSlug}/{packId}', [PackPagesController::class, 'packBundles'])
            ->whereIn('brand', ['drumeo', 'pianote', 'guitareo'])
            ->name('platform.packs.first-level');

        Route::get(
            '/{brand}/packs/{packSlug}/{packId}/{packBundleSlug}/{packBundleId}',
            [PackPagesController::class, 'packBundleLessons']
        )
            ->whereIn('brand', ['drumeo', 'pianote', 'guitareo'])
            ->name('platform.packs.second-level');

        /*
         * Catch-All Sub-Content Hierarchy Pages
         */
        Route::get(
            '/{brand}/{primaryPage}/{firstContentSlug}/{firstContentId}',
            [ContentPagesController::class, 'firstLevel']
        )
            ->whereIn('brand', all_brands())
            ->whereIn('primaryPage', ['packs', 'method', 'coaches', 'songs', 'courses', 'quick-tips'])
            ->name('platform.content.first-level');

        Route::get(
            '/{brand}/{primaryPage}/{firstContentSlug}/{firstContentId}/{secondContentSlug}/{secondContentId}',
            [ContentPagesController::class, 'secondLevel']
        )
            ->whereIn('brand', all_brands())
            ->whereIn('primaryPage', ['packs', 'method'])
            ->name('platform.content.second-level');

        Route::get(
            '/{brand}/{primaryPage}/{firstContentSlug}/{firstContentId}/{secondContentSlug}/{secondContentId}/{thirdContentSlug}/{thirdContentId}',
            [ContentPagesController::class, 'thirdLevel']
        )
            ->whereIn('brand', all_brands())
            ->whereIn('primaryPage', ['packs', 'method'])
            ->name('platform.content.third-level');

        Route::get(
            '/{brand}/jump-to-content-id/{contentId}',
            [ContentPagesController::class, 'jumpToContentId']
        )
            ->whereIn('brand', all_brands())
            ->whereIn('primaryPage', ['packs', 'method'])
            ->name('platform.content.jump-to-content-id');

        /*
         * Live & Schedule
         */
        Route::get('/{brand}/live', [LivePageController::class, 'live'])
            ->whereIn('brand', all_brands())
            ->name('platform.live');

        /*
         * Users Lists Pages
         */
        Route::get('/{brand}/lists/my-list', [UserListPagesController::class, 'myList'])
            ->whereIn('brand', all_brands())
            ->name('platform.lists.my-list');

        Route::get('/{brand}/lists/in-progress', [UserListPagesController::class, 'inProgress'])
            ->whereIn('brand', all_brands())
            ->name('platform.lists.in-progress');

        Route::get('/{brand}/lists/completed', [UserListPagesController::class, 'completed'])
            ->whereIn('brand', all_brands())
            ->name('platform.lists.completed');

        /*
         * Forums Pages
         */
        Route::get('/{brand}/forums', [ForumPagesController::class, 'index'])
            ->whereIn('brand', all_brands())
            ->name('platform.forums.index');

        Route::get('/{brand}/forums/{categorySlug}/{categoryId}', [ForumPagesController::class, 'category'])
            ->whereIn('brand', all_brands())
            ->name('platform.forums.category');

        Route::get(
            '/{brand}/forums/{categorySlug}/{categoryId}/{threadSlug}/{threadId}',
            [ForumPagesController::class, 'thread']
        )
            ->whereIn('brand', all_brands())
            ->name('platform.forums.thread');

        /*
         * Profile Public Pages
         */
        Route::get('/{brand}/profile/{userId}/dashboard', [ProfilePublicPagesController::class, 'dashboard'])
            ->whereIn('brand', all_brands())
            ->name('platform.profile.dashboard');

        /*
         * Profile Settings Pages
         */
        Route::get('/{brand}/profile/{userId}/settings/profile', [ProfileSettingsPagesController::class, 'profile'])
            ->whereIn('brand', all_brands())
            ->name('platform.profile.settings.profile');

        Route::get(
            '/{brand}/profile/{userId}/settings/login-credentials',
            [ProfileSettingsPagesController::class, 'loginCredentials']
        )
            ->whereIn('brand', all_brands())
            ->name('platform.profile.settings.login-credentials');

        Route::get('/{brand}/profile/{userId}/settings/payments', [ProfileSettingsPagesController::class, 'payments'])
            ->whereIn('brand', all_brands())
            ->name('platform.profile.settings.payments');

        Route::get(
            '/{brand}/profile/{userId}/settings/notifications',
            [ProfileSettingsPagesController::class, 'notifications']
        )
            ->whereIn('brand', all_brands())
            ->name('platform.profile.settings.notifications');

        Route::get(
            '/{brand}/profile/{userId}/settings/membership',
            [ProfileSettingsPagesController::class, 'membership']
        )
            ->whereIn('brand', all_brands())
            ->name('platform.profile.settings.membership');

        /*
         * Notifications Pages
         */
        Route::get('/{brand}/notifications', [NotificationPagesController::class, 'index'])
            ->whereIn('brand', all_brands())
            ->name('platform.notifications');

        /*
         * Referral Pages
         */
        Route::get('/{brand}/referral/invite-a-friend', [ReferralPagesController::class, 'inviteAFriend'])
            ->whereIn('brand', all_brands())
            ->name('platform.invite-a-friend');

        /*
         * Forums
         */
        // all threads and discussions
        Route::get(
            '/{brand}/forums',
            [
                'as' => 'forums.index',
                'uses' => ForumController::class . '@forumIndex'
            ]
        )
            ->whereIn('brand', all_brands());


        // create forum view
        Route::get(
            '/{brand}/forums/create-forum',
            [
                'as' => 'forums.forum.create',
                'uses' => ForumController::class . '@createForum'
            ]
        )
            ->whereIn('brand', all_brands());

        // edit forum view
        Route::get(
            '/{brand}/forums/update-forum/{forumId}',
            [
                'as' => 'forums.forum.update',
                'uses' => ForumController::class . '@updateForum'
            ]
        )
            ->whereIn('brand', all_brands());

        // create thread list view
        Route::get(
            '/{brand}/forums/threads/{categorySlug}/{categoryId}',
            [
                'as' => 'forums.thread.list',
                'uses' => ForumController::class . '@threadList'
            ]
        )
            ->whereIn('brand', all_brands());

        // create thread view
        Route::get(
            '/{brand}/forums/threads/create-thread',
            [
                'as' => 'forums.thread.create',
                'uses' => ForumController::class . '@createThread'
            ]
        )
            ->whereIn('brand', all_brands());

        // edit thread view
        Route::get(
            '/{brand}/forums/edit-thread/{threadId}',
            [
                'as' => 'forums.thread.update',
                'uses' => ForumController::class . '@updateThread'
            ]
        )
            ->whereIn('brand', all_brands());

        // jump
        Route::get(
            '/{brand}/forums/jump-to-post/{id}',
            [
                'as' => 'forums.post.jump-to',
                'uses' => ForumController::class . '@jumpToPost'
            ]
        )
            ->whereIn('brand', all_brands());
        Route::get(
            '/{brand}/forums/jump-to-thread/{id}',
            [
                'as' => 'forums.thread.jump-to',
                'uses' => ForumController::class . '@jumpToThread'
            ]
        )
            ->whereIn('brand', all_brands());

        // search
        Route::get(
            '/{brand}/forums/search',
            [
                'as' => 'forums.search',
                'uses' => ForumController::class . '@searchIndex'
            ]
        )
            ->whereIn('brand', all_brands());

        // view thread
        Route::get(
            '/{brand}/forums/{threadSlugAndId}',
            [
                'as' => 'forums.thread',
                'uses' => ForumController::class . '@showThreadById'
            ]
        )
            ->whereIn('brand', all_brands());

        // follow thread
        Route::get(
            '/{brand}/forums/{categorySlug}/{categoryId}/{threadSlug}/{threadId}',
            [
                'as' => 'forums.thread.show',
                'uses' => ForumController::class . '@showThread'
            ]
        )
            ->whereIn('brand', all_brands());

        Route::get(
            '/{brand}/forums/threads/latest',
            [
                'as' => 'forums.index.latest',
                'uses' => ForumController::class . '@forumIndexNew'
            ]
        )
            ->whereIn('brand', all_brands());
    });
